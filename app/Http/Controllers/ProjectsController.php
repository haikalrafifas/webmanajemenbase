<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get(); // Ambil semua project
        return view('projects', compact('projects'));
    }
}
