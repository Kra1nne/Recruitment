<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Socialite;
use Throwable;



class LoginBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }
  public function loginProcess(Request $request)
  {
    $userData = User::where('username', $request->username)->whereNull('deleted_at')->first();

    if (!$userData || !Hash::check($request->password, $userData->password)) {
        $message = $userData 
            ? 'Invalid Email or Password.' 
            : 'Account didn\'t exist.';

        return back()->withErrors([
            'login' => $message
        ])->withInput();
    }
    $logData = [
        'user_id' => $userData->id,
        'action' => 'Login',
        'table' => 'Users',
        'description' =>'Successfully login',
        'ip_address' => request()->ip(),
        'created_at' => now(),
      ];

      
      Auth::login($userData);
      Log::insert($logData);

      return redirect()->route('dashboard-analytics')->with('success', 'Successfully login');
  }
  public function logoutAccount(Request $request) 
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
  }
  public function redirect()
  {
      return Socialite::driver('google')->redirect();
  }
  public function callback()
  {
      try {
          $user = Socialite::driver('google')->user();
      } catch (Throwable $e) {
          return redirect('/')->with('error', 'Google authentication failed.');
      }

      $existingUser = User::leftjoin('persons', 'persons.id', '=', 'users.person_id')
        ->where('persons.email', $user->email)
        ->first();

      if ($existingUser) {
          Auth::login($existingUser);
      }else{
        return back()->withErrors([
            'login' => 'This Email is not register'
        ])->withInput();
      }

      return redirect()->route('dashboard-analytics')->with('success', 'Successfully login');
  }
}
