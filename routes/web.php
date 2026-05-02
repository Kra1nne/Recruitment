<?php

use App\Http\Controllers\account\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\department\DepartmentController;
use App\Http\Controllers\employee\EmployeeController;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\Boxicons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\job\JobController;
use App\Http\Controllers\log\ActivityLogsCotroller;
use App\Http\Controllers\profile\ProfileController;
use App\Http\Controllers\tables\Basic as TablesBasic;

// Main Page Route
Route::get('/', [HomeController::class, 'landingPage'])->name('home');
Route::get('/jobs', [HomeController::class, 'jobPage'])->name('jobs');

Route::middleware(['guest'])->group(function() {

  Route::get('/login', [LoginBasic::class, 'index'])->name('login');
  Route::post('/login/process', [LoginBasic::class, 'loginProcess'])->name('login-process');

  Route::get('/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard-analytics');

    Route::get('/department', [DepartmentController::class, 'departmentList'])->name('department-list');
    Route::get('/department/form', [DepartmentController::class, 'departmentForm'])->name('department-form');
    Route::get('/department/{id}', [DepartmentController::class, 'departmentFormEdit'])->name('department-form-edit');
    Route::post('/department/form/add', [DepartmentController::class, 'departmentAdd'])->name('department-add');
    Route::post('/department/form/update', [DepartmentController::class, 'departmentUpdate'])->name('department-update');
    Route::delete('/department/form/delete/{id}', [DepartmentController::class, 'departmentDelete'])->name('department-delete');

    Route::get('/job-posting', [JobController::class, 'jobList'])->name('job-posting');
    Route::get('/job-posting/form', [JobController::class, 'jobForm'])->name('job-posting-form');
    Route::get('/job-posting/{id}', [JobController::class, 'jobEdit'])->name('job-posting-edit');
    Route::post('/job-posting/add', [JobController::class, 'jobAdd'])->name('job-posting-add');
    Route::post('/job-posting/update', [JobController::class, 'jobUpdate'])->name('job-posting-update');
    Route::delete('/job-posting/delete/{id}', [JobController::class, 'jobDelete'])->name('job-posting-delete');

    Route::get('/account-list', [AccountController::class, 'accountList'])->name('account-list');
    Route::get('/account-list/form', [AccountController::class, 'accountForm'])->name('account-form');
    Route::post('/account-list/add', [AccountController::class, 'accountAdd'])->name('account-add');
    Route::get('/account-list/{id}', [AccountController::class, 'accountEdit'])->name('account-edit');
    Route::post('/account-list/update', [AccountController::class, 'accountUpdate'])->name('account-update');
    Route::delete('/account-list/delete/{id}', [AccountController::class, 'accountDelete'])->name('account-delete');

    Route::get('/employee-list', [EmployeeController::class, 'employeeList'])->name('employee-list');
    Route::get('/employee-list/form', [EmployeeController::class, 'employeeForm'])->name('employee-form');
    Route::post('/employee-list/add', [EmployeeController::class, 'employeeAdd'])->name('employee-add');
    Route::get('/employee-list/{id}', [EmployeeController::class, 'employeeEdit'])->name('employee-edit');
    Route::post('/employee-list/update', [EmployeeController::class, 'employeeUpdate'])->name('employee-update');
    Route::delete('/employee-list/delete/{id}', [EmployeeController::class, 'employeeDelete'])->name('employee-delete');



    Route::get('/profile', [ProfileController::class, 'accountProfile'])->name('profile');
    Route::get('/logs', [ActivityLogsCotroller::class, 'activityLogs'])->name('logs-list');

    Route::get('/logout', [LoginBasic::class, 'logoutAccount'])->name('logout-process');
});


// authentication

// layout
Route::get('/layouts/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
Route::get('/layouts/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
Route::get('/layouts/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
Route::get('/layouts/container', [Container::class, 'index'])->name('layouts-container');
Route::get('/layouts/blank', [Blank::class, 'index'])->name('layouts-blank');

// pages
Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-connections');
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('pages-misc-under-maintenance');



// cards
Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');

// User Interface
Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

// extended ui
Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');

// icons
Route::get('/icons/boxicons', [Boxicons::class, 'index'])->name('icons-boxicons');

// form elements
Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

// tables
Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');