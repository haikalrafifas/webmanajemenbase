<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminStatisticsController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        // Leaderboard Sepanjang Masa
        $leaderboardAllTime = Activity::selectRaw('user_id, SUM(score) as total_score')
            ->groupBy('user_id')
            ->with('user')
            ->orderByDesc('total_score')
            ->get();

        // Leaderboard Bulan Ini
        $leaderboardThisMonth = Activity::whereMonth('week_start_date', $now->month)
            ->whereYear('week_start_date', $now->year)
            ->selectRaw('user_id, SUM(score) as total_score')
            ->groupBy('user_id')
            ->with('user')
            ->orderByDesc('total_score')
            ->get();

        // Leaderboard Minggu Ini
        $startOfWeek = $now->copy()->startOfWeek(Carbon::MONDAY); // Mulai dari Senin
        $endOfWeek = $now->copy()->endOfWeek(Carbon::SUNDAY);     // Sampai Minggu

        $leaderboardThisWeek = Activity::whereBetween('week_start_date', [$startOfWeek, $endOfWeek])
            ->selectRaw('user_id, SUM(score) as total_score')
            ->groupBy('user_id')
            ->with('user')
            ->orderByDesc('total_score')
            ->get();

        return view('admin.statistics', compact(
            'leaderboardAllTime',
            'leaderboardThisMonth',
            'leaderboardThisWeek'
        ));
    }
}