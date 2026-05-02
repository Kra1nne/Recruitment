<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Log;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class EmployeeController extends Controller
{
    public function employeeList(Request $request)
    {
        $employee = Employee::with(['department', 'person']);
        $isSearch = false;
        if($request->search){
            $isSearch = true;
            $employee->where('employee_id', '=', $request->search);
        }
        $employeeList = $employee->orderBy('id', 'desc')->paginate(7);
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Employee List'],
        ];
        return view('content.employee.employee-list', compact('isSearch','breadcrumbs', 'employeeList'));
    }
    public function employeeForm()
    {
        $departmentList = Department::whereNull('deleted_at')->get();
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Employee List', 'link' => route('employee-list')],
            ['name' => 'Employee Form'],
        ];
        return view('content.employee.employee-form', compact('breadcrumbs', 'departmentList'));
    }
    public function employeeAdd(Request $request)
    {
        
        try {
            $personData = [
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'blood_type' => $request->blood_type,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'address' => $request->address,
            ];
            
            $person = Person::create($personData);

            $employeeData = [
                'department_id' => $request->department,
                'person_id' => $person->id,
                'employee_id' => $request->emp_no,
                'start_date' => $request->date,
                'position' => $request->position,
                'salary' => $request->salary,
                'work_status' => $request->work_status,
                'work_arrangement' => $request->work_arrangement,
                'created_at' => now()
            ];
            
            Employee::insert($employeeData);

            $logData = [
                'user_id' => Auth::user()->id,
                'action' => 'Add',
                'table' => 'Employee',
                'description' =>'Addedd a new employee',
                'ip_address' => request()->ip(),
                'created_at' => now(),
            ];

            Log::insert($logData);
            
            return redirect()->back()->with('success', 'Employee created successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Employee unable to create!');
        }
    }
    public function employeeEdit($id)
    {
        $employeeData = Employee::with(['department', 'person'])
            ->where('id', Crypt::decryptString($id))
            ->first();

        $departmentList = Department::whereNull('deleted_at')->get();
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Employee List', 'link' => route('employee-list')],
            ['name' => 'Employee Form'],
        ];
        return view('content.employee.employee-edit', compact('breadcrumbs', 'employeeData', 'departmentList'));
    }
    public function employeeUpdate(Request $request)
    {
        try {
            $personData = [
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'blood_type' => $request->blood_type,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'address' => $request->address,
            ];
            
            Person::where('id', $request->person_id)->update($personData);

            $employeeData = [
                'department_id' => $request->department,
                'person_id' => $request->person_id,
                'employee_id' => $request->emp_no,
                'start_date' => $request->date,
                'position' => $request->position,
                'salary' => $request->salary,
                'work_status' => $request->work_status,
                'work_arrangement' => $request->work_arrangement,
                'created_at' => now()
            ];
            
            Employee::where('id', $request->id)->update($employeeData);

            $logData = [
                'user_id' => Auth::user()->id,
                'action' => 'Update',
                'table' => 'Employee',
                'description' =>'Update a employee',
                'ip_address' => request()->ip(),
                'created_at' => now(),
            ];

            Log::insert($logData);
            
            return redirect()->back()->with('success', 'Employee created successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Employee unable to create!');
        }
    }
    public function employeeDelete($id)
    {
        try {
            $employeeData = Employee::with(['person'])
                ->where('id', $id)
                ->first();

            Person::where('id', $employeeData->person->id)->delete();    
            Employee::where('id', $id)->delete();
            
            $logData = [
                'user_id' => Auth::user()->id,
                'action' => 'Delete',
                'table' => 'Employee',
                'description' =>'Delete a employee',
                'ip_address' => request()->ip(),
                'created_at' => now(),
            ];

            Log::insert($logData);
            return redirect()->back()->with('success', 'Employee deleted successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Employee unable to delete!');
        }
    }
    public function employeeView($id)
    {
         $employeeData = Employee::with(['department', 'person'])
            ->where('id', Crypt::decryptString($id))
            ->first();

        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Employee List', 'link' => route('employee-list')],
            ['name' => 'Employee View'],
        ];
        return view('content.employee.employee-view', compact('employeeData','breadcrumbs'));
    }
}
