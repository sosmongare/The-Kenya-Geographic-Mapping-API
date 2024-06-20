<?php

namespace App\Http\Controllers;

use App\Models\ApiLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ApiLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ApiLog::query();

        if ($request->filled('method')) {
            $query->where('method', $request->method);
        }
        if ($request->filled('url')) {
            $query->where('url', 'like', '%' . $request->url . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $logs = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('apilogs.index', compact('logs'));
    }

    public function endpointUsage()
    {
        $endpointUsage = ApiLog::selectRaw('endpoint, COUNT(*) as hits')
            ->groupBy('endpoint')
            ->orderBy('hits', 'desc')
            ->get();

        return view('apilogs.endpoint_usage', compact('endpointUsage'));
    }

    public function show($id)
    {
        $log = ApiLog::findOrFail($id);
        return view('apilogs.show', compact('log'));
    }

    public function analytics()
    {
        $dailyRequests = ApiLog::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $statuses = ApiLog::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->orderBy('status')
            ->get();

        $totalRequests = ApiLog::count();
        $successfulRequests = ApiLog::where('status', 200)->count();
        $failedRequests = ApiLog::where('status', '!=', 200)->count();

        return view('apilogs.analytics', compact('dailyRequests', 'statuses', 'totalRequests', 'successfulRequests', 'failedRequests'));
    }
}
