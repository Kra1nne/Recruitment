<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function accountProfile()
    {
        $employeeData = Employee::with(['department', 'person'])
            ->where('id', Auth::user()->id)
            ->first();

        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Job Posting'],
        ];
        return view('content.profile.profile', compact('breadcrumbs', 'employeeData'));
    }
}
