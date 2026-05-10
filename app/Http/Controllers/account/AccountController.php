<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function accountList(Request $request)
    {
        $user = User::with('person.employee.department')->whereNull('deleted_at');

        
        $isSearch = false;

        if ($request->search) {
            $isSearch = true;
            $search = $request->search;

            $user->whereHas('person', function ($query) use ($search) {
                $query->where('first_name', 'LIKE', "{$search}%")
                    ->orWhere('middle_name', 'LIKE', "{$search}%")
                    ->orWhere('last_name', 'LIKE', "{$search}%");
            });
        }
        $userList = $user->orderBy('id', 'desc')->paginate(8);
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Account List'],
        ];

        return view('content.account.account-list', compact('isSearch','breadcrumbs', 'userList'));
    }
    public function accountForm()
    {
        $employees = Employee::with('person')
            ->whereNull('deleted_at')
            ->whereNotIn('employees.person_id', function ($query) {
                $query->select('person_id')
                    ->from('users')
                    ->whereNull('deleted_at');
            })
            ->get();
            
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Account List', 'link' => route('account-list')],
            ['name' => 'Account Form'],
        ];

        return view('content.account.account-form', compact('breadcrumbs', 'employees'));
    }
    public function accountAdd(Request $request)
    {
        if($request->password != $request->password_confirmation){
            return redirect()->back()->with('error', 'Account password didnt match!');
        }
        $duplicate = User::whereNull('deleted_at')->where('username', $request->username)->first();
        if($duplicate){
            return redirect()->back()->with('error', 'Username already been used');
        }
        try {
            $data = [
                'person_id' => $request->person_id,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'created_at' => now()
            ];
            
            User::insert($data);

            $logData = [
                'user_id' => Auth::user()->id,
                'action' => 'Add',
                'table' => 'User',
                'description' =>'Added a new user',
                'ip_address' => request()->ip(),
                'created_at' => now(),
            ];

            Log::insert($logData);
            return redirect()->back()->with('success', 'Account created successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Account unable to create!');
        }
    }
    public function accountEdit($id)
    {
        $userData = User::whereNull('deleted_at')->where('id', Crypt::decryptString($id))->first();

        $employees = Employee::with('person')
            ->whereNull('deleted_at')
            ->whereNotIn('employees.person_id', function ($query) use ($userData) {
                $query->select('person_id')
                    ->from('users')
                    ->whereNull('deleted_at')
                    ->where('person_id', '!=', $userData->person_id);
            })
            ->get();

        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Account List', 'link' => route('account-list')],
            ['name' => 'Account Form'],
        ];

        return view('content.account.account-edit', compact('breadcrumbs', 'employees', 'userData'));
    }
    public function accountUpdate(Request $request)
    {
        try {
            if($request->password != null){
                if($request->password != $request->password_confirmation){
                    return redirect()->back()->with('error', 'Account password didnt match!');
                }

                $data = [
                    'person_id' => $request->person_id,
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                    'updated_at' => now()
                ];
            }else{
                $data = [
                    'person_id' => $request->person_id,
                    'username' => $request->username,
                    'role' => $request->role,
                    'updated_at' => now()
                ];
            }
            
            User::where('id', $request->id)->update($data);

            $logData = [
                'user_id' => Auth::user()->id,
                'action' => 'Update',
                'table' => 'User',
                'description' =>'Update a user',
                'ip_address' => request()->ip(),
                'created_at' => now(),
            ];

            Log::insert($logData);
            return redirect()->back()->with('success', 'Account updated successfully!');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Account unable to update!');
        }
    }
    public function accountDelete($id){
        try {
            User::where('id', $id)->delete();

            $logData = [
                'user_id' => Auth::user()->id,
                'action' => 'Delete',
                'table' => 'User',
                'description' =>'Delete a user',
                'ip_address' => request()->ip(),
                'created_at' => now(),
            ];

            Log::insert($logData);

            return redirect()->back()->with('success', 'Account deleted successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Account unable to delete!');
        }
    }
    public function accountView($id)
    {
        $employeeData = Employee::with(['department', 'person.user'])
            ->where('id', Auth::user()->id)
            ->first();

        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Account List', 'link' => route('account-list')],
            ['name' => 'Account View'],
        ];

        return view('content.account.account-view', compact('breadcrumbs', 'employeeData'));
    }
}
