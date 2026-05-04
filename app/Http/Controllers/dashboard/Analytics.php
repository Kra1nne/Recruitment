<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Job;

class Analytics extends Controller
{
  public function index()
  {
    $query = Applicant::with('job', 'person')->orderBy('id');

    $applicants = $query->paginate(6);
    $applicantsCount = $query->count();
    $departmantCount = Department::whereNull('deleted_at')->count();
    $employeeCount = Employee::whereNull('deleted_at')->count();
    $jobCount = Job::where('deleted_at')->count();

    return view('content.dashboard.dashboards-analytics', compact('applicants', 'applicantsCount', 'departmantCount', 'employeeCount', 'jobCount'));
  }
}
