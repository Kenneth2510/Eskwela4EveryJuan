<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Learner;
use App\Models\Instructor;
use App\Models\Admin;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\Support\Facades\Log;

class InstructorController extends Controller
{
    public function index() {
        return view('instructor.login')->with('title', 'Instructor Login');
    }

    public function login_process(Request $request) {
        
        $instructorData = $request->validate([
            "instructor_username" =>  ['required'],
            "password" =>  ['required'],
        ]);

        if (auth('instructor')->attempt($instructorData)) {
            $instructor = auth('instructor')->user();
            $instructor = Instructor::find($instructor->instructor_id);
            // dd($instructor);

            if($instructor) {
                $request->session()->put("instructor_authenticated", true);
                // dd($request->session()->get("instructor_authenticated"));
            }
            
            // $request->session()->regenerate();
    
            return redirect('/instructor/authenticate')->with('message', "Welcome Back");
        }

        
        return back()->withErrors(['instructor_username' => 'Login Failed'])->withInput($request->except('password'));

    }

    public function login_authentication(Request $request) {
        if (!$request->session()->has('instructor_authenticated')) {
            dd($request->session()->get('instructor_authenticated'));
            return redirect(route('instructor.login'))->withErrors(['instructor_username' => 'Authentication Required']);
        }

        
        // dd($request->session()->get('instructor_authenticated'));
        return view('instructor.authenticate')->with('title', 'Instructor Login');

    }

    public function authenticate_instructor(Request $request) {

        if (!$request->session()->has('instructor_authenticated')) {
            // dd($request->session()->get('instructor_authenticated'));
            return redirect(route('instructor.login'))->withErrors(['instructor_username' => 'Authentication Required']);
        }
            // dd($request);
        $codeNumber = $request->validate([
            "security_code_1" => ['required', 'numeric'],
            "security_code_2" => ['required', 'numeric'],
            "security_code_3" => ['required', 'numeric'],
            "security_code_4" => ['required', 'numeric'],
            "security_code_5" => ['required', 'numeric'],
            "security_code_6" => ['required', 'numeric'],
        ]);

        $securityCodeNumber = implode('', $codeNumber);

        $instructor = auth('instructor')->user();
        $instructorSecurityCode = $instructor->instructor_security_code;



        if ($securityCodeNumber === $instructorSecurityCode) {
            $request->session()->forget('instructor_authenticated');

            // $request->session()->regenerate();
            return redirect('/instructor/dashboard')->with('message', 'Authenticated Successfully');
        }

        // return back()->withErrors(['security_code' => 'Invalid Security Code']);
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
