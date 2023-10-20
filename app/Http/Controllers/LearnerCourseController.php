<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Learner;
use App\Models\Instructor;
use App\Models\Admin;
use App\Models\Course;
use App\Models\LearnerCourse;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Profiler\Profile;

class LearnerCourseController extends Controller
{
    public function courses (){
        if (auth('learner')->check()) {
            $learner = session('learner');
            // dd($instructor);

            try {
                $query = DB::table('learner_course')
                ->select(
                    'learner_course.learner_course_id',
                    'learner_course.course_id',
                    'learner_course.status',
                    'learner_course.created_at',
                    'course.course_name',
                    'course.course_code',
                    'course.course_status',
                    'course.course_difficulty',
                    'instructor.instructor_fname',
                    'instructor.instructor_lname',
                    'instructor.profile_picture'
                )
                ->join('course','learner_course.course_id','=','course.course_id')
                ->join('instructor' , 'course.instructor_id', '=', 'instructor.instructor_id')
                ->where('learner_course.learner_id', '=', $learner->learner_id);

                $learnerCourse = $query->get();

            } catch (\Exception $e) {
                dd($e->getMessage());
            }

        } else {
            return redirect('/learner');
        }

        // return view('instructor_course.courses' , compact('instructor'))->with('title', 'Instructor Courses');
        return view('learner_course.courses', compact('learner', 'learnerCourse'))->with('title', 'My Courses');
    }

    public function overview(Course $course) {
        // if (auth('learner')->check()) {
        //     $learner = session('learner');
        //     // dd($instructor);

        // } else {
        //     return redirect('/learner');
        // }

        // // return view('instructor_course.courses' , compact('instructor'))->with('title', 'Instructor Courses');
        // return view('learner_course.courseOverview', compact('learner'))->with('title', 'My Courses');
    
    
        if (auth('learner')->check()) {
            $learner = session('learner');
            // dd($instructor);

            try {
                $course = DB::table('course')
                ->where('course_id', $course->course_id)
                ->first();

                $isEnrolled = DB::table('learner_course')
                ->select(  
                'learner_course.learner_course_id',
                'learner_course.course_id',
                'learner_course.status',
                'learner_course.created_at')
                ->join('course', 'learner_course.course_id', '=', 'course.course_id')
                ->where('learner_course.learner_id', '=', $learner->learner_id)
                ->where('learner_course.course_id', '=', $course->course_id)
                ->first();

            } catch (\Exception $e) {
                dd($e->getMessage());
            }

        } else {
            return redirect('/learner');
        }

        return view('learner_course.courseOverview', compact('course', 'learner', 'isEnrolled'))->with('title', 'Course Overview');
    
    }

    public function enroll_course(Course $course) {
        if (auth('learner')->check()) {
            $learner = session('learner');

            if($learner->status !== 'Approved') {
                session()->flash('message', 'Account is not yet Approved');
                return response()->json(['message' => 'Account is not yet Approved', 'redirect_url' => "/learner/course/$course->course_id"]);
            } else {
                try {
                    $courseEnrollData = ([
                        "learner_id" => $learner->learner_id,
                        "course_id" => $course->course_id,
                    ]);

                    LearnerCourse::create($courseEnrollData);

                    session()->flash('message', 'Course enrolled Successfully');
                    return response()->json(['message' => 'Course enrolled successfully', 'redirect_url' => '/learner/courses']);
                

                } catch (ValidationException $e) {
                    $errors = $e->validator->errors();
        
                    return response()->json(['errors' => $errors], 422); 
                }
            }
        } else {
            return redirect('/learner');
        }
    }

    public function unEnroll_course(LearnerCourse $learnerCourse) {
        // dd($learnerCourse);
        if (auth('learner')->check()) {
            $learner = session('learner');

            try {
                $learnerCourse->delete();

                session()->flash('message', 'Course unenrolled Successfully');
                return response()->json(['message' => 'Course unenrolled successfully', 'redirect_url' => "/learner/courses"]);
                
            
            } catch (ValidationException $e) {
                $errors = $e->validator->errors();        
                return response()->json(['errors' => $errors], 422);
            }
        } else {
            return redirect('/learner');
        }
    }

}
