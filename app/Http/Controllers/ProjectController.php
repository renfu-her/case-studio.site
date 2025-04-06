<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('is_active', true)
            ->orderByDesc('created_at')
            ->with('images')
            ->paginate(12);

        return view('projects.index', compact('projects'));
    }

    public function show($id)
    {
        $project = Project::where('is_active', true)
            ->with('images')
            ->findOrFail($id);

        return view('projects.show', compact('project'));
    }
}
