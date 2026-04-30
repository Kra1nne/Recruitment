<?php

namespace App\Http\Controllers\department;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class DepartmentController extends Controller
{
    public function departmentList(Request $request)
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Department List'],
        ];
        $query = Department::with('employees')->whereNull('deleted_at');
        $employee = Employee::whereNull('deleted_at');
        $isSearch = false;
        if($request->search){
            $isSearch = true;
            $query->where('dept_name', 'like', '%'.$request->search.'%');
        }

        $departmentList = $query->orderBy('id', 'desc')->paginate(7);

        $activeCount = $query->where('status', '=', 'Active')->count();
        $inactiveCount = Department::whereNotNull('deleted_at')->count();

        $employeeCount = $employee->count();

        return view('content.department.department-list', compact('breadcrumbs', 'isSearch','departmentList', 'query', 'activeCount', 'employeeCount', 'inactiveCount'));
    }
    public function departmentForm()
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Department List', 'link' => route('department-list')],
            ['name' => 'Department Form'],
        ];
        return view('content.department.department-form', compact('breadcrumbs'));
    }
    public function departmentFormEdit($id)
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Department List', 'link' => route('department-list')],
            ['name' => 'Department Form'],
        ];
        $dept = Department::whereNull('deleted_at')
            ->where('id', Crypt::decryptString($id))
            ->first();

        return view('content.department.department-edit', compact('breadcrumbs', 'dept'));
    }
    public function departmentAdd(Request $request)
    {
        try {
            $data = [
                'dept_name' => $request->name,
                'status' => 'Active',
                'description' => $request->description,
                'date' => $request->date,
                'created_at' => now()
            ];

            Department::insert($data);
            $logData = [
                'user_id' => Auth::user()->id,
                'action' => 'Add',
                'table' => 'Department',
                'description' =>'Added a new department',
                'ip_address' => request()->ip(),
                'created_at' => now(),
            ];

            Log::insert($logData);

            return redirect()->back()->with('success', 'Department created successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Department unable to create!');
        }
    }
    public function departmentUpdate(Request $request)
    {
        try {
            $data = [
                'dept_name' => $request->name,
                'status' => 'Active',
                'description' => $request->description,
                'date' => $request->date,
                'updated_at' => now()
            ];

            Department::where('id', $request->id)->update($data);
            $logData = [
                'user_id' => Auth::user()->id,
                'action' => 'Update',
                'table' => 'Department',
                'description' =>'Update a department',
                'ip_address' => request()->ip(),
                'created_at' => now(),
            ];

            Log::insert($logData);
            return redirect()->back()->with('success', 'Department updated successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Department unable to update!');
        }
    }
    public function departmentDelete($id)
    {
        $employeeCount = Employee::where('department_id', '=', Crypt::decryptString($id))->whereNull('deleted_at')->count();
        if($employeeCount > 0){
            return redirect()->back()->with('warning', 'Remove the employee first before you delete this department!');
        }
        try {
            Department::where('id', Crypt::decryptString($id))->delete();

            $logData = [
                'user_id' => Auth::user()->id,
                'action' => 'Delete',
                'table' => 'Department',
                'description' =>'Delete a department',
                'ip_address' => request()->ip(),
                'created_at' => now(),
            ];

            Log::insert($logData);
            return redirect()->back()->with('success', 'Department deleted successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Department unable to delete!');
        }
    }
}
