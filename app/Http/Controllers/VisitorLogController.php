<?php

namespace App\Http\Controllers;

use App\Models\VisitorLog;
use Illuminate\Http\Request;

class VisitorLogController extends Controller
{
    public function footerStats()
    {
        $today = VisitorLog::whereDate('created_at', now())->count();
        $week = VisitorLog::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $year = VisitorLog::whereYear('created_at', now()->year)->count();
        $total = VisitorLog::count();

        return view('layouts.footer', compact('today', 'week', 'year', 'total'));
    }

}
