<?php

use App\Http\Controllers\account\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\department\DepartmentController;
use App\Http\Controllers\employee\EmployeeController;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\job\JobController;
use App\Http\Controllers\log\ActivityLogsCotroller;
use App\Http\Controllers\profile\ProfileController;

// Main Page Route
Route::get('/', [HomeController::class, 'landingPage'])->name('home');
Route::get('/jobs', [HomeController::class, 'jobPage'])->name('jobs');
Route::get('/jobs/form/{id}', [HomeController::class, 'jobForm'])->name('jobs-form');
Route::post('/jobs/applicant/add', [HomeController::class, 'jobApplicant'])->name('job-applicant-add');


Route::middleware(['guest'])->group(function() {
  Route::get('/login', [LoginBasic::class, 'index'])->name('login');
  Route::post('/login/process', [LoginBasic::class, 'loginProcess'])->name('login-process');

  Route::get('/auth/google/redirect', [LoginBasic::class, 'redirect'])->name('auth.google.redirect');
  Route::get('/auth/google/callback', [LoginBasic::class, 'callback'])->name('auth.google.callback');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard-analytics');

    Route::get('/department', [DepartmentController::class, 'departmentList'])->name('department-list');
    Route::get('/department/form', [DepartmentController::class, 'departmentForm'])->name('department-form');
    Route::get('/department/{id}', [DepartmentController::class, 'departmentFormEdit'])->name('department-form-edit');
    Route::post('/department/form/add', [DepartmentController::class, 'departmentAdd'])->name('department-add');
    Route::post('/department/form/update', [DepartmentController::class, 'departmentUpdate'])->name('department-update');
    Route::delete('/department/form/delete/{id}', [DepartmentController::class, 'departmentDelete'])->name('department-delete');
    Route::get('/department/view/{id}', [DepartmentController::class, 'departmentView'])->name('department-view');

    Route::get('/job-posting', [JobController::class, 'jobList'])->name('job-posting');
    Route::get('/job-posting/form', [JobController::class, 'jobForm'])->name('job-posting-form');
    Route::get('/job-posting/{id}', [JobController::class, 'jobEdit'])->name('job-posting-edit');
    Route::post('/job-posting/add', [JobController::class, 'jobAdd'])->name('job-posting-add');
    Route::post('/job-posting/update', [JobController::class, 'jobUpdate'])->name('job-posting-update');
    Route::delete('/job-posting/delete/{id}', [JobController::class, 'jobDelete'])->name('job-posting-delete');
    Route::get('/job-posting/view/{id}', [JobController::class, 'jobView'])->name('job-view');
    Route::get('/job-posting/form/{id}', [JobController::class, 'jobApplicantForm'])->name('job-form');
    Route::post('/job-posting/reject/{id}', [JobController::class, 'rejected'])->name('job-reject');
    Route::post('/job-posting/accepted/{id}', [JobController::class, 'accepted'])->name('job-accepted');
    Route::get('/job-posting/assessment/{id}', [JobController::class, 'applicantAssessment'])->name('job-assessment');
    Route::post('/job-posting/assessment/send', [JobController::class, 'applicantAssessmentSend'])->name('job-assessment-send');

    Route::get('/account-list', [AccountController::class, 'accountList'])->name('account-list');
    Route::get('/account-list/form', [AccountController::class, 'accountForm'])->name('account-form');
    Route::post('/account-list/add', [AccountController::class, 'accountAdd'])->name('account-add');
    Route::get('/account-list/{id}', [AccountController::class, 'accountEdit'])->name('account-edit');
    Route::post('/account-list/update', [AccountController::class, 'accountUpdate'])->name('account-update');
    Route::delete('/account-list/delete/{id}', [AccountController::class, 'accountDelete'])->name('account-delete');
    Route::get('/account-list/view/{id}', [AccountController::class, 'accountView'])->name('account-view');

    Route::get('/employee-list', [EmployeeController::class, 'employeeList'])->name('employee-list');
    Route::get('/employee-list/form', [EmployeeController::class, 'employeeForm'])->name('employee-form');
    Route::post('/employee-list/add', [EmployeeController::class, 'employeeAdd'])->name('employee-add');
    Route::get('/employee-list/{id}', [EmployeeController::class, 'employeeEdit'])->name('employee-edit');
    Route::post('/employee-list/update', [EmployeeController::class, 'employeeUpdate'])->name('employee-update');
    Route::delete('/employee-list/delete/{id}', [EmployeeController::class, 'employeeDelete'])->name('employee-delete');
    Route::get('/employee-list/view/{id}', [EmployeeController::class, 'employeeView'])->name('employee-view');

    Route::get('/profile', [ProfileController::class, 'accountProfile'])->name('profile');
    Route::get('/logs', [ActivityLogsCotroller::class, 'activityLogs'])->name('logs-list');

    Route::get('/logout', [LoginBasic::class, 'logoutAccount'])->name('logout-process');
});
