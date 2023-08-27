<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function index() {
        return view('instructor.login')->with('title', 'Instructor Login');
    }

    public function register(){
        return view('instructor.register')->with('title', 'Instructor Register');
    }
}
