<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $projects = Project::with('images')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('home', compact('slides', 'projects'));
    }
} 