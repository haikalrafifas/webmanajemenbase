<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectWeeklyTaskSubmission extends Model
{
    protected $fillable = ['project_weekly_task_id', 'user_id', 'submitted_at'];

    public function task()
    {
        return $this->belongsTo(ProjectWeeklyTask::class, 'project_weekly_task_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
