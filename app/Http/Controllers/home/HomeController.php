<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Job;

class HomeController extends Controller
{
    public function landingPage()
    {
        return view('content.home.landingpage');
    }
    public function jobPage()
    {
        $query = Job::with('applicants')->whereNull('deleted_at');

        $jobList = $query->orderBy('id', 'desc')->paginate(7)->withQueryString();

        return view('content.home.job', compact('jobList'));
    }
}
