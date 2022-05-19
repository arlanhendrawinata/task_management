<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class GlobalSearchController extends Controller
{
    public function search()
    {
        $projects = Project::select('judul_project')->get();
        return response()->json($projects);
    }
}
