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
use Illuminate\Support\Facades\Auth;

class InstructorCourseController extends Controller
{
    public function courses(){
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            

            try {
                $query = DB::table('course')
                    ->select(
                        "course.course_id",
                        "course.course_name",
                        "course.course_code",
                        "instructor.instructor_lname",
                        "instructor.instructor_fname",
                        "instructor.profile_picture"
                    )
                ->where('course.instructor_id', '=', $instructor['instructor_id'])
                ->join('instructor', 'instructor.instructor_id', '=', 'course.instructor_id')
                ->orderBy("course.course_name", "ASC");

                $courses = $query->paginate(8);

            } catch (\Exception $e) {
                dd($e->getMessage());
            }

        } else {
            return redirect('/instructor');
        }

        return view('instructor_course.courses' , compact('instructor', 'courses'))->with('title', 'My Courses');
    }


    
    public function courseCreate(){
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            // dd($instructor);

            // $color = '#' . Str::random(6);
            // dd($color);

        } else {
            return redirect('/instructor');
        }
        return view('instructor_course.coursesCreate', compact('instructor'))
        ->with(['title' => 'Creeate Course',
                'scripts' => ['instructor_course_create.js']]);
        
    }

    public function courseCreate_process(Request $request) {
        $instructor = session('instructor');

        if($instructor['status'] !== 'Approved') {
            session()->flash('message', 'Account is not yet Approved');
            return response()->json(['message' => 'Account is not yet Approved', 'redirect_url' => '/instructor/courses']);
        } else {
            try {
                $courseData = $request->validate([
                    'course_name' => ['required'],
                    'course_description' => ['required'],
                    'course_difficulty' => ['required'],
                ]);
        
                $courseData['course_code'] = Str::random(6);
                $courseData['instructor_id'] = $instructor['instructor_id'];
    
                
                $folderName = $courseData['course_name'];
                $folderPath = 'public/courses/' . $folderName;
    
                if(!Storage::exists($folderPath)) {
                    Storage::makeDirectory($folderPath);
                }
    
                Course::create($courseData);
    
                session()->flash('message', 'Course created Successfully');
                return response()->json(['message' => 'Course created successfully', 'redirect_url' => '/instructor/courses']);
            } catch (ValidationException $e) {
                $errors = $e->validator->errors();
        
                return response()->json(['errors' => $errors], 422);
            }
        }
    }


    
    public function overview(Course $course){
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            // dd($instructor);

            try {
                $course = DB::table('course')
                ->where('course_id', $course->course_id)
                ->first();

            } catch (\Exception $e) {
                dd($e->getMessage());
            }

        } else {
            return redirect('/instructor');
        }

        return view('instructor_course.courseOverview', compact('course'))
        ->with([
            'title' => 'Course Overview',
            'scripts' => ['instructor_course_manage.js'],
        ]
        );
    }

    public function manage_course(Request $request, Course $course) {
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
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
            return redirect('/instructor');
        }

        $response = [
            'course' => $course,
            'enrollees'=> $enrollees,
            'filterDate' => $filter_date,
            'filterStatus' => $filter_status,
            'searchBy' => $search_by,
            'searchVal' => $search_val,
        ];

        return response()->json($response);
    }



    public function update_course(Course $course, Request $request) {
        $instructor = session('instructor');

        if($instructor['status'] !== 'Approved') {
            session()->flash('message', 'Account is not yet Approved');
            return response()->json(['message' => 'Account is not yet Approved', 'redirect_url' => '/instructor/courses']);
        } else {
            try {
                $courseData = $request->validate([
                    'course_name' => ['required'],
                    'course_description' => ['required'],
                    'course_difficulty' => ['required'],
                ]);

                $course->update($courseData);

                session()->flash('message', 'Course updated Successfully');
                return response()->json(['message' => 'Course updated successfully', 'redirect_url' => "/instructor/course/$course->course_id"]);
                
            
            } catch (ValidationException $e) {
                // dd($e->getMessage());
                $errors = $e->validator->errors();        
                return response()->json(['errors' => $errors], 422);
            }
        }
    }

    public function delete_course(Course $course) {
        $instructor = session('instructor');

        if($instructor['status'] !== 'Approved') {
            session()->flash('message', 'Account is not yet Approved');
            return response()->json(['message' => 'Account is not yet Approved', 'redirect_url' => '/instructor/courses']);
        } else {
            try {
                $course->delete();


                session()->flash('message', 'Course deleted Successfully');
                return response()->json(['message' => 'Course deleted successfully', 'redirect_url' => "/instructor/courses"]);
                
            
            } catch (ValidationException $e) {
                // dd($e->getMessage());
                $errors = $e->validator->errors();        
                return response()->json(['errors' => $errors], 422);
            }
        }


    }

    public function content(){
        return view('instructor_course.courseContent')->with('title', 'Course Content');
    }
    public function syllabus(){
        return view('instructor_course.courseSyllabus')->with('title', 'Course Content');
    }
    public function lesson(){
        return view('instructor_course.courseLesson')->with('title', 'Course Content');
    }


}
