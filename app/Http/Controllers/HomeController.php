<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slides = Slide::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $projects = Project::where('is_active', true)
            ->orderBy('sort_order')
            ->with('images')
            ->take(6)
            ->get();

        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('home', compact('slides', 'projects', 'services'));
    }
} 