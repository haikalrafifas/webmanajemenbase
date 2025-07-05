<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectSubmission extends Model
{
    protected $fillable = [
        'user_id',
        'project_id',
        'uraian',
        'files',
        'status',
    'komentar_admin',
    ];

    protected $casts = [
        'files' => 'array', // karena disimpan dalam format JSON
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function project()
{
    return $this->belongsTo(\App\Models\Project::class);
}

}

