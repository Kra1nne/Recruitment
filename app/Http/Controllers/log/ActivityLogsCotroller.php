<?php

namespace App\Http\Controllers\log;

use App\Http\Controllers\Controller;
use App\Models\Log;

class ActivityLogsCotroller extends Controller
{
    public function activityLogs()
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Activity Logs'],
        ];
        $logs = Log::with('user.person')->orderBy('id', 'desc')->paginate(8);
        
        return view('content.activity_logs.activity-logs', compact('breadcrumbs', 'logs'));
    }
}
