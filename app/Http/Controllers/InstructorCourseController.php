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
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Profiler\Profile;

class InstructorCourseController extends Controller
{
    public function courses(){
        return view('instructor_course.courses')->with('title', 'Instructor Courses');
    }

    public function courseCreate(){
        return view('instructor_course.coursesCreate')->with('title', 'Create Course');
    }

}
