<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class InstructorController extends Controller
{
    public function index() {
        return view('instructor.login')->with('title', 'Instructor Login');
    }

    public function login(Request $request) {
        $instructorData = $request->validate([
        "instructor_email" => ['required', 'email'],
        "password" => 'required'
        ]);

        
        if (Auth::guard('instructor')->attempt($instructorData)) {
            echo('hello');
        } else {
            echo("error occured");
        }
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

    public function courseCreate(){
        return view('instructor.coursesCreate')->with('title', 'Create Course');
    }

    public function settings(){
        return view('instructor.settings')->with('title', 'Instructor Profile');
    }
}
