<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Mail\ApplicationMail;
use App\Models\Applicant;
use App\Models\Job;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function landingPage()
    {
        return view('content.home.landingpage');
    }
    public function jobPage()
    {
        $query = Job::with('applicants')
            ->where('expired_at', '>=', now())
            ->whereNull('deleted_at');

        $jobList = $query->orderBy('id', 'desc')->paginate(7)->withQueryString();

        return view('content.home.job', compact('jobList'));
    }
    public function jobForm($id)
    {
        $decrypted_id = Crypt::decryptString($id);
        
        return view('content.home.job-form', compact('decrypted_id'));
    }
    public function jobApplicant(Request $request)
    {
        try {
            $person = [
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'blood_type' => $request->blood_type,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'address' => $request->address,
                'created_at' => now()
            ];
            $personDetails = Person::create($person);
            $applicants = [
                'person_id' => $personDetails->id,
                'job_id' => $request->job_id,
                'status' => 'Apply',
                'date' => now()->toDateString(),
                'created_at' => now()
            ];
            Applicant::insert($applicants);
            $jobDetail = Job::where('id', $request->job_id)->whereNull('deleted_at')->first();
            $mailContent = [
                'status' => 'applied',
                'position' => $jobDetail->position,
                'name' => $request->first_name
            ];

            Mail::to($request->email)->send(new ApplicationMail($mailContent));

            return redirect()->back()->with('success', 'Job applicantion sumbit successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Job applicantion unable to submit!');
        }
    }
}
