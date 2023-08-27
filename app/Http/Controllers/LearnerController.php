<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LearnerController extends Controller
{
    public function index() {
        return view('learner.login')->with('title', 'Learner Login');
    }

    public function register(){
        return view('learner.register')->with('title', 'Learner Register');
    }
}
