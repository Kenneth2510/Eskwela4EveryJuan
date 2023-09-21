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

    public function register1(){
        return view('instructor.register1')->with('title', 'Instructor Register');
    }

    public function dashboard(){
        return view('instructor.dashboard')->with('title', 'Instructor Dashboard');
    }

    public function courses(){
        return view('instructor.courses')->with('title', 'Instructor Courses');
    }
}
