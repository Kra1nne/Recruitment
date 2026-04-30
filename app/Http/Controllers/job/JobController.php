<?php

namespace App\Http\Controllers\job;

use App\Http\Controllers\Controller;
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
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Job Posting', 'link' => route('job-posting')],
            ['name' => 'Job Form']
        ];
        return view('content.job_posting.job_form', compact('breadcrumbs'));
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
         $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Job Posting', 'link' => route('job-posting')],
            ['name' => 'Job Form']
        ];
        $jobDetails = Job::whereNull('deleted_at')
            ->where('id', Crypt::decryptString($id))
            ->first();
            
        return view('content.job_posting.job_edit', compact('breadcrumbs', 'jobDetails'));
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
}
