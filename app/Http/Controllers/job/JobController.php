<?php

namespace App\Http\Controllers\job;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\ApplicantLog;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Job;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class JobController extends Controller
{
    public function jobList(Request $request)
    {
        $query = Job::with('applicants')->whereNull('deleted_at');

        $isSearch = false;

        if ($request->filled('search')) {
            $isSearch = true;
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                ->orWhere('company', 'like', "%$search%")
                ->orWhere('location', 'like', "%$search%");
            });
        }

        if ($request->filled('type')) {
            $isSearch = true;
            $query->where('work_status', $request->type);
        }

        $jobList = $query->orderBy('id', 'desc')->paginate(7)->withQueryString();

        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Job Posting'],
        ];

        return view('content.job_posting.job_list', compact('isSearch','breadcrumbs','jobList'));
    }
    public function jobForm()
    {
        $departmentList = Department::whereNull('deleted_at')->orderBy('id', 'desc')->get();
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Job Posting', 'link' => route('job-posting')],
            ['name' => 'Job Form']
        ];
        return view('content.job_posting.job_form', compact('breadcrumbs', 'departmentList'));
    }
    public function jobAdd(Request $request)
    {
        try {
             $data =  [
                'title' => $request->title,
                'company' => $request->company,
                'position' => $request->position,
                'salary' => $request->salary,
                'work_status' => $request->work_status,
                'work_arrangement' => $request->work_arrangement,
                'status' => $request->status,
                'expired_at' => $request->expired_at,
                'location' => $request->location,
                'description' => $request->description,
                'department_id' => $request->department,
                'created_at' => now()
            ];
            Job::insert($data);

            $logData = [
                'user_id' => Auth::user()->id,
                'action' => 'Add',
                'table' => 'Job',
                'description' =>'Added a new department',
                'ip_address' => request()->ip(),
                'created_at' => now(),
            ];

            Log::insert($logData);
            return redirect()->back()->with('success', 'Job created successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Job unable to create!');
        }
    }
    public function jobEdit($id)
    {
        $departmentList = Department::whereNull('deleted_at')->orderBy('id', 'desc')->get();
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Job Posting', 'link' => route('job-posting')],
            ['name' => 'Job Form']
        ];
        $jobDetails = Job::whereNull('deleted_at')
            ->where('id', Crypt::decryptString($id))
            ->first();
            
        return view('content.job_posting.job_edit', compact('breadcrumbs', 'jobDetails', 'departmentList'));
    }
    public function jobUpdate(Request $request)
    {
        try {
             $data =  [
                'title' => $request->title,
                'company' => $request->company,
                'position' => $request->position,
                'salary' => $request->salary,
                'work_status' => $request->work_status,
                'work_arrangement' => $request->work_arrangement,
                'status' => $request->status,
                'expired_at' => $request->expired_at,
                'location' => $request->location,
                'description' => $request->description,
                'department_id' => $request->department,
                'updated_at' => now()
            ];
            Job::where('id', $request->id)->update($data);

            $logData = [
                'user_id' => Auth::user()->id,
                'action' => 'Update',
                'table' => 'Job',
                'description' =>'Update a department',
                'ip_address' => request()->ip(),
                'created_at' => now(),
            ];

            Log::insert($logData);
            return redirect()->back()->with('success', 'Job updated successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Job unable to update!');
        }
    }
    public function jobDelete($id)
    {
        try {
            Job::where('id', $id)->delete();

            $logData = [
                'user_id' => Auth::user()->id,
                'action' => 'Delete',
                'table' => 'Job',
                'description' =>'Delete a department',
                'ip_address' => request()->ip(),
                'created_at' => now(),
            ];

            Log::insert($logData);
            return redirect()->back()->with('success', 'Job deleted successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Job unable to delete!');
        }
    }
    public function jobView(Request $request, $id)
    {
        $job_id = $id;
        $isSearch = false;
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Job Posting', 'link' => route('job-posting')],
            ['name' => 'Job View']
        ];
        $query = Applicant::with('person', 'latestApplicantLogs')
            ->where('job_id', Crypt::decryptString($id));

        if ($request->filled('search')) {
            $isSearch = true;
            $search = $request->search;

            $query->whereHas('person', function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                ->orWhere('middle_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%");
            });
        }
        $jobApplicants = $query->orderBy('id', 'desc')->paginate(7);
        
        return view('content.job_posting.job_view', compact('breadcrumbs', 'isSearch', 'job_id', 'jobApplicants'));
    }
    public function jobApplicantForm($id)
    {   
        $decrypted_id  = Crypt::decryptString($id);
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Job Posting', 'link' => route('job-posting')],
            ['name' => 'Job Applicants', 'link' =>  route('job-view', $id)],
            ['name' => 'Job Form'],
        ];
        return view('content.job_posting.job_applicant', compact('breadcrumbs', 'decrypted_id'));
    }
    public function accepted($id)
    {
        // add a send mail
        try {
            $applicant = Applicant::where('id', Crypt::decryptString($id))->first();
            
            $jobDetails = Job::where('id', $applicant->job_id)->first();
            $data = [
                'status' => 'Accepted',
                'updated_at' => now()
            ];

            $applicant->update($data);

            $employeeData = [
                'department_id' => $jobDetails->department_id,
                'person_id' => $applicant->person_id,
                'employee_id' => 'EMP_00'.$applicant->person_id, 
                'start_date' => now()->toDateString(),
                'position' => $jobDetails->position,
                'salary' => $jobDetails->salary,
                'work_status' => $jobDetails->work_status,
                'work_arrangement' => $jobDetails->work_arrangement,
            ];
      
            Employee::insert($employeeData);
            return redirect()->back()->with('success', 'Applicant accepted successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Job unable to accepted the applicant!');
        }
    }
    public function rejected($id)
    {
        // add a send mail
        try {
            $data = [
                'status' => 'Rejected',
                'updated_at' => now()
            ];

            Applicant::where('id', Crypt::decryptString($id))->update($data);
            return redirect()->back()->with('success', 'Applicant rejected successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Job unable to reject the applicant!');
        }

    }
    public function applicantAssessment($id)
    {
        $applicant = Applicant::with('person')
            ->where('id', Crypt::decryptString($id))
            ->first();
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Job Posting', 'link' => route('job-posting')],
            ['name' => 'Job Applicants', 'link' =>  route('job-view', Crypt::encryptString($applicant->job_id))],
            ['name' => 'Job Assessment'],
        ];

        return view('content.job_posting.job_assessment', compact('breadcrumbs', 'applicant'));
    }
    public function applicantAssessmentSend(Request $request)
    {
        // add a send mail
        try {
            $data = [
                'applicant_id' => $request->id,
                'assessment_type' => $request->assessment_type,
                'date' => $request->date,
                'source_type' => $request->place,
                'notes' => $request->notes,
                'created_at' => now()
            ];

            ApplicantLog::insert($data);
            return redirect()->back()->with('success', 'Assessment sent successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Assessment unable to sent to the applicant!');
        }   
    }
}
