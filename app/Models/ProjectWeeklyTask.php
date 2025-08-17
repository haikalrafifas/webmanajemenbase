<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectWeeklyTask extends Model
{
    protected $fillable = ['project_id', 'assigned_to', 'week_number', 'week_start_date', 'week_end_date', 'task_description'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function submissions()
    {
        return $this->hasMany(ProjectWeeklyTaskSubmission::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
