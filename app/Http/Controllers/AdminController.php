<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index')->with('title', 'Eskwela4EveryJuan Admin');
    }

    public function dashboard() {
        return view('admin.dashboard')->with('title', 'Admin Dashboard');
    }

    public function learners() {
        return view('admin.learners')->with('title', 'Learner Management');
    }
}
