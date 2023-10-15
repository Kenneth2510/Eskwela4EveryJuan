<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LearnerCourseController extends Controller
{
    public function courses (){
        if (auth('learner')->check()) {
            $learner = session('learner');
            // dd($instructor);

        } else {
            return redirect('/learner');
        }

        // return view('instructor_course.courses' , compact('instructor'))->with('title', 'Instructor Courses');
        return view('learner_course.courses', compact('learner'))->with('title', 'My Courses');
    }

    public function overview() {
        if (auth('learner')->check()) {
            $learner = session('learner');
            // dd($instructor);

        } else {
            return redirect('/learner');
        }

        // return view('instructor_course.courses' , compact('instructor'))->with('title', 'Instructor Courses');
        return view('learner_course.courseOverview', compact('learner'))->with('title', 'My Courses');
    }
}
