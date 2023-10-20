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
        return view('instructor_course.coursesCreate', compact('instructor'))->with('title', 'Create Course');
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

        return view('instructor_course.courseOverview', compact('course'))->with('title', 'Course Overview');
    }

    public function manage_course(Request $request, Course $course) {
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            // dd($instructor);

            try {
                // $course = DB::table('course')
                // ->where('course_id', $course->course_id)
                // ->first();


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
            ->where('learner_course.course_id', '=', $course->course_id);

            // Filtering by Date
            if ($request->has('filterDate')) {
                $enrolleesQuery->whereDate('learner_course.created_at', '=', $request->input('filterDate'));
            }

            // Filtering by Status
            if ($request->has('filterStatus')) {
                $enrolleesQuery->where('learner_course.status','=', $request->filterStatus);
            }

            // Searching
            if ($request->has('searchBy') && $request->has('searchVal')) {
                $searchBy = $request->input('searchBy');
                $searchVal = $request->input('searchVal');
                $enrolleesQuery->where($searchBy, 'LIKE', "%$searchVal%");
            }

            $enrollees = $enrolleesQuery->get();


            } catch (\Exception $e) {
                dd($e->getMessage());
            }

        } else {
            return redirect('/instructor');
        }

        return view('instructor_course.courseManage', compact('course', 'enrollees'))->with('title', 'Manage Course');
    }

//     public function manage_course(Request $request, $courseId)
// {
//     if (auth('instructor')->check()) {
//                 $instructor = session('instructor');
//         try {
//             $course = Course::select(
//                 'course.*',
//                 'instructor.instructor_lname',
//                 'instructor.instructor_fname'
//             )
//                 ->where('course.course_id', $courseId)
//                 ->join('instructor', 'instructor.instructor_id', '=', 'course.instructor_id')
//                 ->first();

//             $enrolleesQuery = DB::table('learner_course')
//                 ->select(
//                     'learner_course.learner_course_id',
//                     'learner_course.learner_id',
//                     'learner_course.status',
//                     'learner_course.created_at',
//                     'learner.learner_fname',
//                     'learner.learner_lname',
//                     'learner.learner_email'
//                 )
//                 ->join('learner', 'learner_course.learner_id', '=', 'learner.learner_id')
//                 ->where('learner_course.course_id', $course->course_id);

//             // Filtering by Date
//             if ($request->has('filterDate')) {
//                 $enrolleesQuery->whereDate('learner_course.created_at', '=', $request->input('filterDate'));
//             }

//             // Filtering by Status
//             if ($request->has('filterStatus')) {
//                 $enrolleesQuery->where('learner_course.status', $request->input('filterStatus'));
//             }

//             // Searching
//             if ($request->has('searchBy') && $request->has('searchVal')) {
//                 $searchBy = $request->input('searchBy');
//                 $searchVal = $request->input('searchVal');
//                 $enrolleesQuery->where($searchBy, 'LIKE', "%$searchVal%");
//             }

//             $enrollees = $enrolleesQuery->get();

//         } catch (\Exception $e) {
//             dd($e->getMessage());
//         }
//     } else {
//         return redirect('/instructor');
//     }

//     return view('instructor_course.courseManage', compact('course', 'enrollees'))->with('title', 'Manage Course');
// }


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
                return response()->json(['message' => 'Course updated successfully', 'redirect_url' => "/instructor/course/manage/$course->course_id"]);
                
            
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
