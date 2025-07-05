<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectWeeklyTask extends Model
{
    protected $fillable = ['project_id', 'week_start_date', 'task_description'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function submissions()
    {
        return $this->hasMany(ProjectWeeklyTaskSubmission::class);
    }
}
