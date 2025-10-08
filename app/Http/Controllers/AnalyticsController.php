<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Deal;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Umumiy statistika
        $totalLeads = Lead::count();
        $convertedLeads = Lead::where('status', 'Converted')->count();
        $activeLeads = Lead::where('status', '!=', 'Converted')->count();

        $totalDeals = Deal::count();
        $wonDeals = Deal::where('status', 'Won')->count();
        $lostDeals = Deal::where('status', 'Lost')->count();

        // Oylar bo‘yicha leadlar
        $leadsByMonth = Lead::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        // Haftalar bo‘yicha deals summasi
        $dealsByWeek = Deal::selectRaw('WEEK(created_at) as week, SUM(amount) as total')
            ->groupBy('week')
            ->pluck('total', 'week');

        return view('analytics.index', compact(
            'totalLeads',
            'convertedLeads',
            'activeLeads',
            'totalDeals',
            'wonDeals',
            'lostDeals',
            'leadsByMonth',
            'dealsByWeek'
        ));
    }
}

