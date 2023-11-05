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

        return view('learner_course.courseOverview', compact('course', 'learner', 'isEnrolled'))
        ->with([
            'title' => 'Course Overview',
            'scripts' => ['L_course_manage.js']
        ]);
    
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

    public function manage_course(Request $request, Course $course) {
        if (auth('learner')->check()) {
            $learner = session('learner');
            // dd($instructor);

            try {

                $search_by = $request->input('searchBy');
                $search_val = $request->input('searchVal');

                $filter_date = $request->input('filterDate');
                $filter_status = $request->input('filterStatus');

      
                $course = DB::table('course')
                ->select(
                    "course.course_id",
                    "course.course_name",
                    "course.course_code",
                    "course.course_status",
                    "course.course_difficulty",
                    "course.course_description",
                    "course.created_at",
                    "course.updated_at",
                    "instructor.instructor_lname",
                    "instructor.instructor_fname",
                )
            ->where('course.course_id', $course->course_id)
            ->join('instructor', 'instructor.instructor_id', '=', 'course.instructor_id')
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

            $enrolleesQuery = DB::table('learner_course')
            ->select(
                'learner_course.learner_course_id',
                'learner_course.learner_id',
                'learner_course.status',
                'learner_course.created_at',
                'learner.learner_fname',
                'learner.learner_lname',
                'learner.learner_email'
            )
            ->join('learner', 'learner_course.learner_id', '=', 'learner.learner_id')
            ->orderBy('learner_course.created_at','DESC')
            ->where('learner_course.course_id', '=', $course->course_id);

            if(!empty($filter_date) || !empty($filter_status)) {
                if(!empty($filter_date) && empty($filter_date)) {
                    $enrolleesQuery->where('learner_course.created_at', 'LIKE', $filter_date.'%');
                } elseif (empty($filter_date) && !empty($filter_status)) {
                    $enrolleesQuery->where('learner_course.status', 'LIKE', $filter_status.'%');
                } else {
                    $enrolleesQuery->where('learner_course.created_at', 'LIKE', $filter_date.'%')
                        ->where('learner_course.status', 'LIKE', $filter_status.'%');
                }
            }

            if(!empty($search_by) && !empty($search_val)) {
                if($search_by == 'name') {
                    $enrolleesQuery->where(function ($enrolleesQuery) use ($search_val) {
                        $enrolleesQuery->where('learner.learner_fname', 'LIKE', $search_val.'%')
                            ->orWhere('learner.learner_lname', 'LIKE', $search_val.'%');
                    });
                } else if ($search_by == 'learner_course_id') {
                    $enrolleesQuery->where('learner_course.'.$search_by, 'LIKE', $search_val.'%');
                } else {
                    $enrolleesQuery->where('learner.'.$search_by, 'LIKE', $search_val. '%');
                }
            }

            $enrollees = $enrolleesQuery->get();


            } catch (\Exception $e) {
                dd($e->getMessage());
            }

        } else {
            return redirect('/learner');
        }

        $response = [
            'course' => $course,
            'enrollees' => $enrollees,
            'isEnrolled' => $isEnrolled,
            'filterDate' => $filter_date,
            'filterStatus' => $filter_status,
            'searchBy' => $search_by,
            'searchVal' => $search_val,
        ];

        return response()->json($response);
    }

}
