<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Learner;
use App\Models\Instructor;
use App\Models\Course;
use App\Models\CourseGrading;
use App\Models\Admin;
use App\Models\LearnerCourse;
use App\Models\LearnerCourseProgress;
use App\Models\LearnerSyllabusProgress;
use App\Models\LearnerLessonProgress;
use App\Models\LearnerActivityProgress;
use App\Models\LearnerQuizProgress;
use App\Models\Syllabus;
use App\Models\Lessons;
use App\Models\Activities;
use App\Models\Quizzes;
use App\Models\LessonContents;
use App\Models\LearnerPreAssessmentProgress;
use App\Models\LearnerPreAssessmentOutput;
use App\Models\LearnerPostAssessmentProgress;
use App\Models\LearnerPostAssessmentOutput;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminCourseController extends Controller
{
   
// -----------------------admin courses------------------------- 
public function courses() {
    return $this->search_course();
}

public function search_course() {

    if (auth('admin')->check()) {
        $admin = session('admin');
        // dd($admin);


        $search_by = request('searchBy');
        $search_val = request('searchVal');
        
        $filter_date = request('filterDate');
        $filter_status = request('filterStatus');


        try {
            $query = DB::table('course')
                ->select(
                    'course.course_id',
                    'course.course_name',
                    'course.course_code',
                    'course.course_status',
                    'course.course_difficulty',
                    'course.course_description',
                    'instructor.instructor_lname',
                    'instructor.instructor_fname',
                    'course.created_at',
                )
                ->join('instructor', 'instructor.instructor_id', '=', 'course.instructor_id')
                ->orderBy('course.created_at', 'DESC');

            if(!empty($filter_date) || !empty($filter_status)) {
                if(!empty($filter_date) && empty($filter_date)) {
                    $query->where('course.created_at', 'LIKE', $filter_date.'%');
                } elseif (empty($filter_date) && !empty($filter_status)) {
                    $query->where('course.course_status', 'LIKE', $filter_status.'%');
                } else {
                    $query->where('course.created_at', 'LIKE', $filter_date.'%')
                        ->where('course.course_status', 'LIKE', $filter_status.'%');
                }
            }

            if(!empty($search_by) && !empty($search_val)) {
                if($search_by == 'instructor') {
                    $query->where(function ($query) use ($search_val) {
                        $query->where('instructor_fname', 'LIKE', $search_val.'%')
                            ->orWhere('instructor_lname', 'LIKE', $search_val.'%');
                    });
                } else {
                    $query->where('course.'.$search_by, 'LIKE', $search_val.'%');
                }
            }


            $courses = $query->paginate(10);

            $data = ['title' => 'Course Management',
                 'admin' => $admin

            ];

            return view('admin.courses', compact('courses'))
                ->with($data);

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    } else {
        return redirect('/admin');
    }
}

public function add_course() {
    if (auth('admin')->check()) {
        $adminSession = session('admin');

        if (in_array($adminSession->role, ['IT_DEPT', 'SUPER_ADMIN', 'COURSE_SUPERVISOR'])) {


        $instructors = DB::table('instructor')
            ->select(
                DB::raw("CONCAT(instructor_fname, ' ', instructor_lname) as name"), 
                'instructor_id as id'
            )
            ->where('status', '=', 'Approved')
            ->orderBy('instructor_fname', 'ASC')
            ->get();



        $data = [
            'title' => 'Course Management',
            'admin' => $adminSession,
            'instructors' => $instructors,
        ];

            return view('admin.add_course')->with($data);
        }  else {
            return view('error.error');
        }
} else {
    return redirect('/admin');
}
}

public function store_new_course(Request $request) {
    if (auth('admin')->check()) {
        $adminSession = session('admin');

        if (in_array($adminSession->role, ['IT_DEPT', 'SUPER_ADMIN', 'COURSE_SUPERVISOR'])) {


    try {
        $courseData = $request->validate([
            'course_name' => ['required'],
            'course_description' => ['required'],
            'course_difficulty' => ['required'],
            'instructor_id' => ['required'],
        ]);

        $courseData['course_code'] = Str::random(6);

        
        $folderName = $courseData['course_name'];
        $folderName = Str::slug($folderName, '_');
        $folderPath = 'public/courses/' . $folderName;

        if(!Storage::exists($folderPath)) {
            Storage::makeDirectory($folderPath);
        }

        $courseData = Course::create($courseData);

        CourseGrading::create([
            'course_id' => $courseData->course_id,
        ]);

        session()->flash('message', 'Course Added successfully');
        $data = [
            'message' => 'Course added successfully',
            'redirect_url' => '/admin/courses',
        ];

        return response()->json($data);
    } catch (ValidationException $e) {
        $errors = $e->validator->errors();

        return response()->json(['errors' => $errors], 422);
    }

        }  else {
            session()->flash('message', 'You cannot create new course');
            $data = [
                'message' => 'You cannot create new course',
                'redirect_url' => '/admin/courses',
            ];

            return response()->json($data);
        }
        
    }else {
            return redirect('/admin');
        }
    }

public function view_course($id) {
    if (auth('admin')->check()) {
        $adminSession = session('admin');

        if (in_array($adminSession->role, ['IT_DEPT', 'SUPER_ADMIN', 'COURSE_SUPERVISOR'])) {


        try {
            $course = DB::table('course')
            ->select(
                'course.course_id',
                'course.course_name',
                'course.course_code',
                'course.course_status',
                'course.course_difficulty',
                'course.course_description',
                'course.instructor_id',
                'instructor.instructor_lname',
                'instructor.instructor_fname',
                'instructor.profile_picture',
                'course.created_at',
                'course.updated_at',
            )
            ->where('course_id', $id)
            ->join('instructor', 'instructor.instructor_id', '=', 'course.instructor_id')
            ->orderBy('course.created_at', 'DESC')
            ->first();


            $instructors = DB::table('instructor')
            ->select(
                DB::raw("CONCAT(instructor_fname, ' ', instructor_lname) as name"), 
                'instructor_id as id'
            )
            ->where('status', '=', 'Approved')
            ->orderBy('instructor_fname', 'ASC')
            ->get();

            return view('admin.view_course', compact('course'), [
                'title' => 'Course Management',
                'admin' => $adminSession,
                'instructors' => $instructors,
            ]);

        } catch (\Exception $e) {
            dd($e->getMessage());
        }

;

    }  else {
        return view('error.error');
    }

    }else {
        return redirect('/admin');
    }

}

public function update_course(Course $course, Request $request) {
    if (auth('admin')->check()) {
        $adminSession = session('admin');

        if (in_array($adminSession->role, ['IT_DEPT', 'SUPER_ADMIN', 'COURSE_SUPERVISOR'])) {

        try {
            $courseData = $request->validate([
                'course_name' => ['required'],
                'course_description' => ['required'],
                'course_difficulty' => ['required'],
                'instructor_id' => ['required'],
            ]);

            $course->update($courseData);

            session()->flash('message', 'Course updated Successfully');
            return response()->json(['message' => 'Course updated successfully', 'redirect_url' => "/admin/view_course/$course->course_id"]);
            
        
        } catch (ValidationException $e) {
            // dd($e->getMessage());
            $errors = $e->validator->errors();        
            return response()->json(['errors' => $errors], 422);
        }

    } else {
        session()->flash('message', 'You cannot update course data');
        $data = [
            'message' => 'You cannot update course data',
            'redirect_url' => '/admin/view_course/' . $course->course_id,
        ];

        return response()->json($data);
    }
    }  else {
        return redirect('/admin');
    }
}

public function delete_course(Course $course) {
    try {
        $course->delete();


        session()->flash('message', 'Course deleted Successfully');
        return response()->json(['message' => 'Course deleted successfully', 'redirect_url' => "/admin/courses"]);
        
    
    } catch (ValidationException $e) {
        // dd($e->getMessage());
        $errors = $e->validator->errors();        
        return response()->json(['errors' => $errors], 422);
    }
}

public function approveCourse(Course $course)
{

    try {
        $course->update(['course_status' => 'Approved']);  
    } catch (\Exception $e) {
        dd($e->getMessage());
    }
    return redirect()->back()->with('message' , 'Course Status successfully changed');
}

public function rejectCourse(Course $course)
{
    try {
        $course->update(['course_status' => 'Rejected']);  
    } catch (\Exception $e) {
        dd($e->getMessage());
    }
    
    return redirect()->back()->with('message' , 'Course Status successfully changed');
}

public function pendingCourse(Course $course)
{
    try {
        $course->update(['course_status' => 'Pending']);  
    } catch (\Exception $e) {
        dd($e->getMessage());
    }
    
    return redirect()->back()->with('message' , 'Course Status successfully changed');
}

public function manage_course (Course $course) {

    if (auth('admin')->check()) {
        $admin = session('admin');
        // dd($admin);
        $admin_codename = $admin['admin_codename'];

        try {

            $course = DB::table('course')
            ->select(
                'course.course_id',
                'course.course_name',
                'course.course_code',
                'course.course_status',
                'course.course_difficulty',
                'course.instructor_id',
                'instructor.instructor_fname',
                'instructor.instructor_lname',
                'instructor.profile_picture',
            )
            ->join('instructor', 'course.instructor_id', 'instructor.instructor_id')
            ->where('course.course_id',$course->course_id)
            ->first();
            // dd($courseData);

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    } else {
        return redirect('/admin');
    }

    return view('admin.manage_course', compact('course'))
    ->with(['title' => 'Course Management', 'adminCodeName' => $admin_codename]);

}

public function course_enrollees (Request $request, Course $course) {
    if (auth('admin')->check()) {
        $admin = session('admin');
        // dd($admin);
        $admin_codename = $admin['admin_codename'];

        try {

            $search_by = request('searchBy');
            $search_val = request('searchVal');
    
            $filter_date = request('filterDate');
            $filter_status = request('filterStatus');


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
        return redirect('/admin');
    }

    return view('admin.course_enrollees', compact('course', 'enrollees'))
    ->with(['title' => 'Course Management', 'adminCodeName' => $admin_codename]);
}


// add learner course progress, learner syllabus progress, lesson, activity,quiz progress
public function approve_learner_course(LearnerCourse $learnerCourse) {
    try {
        
        $now = Carbon::now();
        $timestampString = $now->toDateTimeString();
        // dd($learnerCourse);
        $learnerCourse->update([
            'status' => 'Approved',
        ]);  

        $courseProgressData = [
            "learner_course_id" => $learnerCourse->learner_course_id,
            "learner_id" => $learnerCourse->learner_id,
            "course_id" => $learnerCourse->course_id,
            "start_period" => $timestampString,
        ];

        // LearnerCourseProgress::create($courseProgressData);
        LearnerCourseProgress::firstOrCreate($courseProgressData);

        $learnerAssessmentData = [
            "learner_course_id" => $learnerCourse->learner_course_id,
            "learner_id" => $learnerCourse->learner_id,
            "course_id" => $learnerCourse->course_id,
        ];

        LearnerPreAssessmentProgress::create($learnerAssessmentData);
        LearnerPostAssessmentProgress::create($learnerAssessmentData);

        $syllabusData = DB::table('syllabus')
        ->select(
            'syllabus_id',
            'course_id',
            'topic_id',
            'topic_title',
            'category'
        )
        ->where('course_id', $learnerCourse->course_id)
        ->orderBy('topic_id', 'ASC')
        ->get();

        // dd($syllabusData);

        // $syllabusDataLength = count($syllabusData);
    

        foreach($syllabusData as $syllabus) {
            $rowSyllabusData = [
                "learner_course_id" => $learnerCourse->learner_course_id,
                "learner_id" => $learnerCourse->learner_id,
                "course_id" => $learnerCourse->course_id,
                "syllabus_id"=> $syllabus->syllabus_id,
                "category" => $syllabus->category
            ];

            // dd($rowSyllabusData);
            LearnerSyllabusProgress::create($rowSyllabusData);

            switch ($syllabus->category) {
                case "LESSON":
                    
                    $lessonData = DB::table('lessons')
                    ->select(
                        'lesson_id',
                        'course_id',
                        'syllabus_id',
                        'topic_id'
                    )
                    ->where('syllabus_id', $syllabus->syllabus_id)
                    ->where('course_id', $learnerCourse->course_id)
                    ->where('topic_id', $syllabus->topic_id)
                    ->first();

                    $rowLessonData = [
                        "learner_course_id" => $learnerCourse->learner_course_id,
                        "learner_id" => $learnerCourse->learner_id,
                        "course_id" => $learnerCourse->course_id,
                        "syllabus_id" => $syllabus->syllabus_id,
                        "lesson_id" => $lessonData->lesson_id,
                    ];

                    LearnerLessonProgress::create($rowLessonData);
                    
                    break;
            
                case "ACTIVITY":

                    $activityData = DB::table('activities')
                    ->select(
                        'activity_id',
                        'course_id',
                        'syllabus_id',
                        'topic_id'
                    )
                    ->where('syllabus_id', $syllabus->syllabus_id)
                    ->where('course_id', $learnerCourse->course_id)
                    // ->where('topic_id', $syllabus->topic_id)
                    ->first();

                    // dd($activityData);
                    $rowActivityData = [
                        "learner_course_id" => $learnerCourse->learner_course_id,
                        "learner_id" => $learnerCourse->learner_id,
                        "course_id" => $learnerCourse->course_id,
                        "syllabus_id" => $syllabus->syllabus_id,
                        "activity_id" => $activityData->activity_id,
                    ];

                    LearnerActivityProgress::create($rowActivityData);

                    break;
            
                case "QUIZ":

                    $quizData = DB::table('quizzes')
                    ->select(
                        'quiz_id',
                        'course_id',
                        'syllabus_id',
                        'topic_id'
                    )
                    ->where('syllabus_id', $syllabus->syllabus_id)
                    ->where('course_id', $learnerCourse->course_id)
                    // ->where('topic_id', $syllabus->topic_id)
                    ->first();

                    $rowQuizData = [
                        "learner_course_id" => $learnerCourse->learner_course_id,
                        "learner_id" => $learnerCourse->learner_id,
                        "course_id" => $learnerCourse->course_id,
                        "syllabus_id" => $syllabus->syllabus_id,
                        "quiz_id" => $quizData->quiz_id,
                    ];

                    LearnerQuizProgress::create($rowQuizData);

                    break;
            
                default:

                    break;
            }
        };

        DB::table('learner_syllabus_progress')
            ->where('learner_course_id', $learnerCourse->learner_course_id)
            ->orderBy('learner_syllabus_progress_id', 'ASC')
            ->limit(1)
            ->update(['status' => 'NOT YET STARTED']);

        $firstTopic = DB::table('learner_syllabus_progress')
            ->select(
                'learner_syllabus_progress_id',
                'learner_course_id',
                'syllabus_id',
                'category',
                'status',
            )
            ->where('learner_course_id', $learnerCourse->learner_course_id)
            ->orderBy('learner_course_id', 'ASC')
            ->first();

        switch ($firstTopic->category) {
            case "LESSON":
                DB::table('learner_lesson_progress')
                ->where('learner_course_id', $learnerCourse->learner_course_id)
                ->orderBy('learner_lesson_progress_id','ASC')
                ->limit(1)
                ->update(['status' => 'NOT YET STARTED']);
                break;
            case "ACTIVITY":
                DB::table('learner_activity_progress')
                ->where('learner_course_id', $learnerCourse->learner_course_id)
                ->orderBy('learner_activity_progress_id','ASC')
                ->limit(1)
                ->update(['status' => 'NOT YET STARTED']);
                break;
            case "QUIZ":
                DB::table('learner_quiz_progress')
                ->where('learner_course_id', $learnerCourse->learner_course_id)
                ->orderBy('learner_quiz_progress_id','ASC')
                ->limit(1)
                ->update(['status' => 'NOT YET STARTED']);
                break;
            default:
                break;
        };

    } catch (\Exception $e) {
        dd($e->getMessage());
    }
    return redirect()->back()->with('message' , 'Course Status successfully changed');
}

public function reject_learner_course(LearnerCourse $learnerCourse) {
    try {
        $learnerCourse->update(['status' => 'Rejected']);  

        DB::table('learner_course_progress')
                    ->where('learner_course_id', $learnerCourse->learner_course_id)
                    ->where('learner_id', $learnerCourse->learner_id)
                    ->where('course_id', $learnerCourse->course_id)
                    ->delete();

        DB::table('learner_syllabus_progress')
                    ->where('learner_course_id', $learnerCourse->learner_course_id)
                    ->where('learner_id', $learnerCourse->learner_id)
                    ->where('course_id', $learnerCourse->course_id)
                    ->delete();            
        
        DB::table('learner_lesson_progress')
                    ->where('learner_course_id', $learnerCourse->learner_course_id)
                    ->where('learner_id', $learnerCourse->learner_id)
                    ->where('course_id', $learnerCourse->course_id)
                    ->delete();

        $learnerActivityOutput = DB::table('learner_activity_output')
        ->select(
            'learner_activity_output_id'
        )
        ->where('learner_course_id', $learnerCourse->learner_course_id)
        ->where('course_id', $learnerCourse->course_id)
        ->get();

        foreach ($learnerActivityOutput as $activityOutput) {
            DB::table('learner_activity_criteria_score')
            ->where('learner_activity_output_id', $activityOutput->learner_activity_output_id)
            ->delete();
        }
        DB::table('learner_activity_output')
                        ->where('learner_course_id', $learnerCourse->learner_course_id)
                        ->where('course_id', $learnerCourse->course_id)
                        ->delete();
                
        DB::table('learner_activity_progress')
                    ->where('learner_course_id', $learnerCourse->learner_course_id)
                    ->where('course_id', $learnerCourse->course_id)
                    ->where('learner_id', $learnerCourse->learner_id)
                    ->delete();

        DB::table('learner_quiz_progress')
                    ->where('learner_course_id', $learnerCourse->learner_course_id)
                    ->where('learner_id', $learnerCourse->learner_id)
                    ->where('course_id', $learnerCourse->course_id)
                    ->delete();

        DB::table('learner_quiz_progress')
                    ->where('learner_course_id', $learnerCourse->learner_course_id)
                    ->where('learner_id', $learnerCourse->learner_id)
                    ->where('course_id', $learnerCourse->course_id)
                    ->delete();

    } catch (\Exception $e) {
        dd($e->getMessage());
    }
    return redirect()->back()->with('message' , 'Course Status successfully changed');
}

public function pending_learner_course(LearnerCourse $learnerCourse) {
    try {
        $learnerCourse->update(['status' => 'Pending']);  
    } catch (\Exception $e) {
        dd($e->getMessage());
    }
    return redirect()->back()->with('message' , 'Course Status successfully changed');
}

}
