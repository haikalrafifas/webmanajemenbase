<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MyActivityController extends Controller
{
   public function index()
{
    $startOfWeek = now()->startOfWeek()->toDateString();

    $activity = Activity::where('user_id', Auth::id())
        ->where('week_start_date', $startOfWeek)
        ->first();

    return view('anggota.myactivity', compact('activity'));
}


    public function store(Request $request)
    {
        $request->validate(['content' => 'required|string']);

        $startOfWeek = now()->startOfWeek()->toDateString();

        Activity::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'week_start_date' => $startOfWeek
            ],
            [
                'content' => $request->content
            ]
        );

      return redirect()->route('member.activity')->with('success', 'Aktivitas minggu ini berhasil disimpan!');
    }

 public function adminReportView()
{
    $reports = Activity::with('user')->get()->groupBy('user_id');
    $users = User::whereIn('id', $reports->keys())->get();

    // Ambil 4 minggu terakhir (misalnya)
    $weeks = collect();
    for ($i = 0; $i < 4; $i++) {
        $weeks->push(Carbon::now()->startOfWeek()->subWeeks($i)->toDateString());
    }
    $weeks = $weeks->sort(); // urutkan dari minggu lama ke terbaru

    return view('admin.activityreport', compact('reports', 'users', 'weeks'));
}

public function updateScores(Request $request)
{
    foreach ($request->entries as $userId => $weeks) {
        foreach ($weeks as $week => $data) {
            if (!isset($data['activity_id'])) continue;

            $activity = Activity::find($data['activity_id']);
            if ($activity) {
                $activity->score = $data['score'];
                $activity->save();
            }
        }
    }

    return redirect()->back()->with('success', 'Nilai berhasil diperbarui!');
}

}
