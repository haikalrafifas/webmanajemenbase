<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BaseProjectController extends Controller
{
    public function index()
{
    $projects = \App\Models\Project::all();
    return view('admin.baseproject', compact('projects'));
}

}
