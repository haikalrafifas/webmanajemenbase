<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminStatisticsController extends Controller
{
    public function index()
    {
        $leaderboard = Activity::select('user_id', DB::raw('SUM(score) as total_score'))
            ->groupBy('user_id')
            ->with('user') // pastikan relasi user tersedia di model Activity
            ->orderByDesc('total_score')
            ->get();

        return view('admin.statistics', compact('leaderboard'));
    }
}