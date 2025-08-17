<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_project',
        'pic',
        'fokus',
        'skema',
        'tahun',
        'start_date',
        'end_date',
        'week',
        'komentar_awal',
        'status',
        'output',
    ];

     // Relasi: satu project memiliki banyak weekly task
    public function weeklyTasks()
    {
        return $this->hasMany(ProjectWeeklyTask::class);
    }
}
