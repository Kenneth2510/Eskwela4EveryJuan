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

    public function add_learner() {
        return view('admin.add_learner')->with('title' , 'Add New Learner');
    }

    public function view_learner() {
        return view('admin.view_learner')->with('title' , 'View Learner');
    }
}
