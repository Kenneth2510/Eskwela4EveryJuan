<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Learner;
use App\Models\Instructor;
use App\Models\Admin;
use App\Models\Course;
use App\Models\LearnerCourse;
use App\Models\Syllabus;
use App\Models\Lessons;
use App\Models\Activities;
use App\Models\ActivityContents;
use App\Models\ActivityContentCriterias;
use App\Models\Quizzes;
use App\Models\LearnerCourseProgress;
use App\Models\LearnerSyllabusProgress;
use App\Models\LearnerLessonProgress;
use App\Models\LearnerActivityProgress;
use App\Models\LearnerQuizProgress;
use App\Models\LearnerActivityOutput;
use App\Models\LearnerActivityCriteriaScore;
use App\Models\LearnerQuizOutputs;
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

    public function course_overview(Course $course) {
        if (auth('learner')->check()) {
            $learner = session('learner');
            // dd($learner);


            try {
                $learnerCourseData = DB::table('learner_course')
                ->select(
                    'learner_course_id',
                    'learner_id',
                    'course_id',
                    'status'
                )
                ->where('learner_id', $learner->learner_id)
                ->where('course_id' , $course->course_id)
                ->first();

                if ($learnerCourseData->status !== 'Approved') {
                    
                    session()->flash('message', 'Your Enrollment is not yet Approved');
                    return redirect()->back();
                };

                $courseData = DB::table('course')
                ->select(
                    'course_id',
                    'course_name',
                    'course_code',
                    'course_description',
                    'course_status',
                    'course_difficulty',
                    'instructor_id',
                )
                ->where('course_id', $course->course_id)
                ->first();

                
                   
                $learnerCourseProgressData = DB::table('learner_course_progress')
                ->select(
                    'learner_course_progress_id',
                    'learner_course_id',
                    'learner_id',
                    'course_id',
                    'course_progress'
                )
                ->where('learner_course_id', $learnerCourseData->learner_course_id)
                ->first();

                if($learnerCourseProgressData->course_progress !== "IN PROGRESS" || $learnerCourseProgressData->course_progress !== "COMPLETED") {
                    DB::table('learner_course_progress')
                    ->where('learner_course_id', $learnerCourseData->learner_course_id)
                    ->update(['course_progress' => 'IN PROGRESS']);
                    // dd($learnerCourseProgressData);
                }

                $learnerCourseProgressData2 = DB::table('learner_course_progress')
                ->select(
                    'learner_course_progress_id',
                    'learner_course_id',
                    'learner_id',
                    'course_id',
                    'course_progress'
                )
                ->where('learner_course_id', $learnerCourseData->learner_course_id)
                ->first();
                

                $learnerSyllabusProgressData = DB::table('learner_syllabus_progress')
                ->select(
                    'learner_syllabus_progress.learner_syllabus_progress_id',
                    'learner_syllabus_progress.learner_course_id',
                    'learner_syllabus_progress.syllabus_id',
                    'learner_syllabus_progress.category',
                    'learner_syllabus_progress.status',
                    'syllabus.course_id',
                    'syllabus.topic_id',
                    'syllabus.topic_title',
                    'syllabus.category'
                    )
                ->join('syllabus','learner_syllabus_progress.syllabus_id','=','syllabus.syllabus_id')
                ->where('learner_course_id', $learnerCourseData->learner_course_id)
                ->orderBy('syllabus.topic_id', 'ASC')
                ->get();

                // dd($learnerSyllabusProgressData);


                $lessonCount = 0;
                $quizCount = 0;
                $activityCount = 0;

                foreach($learnerSyllabusProgressData as $topic) {
                    if($topic->category == 'LESSON') {
                        $lessonCount++;
                    } else if($topic->category == 'ACTIVITY') {
                        $activityCount++;
                    } else {
                        $quizCount++;
                    }
                }


                

            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        } else {
            return redirect('/learner');
        }

        
        return view('learner_course.courseSyllabus', compact('learner'))
        ->with([
            'title' => 'Course Overview',
            'scripts' => ['/L_course_syllabus_overview.js'],
            'course' => $courseData,
            'learnerCourse' => $learnerCourseData,
            'leanerCourseProgress' => $learnerCourseProgressData2,
            'learnerSyllabusData' => $learnerSyllabusProgressData,
            'lessonCount' => $lessonCount,
            'activityCount' => $activityCount,
            'quizCount' => $quizCount,
        ]);
    }

    public function view_syllabus(Course $course) {

        try {
            $syllabusData = DB::table('syllabus')
            ->select(
                'syllabus_id',
                'course_id',
                'topic_id',
                'topic_title',
                'category'
            )
            ->where('course_id', $course->course_id)
            ->orderBy('topic_id', 'ASC')
            ->get();

        } catch (ValidationException $e) {
                    $errors = $e->validator->errors();
        
                    return response()->json(['errors' => $errors], 422); 
        }

        $response = [
            'syllabus' => $syllabusData
        ];

        return response()->json($response);

    }

    public function view_lesson(Course $course, LearnerCourse $learner_course, Syllabus $syllabus) {
        if (auth('learner')->check()) {
            $learner = session('learner'); 
            try {
                if (!function_exists('getRandomColor')) {
                    function getRandomColor() {
                    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                    }
                }
                
                // Generate a random color for mainBackgroundCol
                $mainBackgroundCol = getRandomColor();
    
                // Darken the mainBackgroundCol
                $mainColorRGB = sscanf($mainBackgroundCol, "#%02x%02x%02x");
                $mainBackgroundCol = sprintf("#%02x%02x%02x", $mainColorRGB[0] * 0.6, $mainColorRGB[1] * 0.6, $mainColorRGB[2] * 0.6);
    
                // Darken the mainBackgroundCol further for darkenedColor
                $darkenedColor = sprintf("#%02x%02x%02x", $mainColorRGB[0] * 0.4, $mainColorRGB[1] * 0.4, $mainColorRGB[2] * 0.4);



                $learnerSyllabusProgressData = DB::table('learner_syllabus_progress')
                ->select(
                    'learner_syllabus_progress.learner_syllabus_progress_id',
                    'learner_syllabus_progress.learner_course_id',
                    'learner_syllabus_progress.learner_id',
                    'learner_syllabus_progress.course_id',
                    'learner_syllabus_progress.syllabus_id',
                    'learner_syllabus_progress.category',
                    'learner_syllabus_progress.status', 
                    'course.course_name',
                    
                    'lessons.lesson_id',
                    'lessons.lesson_title',
                    'lessons.picture',
                )
                ->join('lessons', 'learner_syllabus_progress.syllabus_id', '=', 'lessons.syllabus_id')
                ->join('course','learner_syllabus_progress.course_id','=','course.course_id')
                ->where('learner_syllabus_progress.course_id', $course->course_id)
                ->where('learner_syllabus_progress.syllabus_id', $syllabus->syllabus_id)
                ->where('learner_syllabus_progress.learner_id', $learner->learner_id)
                ->where('learner_syllabus_progress.learner_course_id', $learner_course->learner_course_id)
                ->first();

                // dd($learnerSyllabusProgressData);

                $learnerLessonProgressData = DB::table('learner_lesson_progress')
                ->select(
                    'learner_lesson_progress.learner_lesson_progress_id',
                    'learner_lesson_progress.learner_course_id',
                    'learner_lesson_progress.syllabus_id',
                    'learner_lesson_progress.lesson_id',

                    'lesson_content.lesson_content_id',
                    'lesson_content.lesson_content_title',
                    'lesson_content.lesson_content',
                    'lesson_content.lesson_content_order',
                    'lesson_content.picture',
                )
                ->join('lesson_content', 'learner_lesson_progress.lesson_id', '=', 'lesson_content.lesson_id')
                ->where('learner_lesson_progress.course_id', $course->course_id)
                ->where('learner_lesson_progress.syllabus_id', $syllabus->syllabus_id)
                ->where('learner_lesson_progress.learner_course_id' , $learnerSyllabusProgressData->learner_course_id)
                ->orderBy('lesson_content.lesson_content_order', 'ASC')
                ->get();

                if($learnerSyllabusProgressData->status !== "COMPLETED" && $learnerSyllabusProgressData->status !== "IN PROGRESS") {
                    DB::table('learner_syllabus_progress')
                    ->where('learner_course_id', $learnerSyllabusProgressData->learner_course_id)
                    ->where('syllabus_id' , $syllabus->syllabus_id)
                    ->update(['status' => 'IN PROGRESS']);
                    // ->first();
                    // dd($a);
                        
                    DB::table('learner_lesson_progress')
                    ->where('lesson_id', $learnerSyllabusProgressData->lesson_id)
                    ->where('learner_course_id', $learnerSyllabusProgressData->learner_course_id)
                    ->update(['status' => 'IN PROGRESS']);
                    // ->first();
                    // dd($b);
    
                    // dd($learnerLessonProgressData);
                }
                
                
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        } else {
            return redirect('/learner');
        }


        return view('learner_course.courseLesson', compact('learner'))
        ->with([
            'title' => 'Course Lesson',
            'scripts' => ['/L_course_lesson.js'],
            'syllabus' => $learnerSyllabusProgressData,
            'lessons' => $learnerLessonProgressData,
            'mainBackgroundCol' => $mainBackgroundCol,
            'darkenedColor' => $darkenedColor,
        ]);
    }

    public function finish_lesson(Course $course, LearnerCourse $learner_course, Syllabus $syllabus) {
        if (auth('learner')->check()) {
            $learner = session('learner'); 
            try {
                $currentLessonStatus = DB::table('learner_lesson_progress')
                    ->where('learner_course_id' , $learner_course->learner_course_id)
                    ->where('course_id', $course->course_id)
                    ->where('syllabus_id' , $syllabus->syllabus_id)
                    ->value('status');
    
                // Check if the current lesson is not already completed
                if ($currentLessonStatus !== 'COMPLETED') {
                    // Update the status of the current lesson to 'COMPLETED'
                    DB::table('learner_syllabus_progress')
                        ->where('learner_course_id' , $learner_course->learner_course_id)
                        ->where('course_id', $course->course_id)
                        ->where('syllabus_id' , $syllabus->syllabus_id)
                        ->update(['status' => 'COMPLETED']);
    
                    // Update the status of the current lesson to 'COMPLETED'
                    DB::table('learner_lesson_progress')
                        ->where('learner_course_id' , $learner_course->learner_course_id)
                        ->where('course_id', $course->course_id)
                        ->where('syllabus_id' , $syllabus->syllabus_id)
                        ->update(['status' => 'COMPLETED']);
                    
                    // Find the next lesson that is still 'LOCKED' and update its status to 'NOT YET STARTED'
                    $nextLesson = DB::table('learner_syllabus_progress')
                        ->where('learner_course_id' , $learner_course->learner_course_id)
                        ->where('course_id', $course->course_id)
                        ->where('status', 'LOCKED')
                        ->orderBy('learner_syllabus_progress_id', 'ASC')
                        ->limit(1)
                        ->first();
    
                    if ($nextLesson) {
                        DB::table('learner_syllabus_progress')
                            ->where('learner_course_id', $learner_course->learner_course_id)
                            ->where('course_id', $course->course_id)
                            ->where('learner_syllabus_progress_id', $nextLesson->learner_syllabus_progress_id)
                            ->update(['status' => 'NOT YET STARTED']);
                    }
                }
    
                session()->flash('message', 'Lesson Completed Successfully');
    
                $response = [
                    'message' => 'Lesson Completed successfully',
                    'redirect_url' => "/learner/course/manage/$course->course_id/overview",
                    'course_id' => $course->course_id,
                ];
    
                return response()->json($response);
    
            } catch (ValidationException $e) {
                $errors = $e->validator->errors();
    
                return response()->json(['errors' => $errors], 422);
            }
        } else {
            return redirect('/learner');
        }
    }
    

    public function view_activity(Course $course, LearnerCourse $learner_course, Syllabus $syllabus) {
        if (auth('learner')->check()) {
            $learner = session('learner'); 
            try {
                if (!function_exists('getRandomColor')) {
                    function getRandomColor() {
                    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                    }
                }
                
                // Generate a random color for mainBackgroundCol
                $mainBackgroundCol = getRandomColor();
    
                // Darken the mainBackgroundCol
                $mainColorRGB = sscanf($mainBackgroundCol, "#%02x%02x%02x");
                $mainBackgroundCol = sprintf("#%02x%02x%02x", $mainColorRGB[0] * 0.6, $mainColorRGB[1] * 0.6, $mainColorRGB[2] * 0.6);
    
                // Darken the mainBackgroundCol further for darkenedColor
                $darkenedColor = sprintf("#%02x%02x%02x", $mainColorRGB[0] * 0.4, $mainColorRGB[1] * 0.4, $mainColorRGB[2] * 0.4);


                
                $learnerSyllabusProgressData = DB::table('learner_syllabus_progress')
                ->select(
                    'learner_syllabus_progress.learner_syllabus_progress_id',
                    'learner_syllabus_progress.learner_course_id',
                    'learner_syllabus_progress.learner_id',
                    'learner_syllabus_progress.course_id',
                    'learner_syllabus_progress.syllabus_id',
                    'learner_syllabus_progress.category',
                    'learner_syllabus_progress.status', 
                    'course.course_name',
                    
                    'activities.activity_id',
                    'activities.activity_title',
                )
                ->join('activities', 'learner_syllabus_progress.syllabus_id', '=', 'activities.syllabus_id')
                ->join('course','learner_syllabus_progress.course_id','=','course.course_id')
                ->where('learner_syllabus_progress.course_id', $course->course_id)
                ->where('learner_syllabus_progress.syllabus_id', $syllabus->syllabus_id)
                ->where('learner_syllabus_progress.learner_id', $learner->learner_id)
                ->where('learner_syllabus_progress.learner_course_id', $learner_course->learner_course_id)
                ->first();

           

                $learnerActivityProgressData = DB::table('learner_activity_progress')
                ->select(
                    'learner_activity_progress.learner_activity_progress_id',
                    'learner_activity_progress.learner_course_id',
                    'learner_activity_progress.learner_id',
                    'learner_activity_progress.course_id',
                    'learner_activity_progress.syllabus_id',
                    'learner_activity_progress.activity_id',
                    'learner_activity_progress.status',

                    'activity_content.activity_content_id',
                    'activity_content.activity_instructions',
                    'activity_content.total_score',
                )
                ->join('activity_content', 'learner_activity_progress.activity_id', '=', 'activity_content.activity_id')
                // ->join('activity_content_criteria', 'activity_content.activity_content_id', '=', 'activity_content_criteria.activity_content_id')
                ->where('learner_activity_progress.course_id', $course->course_id)
                ->where('learner_activity_progress.syllabus_id', $syllabus->syllabus_id)
                ->where('learner_activity_progress.learner_course_id' , $learnerSyllabusProgressData->learner_course_id)
                ->first();

                // dd($learnerActivity  rogressData);

                $activityContentCriteriaData = DB::table('activity_content_criteria')
                ->select(
                    'activity_content_criteria_id',
                    'activity_content_id',
                    'criteria_title',
                    'score'
                )
                ->where('activity_content_id', $learnerActivityProgressData->activity_content_id)
                ->get();

                
                if ($learnerActivityProgressData->status === "COMPLETED" || $learnerActivityProgressData->status === "IN PROGRESS") {
                    $activityOutputData = DB::table('learner_activity_output')
                        ->select(
                            'learner_activity_output_id',
                            'learner_course_id',
                            'syllabus_id',
                            'activity_id',
                            'activity_content_id',
                            'course_id',
                            'answer',
                            'total_score',
                            'remarks',
                            'created_at',
                        )
                        ->where('course_id', $course->course_id)
                        ->where('syllabus_id', $syllabus->syllabus_id)
                        ->where('learner_course_id', $learnerSyllabusProgressData->learner_course_id)
                        ->first();

                       
                
                    $activityScoreData = DB::table('learner_activity_criteria_score')
                        ->select(
                            'learner_activity_criteria_score_id',
                            'learner_activity_output_id',
                            'activity_content_criteria_id',
                            'activity_content_id',
                            'score'
                        )
                        ->where('learner_activity_output_id', $activityOutputData->learner_activity_output_id)
                        ->where('activity_content_id', $activityOutputData->activity_content_id)
                        ->orderBy('learner_activity_criteria_score_id', 'ASC')
                        ->get();
                
                    $data = [
                        'title' => 'Course Lesson',
                        'scripts' => ['/L_course_activity.js'],
                        'syllabus' => $learnerSyllabusProgressData,
                        'activity' => $learnerActivityProgressData,
                        'activityCriteria' => $activityContentCriteriaData,
                        'mainBackgroundCol' => $mainBackgroundCol,
                        'darkenedColor' => $darkenedColor,
                        'activityOutput' => $activityOutputData,
                        'activityScore' => $activityScoreData,
                    ];

                    //  dd($data);
                } else {
                    $data = [
                        'title' => 'Course Lesson',
                        'scripts' => ['/L_course_activity.js'],
                        'syllabus' => $learnerSyllabusProgressData,
                        'activity' => $learnerActivityProgressData,
                        'activityCriteria' => $activityContentCriteriaData,
                        'mainBackgroundCol' => $mainBackgroundCol,
                        'darkenedColor' => $darkenedColor,
                        'activityOutput' => '',
                        'activityScore' => '',
                    ];
                }

                // dd($activityContentCriteriaData);


            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        } else {
            return redirect('/learner');
        }


        return view('learner_course.courseActivity', compact('learner'))
        ->with([
            'title' => 'Course Lesson',
            'scripts' => ['/L_course_activity.js'],
            'syllabus' => $learnerSyllabusProgressData,
            'activity' => $learnerActivityProgressData,
            'activityCriteria' => $activityContentCriteriaData,
            'mainBackgroundCol' => $mainBackgroundCol,
            'darkenedColor' => $darkenedColor,
        ]);
    }

    public function answer_activity(Course $course, LearnerCourse $learner_course, Syllabus $syllabus) {
        if (auth('learner')->check()) {
            $learner = session('learner'); 
            try {
                if (!function_exists('getRandomColor')) {
                    function getRandomColor() {
                    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                    }
                }
                
                // Generate a random color for mainBackgroundCol
                $mainBackgroundCol = getRandomColor();
    
                // Darken the mainBackgroundCol
                $mainColorRGB = sscanf($mainBackgroundCol, "#%02x%02x%02x");
                $mainBackgroundCol = sprintf("#%02x%02x%02x", $mainColorRGB[0] * 0.6, $mainColorRGB[1] * 0.6, $mainColorRGB[2] * 0.6);
    
                // Darken the mainBackgroundCol further for darkenedColor
                $darkenedColor = sprintf("#%02x%02x%02x", $mainColorRGB[0] * 0.4, $mainColorRGB[1] * 0.4, $mainColorRGB[2] * 0.4);


                
                $learnerSyllabusProgressData = DB::table('learner_syllabus_progress')
                ->select(
                    'learner_syllabus_progress.learner_syllabus_progress_id',
                    'learner_syllabus_progress.learner_course_id',
                    'learner_syllabus_progress.learner_id',
                    'learner_syllabus_progress.course_id',
                    'learner_syllabus_progress.syllabus_id',
                    'learner_syllabus_progress.category',
                    'learner_syllabus_progress.status', 
                    'course.course_name',
                    
                    'activities.activity_id',
                    'activities.activity_title',
                )
                ->join('activities', 'learner_syllabus_progress.syllabus_id', '=', 'activities.syllabus_id')
                ->join('course','learner_syllabus_progress.course_id','=','course.course_id')
                ->where('learner_syllabus_progress.course_id', $course->course_id)
                ->where('learner_syllabus_progress.syllabus_id', $syllabus->syllabus_id)
                ->where('learner_syllabus_progress.learner_id', $learner->learner_id)
                ->where('learner_syllabus_progress.learner_course_id', $learner_course->learner_course_id)
                ->first();

           

                $learnerActivityProgressData = DB::table('learner_activity_progress')
                ->select(
                    'learner_activity_progress.learner_activity_progress_id',
                    'learner_activity_progress.learner_course_id',
                    'learner_activity_progress.learner_id',
                    'learner_activity_progress.course_id',
                    'learner_activity_progress.syllabus_id',
                    'learner_activity_progress.activity_id',
                    'learner_activity_progress.status',

                    'activity_content.activity_content_id',
                    'activity_content.activity_instructions',
                    'activity_content.total_score',
                )
                ->join('activity_content', 'learner_activity_progress.activity_id', '=', 'activity_content.activity_id')
                // ->join('activity_content_criteria', 'activity_content.activity_content_id', '=', 'activity_content_criteria.activity_content_id')
                ->where('learner_activity_progress.course_id', $course->course_id)
                ->where('learner_activity_progress.syllabus_id', $syllabus->syllabus_id)
                ->where('learner_activity_progress.learner_course_id' , $learnerSyllabusProgressData->learner_course_id)
                ->first();

                $activityContentCriteriaData = DB::table('activity_content_criteria')
                ->select(
                    'activity_content_criteria_id',
                    'activity_content_id',
                    'criteria_title',
                    'score'
                )
                ->where('activity_content_id', $learnerActivityProgressData->activity_content_id)
                ->get();

                
                if ($learnerActivityProgressData->status === "COMPLETED" || $learnerActivityProgressData->status === "IN PROGRESS") {
                    $activityOutputData = DB::table('learner_activity_output')
                        ->select(
                            'learner_activity_output_id',
                            'learner_course_id',
                            'syllabus_id',
                            'activity_id',
                            'activity_content_id',
                            'course_id',
                            'answer',
                            'total_score',
                            'remarks',
                            'created_at',
                        )
                        ->where('course_id', $course->course_id)
                        ->where('syllabus_id', $syllabus->syllabus_id)
                        ->where('learner_course_id', $learnerSyllabusProgressData->learner_course_id)
                        ->first();

                       
                
                    $activityScoreData = DB::table('learner_activity_criteria_score')
                        ->select(
                            'learner_activity_criteria_score_id',
                            'learner_activity_output_id',
                            'activity_content_criteria_id',
                            'activity_content_id',
                            'score'
                        )
                        ->where('learner_activity_output_id', $activityOutputData->learner_activity_output_id)
                        ->where('activity_content_id', $activityOutputData->activity_content_id)
                        ->orderBy('learner_activity_criteria_score_id', 'ASC')
                        ->get();
                
                    $data = [
                        'title' => 'Course Lesson',
                        'scripts' => ['/L_course_activity.js'],
                        'syllabus' => $learnerSyllabusProgressData,
                        'activity' => $learnerActivityProgressData,
                        'activityCriteria' => $activityContentCriteriaData,
                        'mainBackgroundCol' => $mainBackgroundCol,
                        'darkenedColor' => $darkenedColor,
                        'activityOutput' => $activityOutputData,
                        'activityScore' => $activityScoreData,
                    ];

                    //  dd($data);
                } else {
                    $data = [
                        'title' => 'Course Lesson',
                        'scripts' => ['/L_course_activity.js'],
                        'syllabus' => $learnerSyllabusProgressData,
                        'activity' => $learnerActivityProgressData,
                        'activityCriteria' => $activityContentCriteriaData,
                        'mainBackgroundCol' => $mainBackgroundCol,
                        'darkenedColor' => $darkenedColor,
                        'activityOutput' => '',
                        'activityScore' => '',
                    ];
                }


                

                // DB::table('learner_activity_progress')
                // ->where('learner_activity_progress_id', $learnerActivityProgressData->learner_activity_progress_id)
                // ->update(['status' => 'NOT YET STARTED']);


                
                
                // dd($activityContentCriteriaData);


            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        } else {
            return redirect('/learner');
        }


        return view('learner_course.courseActivityAnswer', compact('learner'))
        ->with($data);
    }

    public function submit_answer(Course $course, LearnerCourse $learner_course, Syllabus $syllabus, Activities $activity, ActivityContents $activity_content, Request $request) {
        if (auth('learner')->check()) {
            $learner = session('learner'); 
            try {
                $activityData =([
                    'learner_course_id' => $learner_course->learner_course_id,
                    'syllabus_id' => $syllabus->syllabus_id,
                    'activity_id' => $activity->activity_id,
                    'activity_content_id' => $activity_content->activity_content_id,
                    'course_id' => $course->course_id,
                    'answer' => $request->answer,
                ]);

                LearnerActivityOutput::create($activityData);

                $learnerActivityData = DB::table('learner_activity_output')
                ->select(
                    'learner_activity_output_id',
                    'learner_course_id',
                    'syllabus_id',
                    'activity_id',
                    'activity_content_id',
                    'course_id',
                    'answer',
                    'total_score'
                )
                ->orderBy('learner_activity_output_id', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->first();

                $activityCriteria = DB::table('activity_content_criteria')
                ->select(
                    'activity_content_criteria_id',
                    'activity_content_id',
                )
                ->where('activity_content_id', $activity_content->activity_content_id)
                ->get();

                // updating the status of the learner progress

                DB::table('learner_activity_progress')
                ->where('learner_course_id' , $learner_course->learner_course_id)
                ->where('syllabus_id', $syllabus->syllabus_id)
                ->where('course_id', $course->course_id)
                ->where('activity_id', $activity->activity_id)
                ->update(['status' => 'IN PROGRESS']);

                DB::table('learner_syllabus_progress')
                ->where('learner_course_id' , $learner_course->learner_course_id)
                ->where('syllabus_id', $syllabus->syllabus_id)
                ->where('course_id', $course->course_id)
                ->update(['status' => 'IN PROGRESS']);

                




                foreach($activityCriteria as $criteria) {
                    $newRowData = ([
                        'learner_activity_output_id' => $learnerActivityData->learner_activity_output_id,
                        'activity_content_criteria_id' => $criteria->activity_content_criteria_id,
                        'activity_content_id' =>$criteria->activity_content_id,
                    ]);

                    LearnerActivityCriteriaScore::create($newRowData);
                };



                

                session()->flash('message', 'Activity Finished Successfully');
                return response()->json(['message' => 'Course updated successfully',
                 'redirect_url' => "/learner/course/content/$course->course_id/$learner_course->learner_course_id/activity/$syllabus->syllabus_id"]);
            

                } catch (ValidationException $e) {
                    $errors = $e->validator->errors();
                    return response()->json(['errors' => $errors], 422);
                }
        } else {
            return redirect('/learner');
        }
    }


    public function view_quiz(Course $course, LearnerCourse $learner_course, Syllabus $syllabus) {

        if (auth('learner')->check()) {
            $learner = session('learner'); 
            try {
                if (!function_exists('getRandomColor')) {
                    function getRandomColor() {
                    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                    }
                }
                
                // Generate a random color for mainBackgroundCol
                $mainBackgroundCol = getRandomColor();
    
                // Darken the mainBackgroundCol
                $mainColorRGB = sscanf($mainBackgroundCol, "#%02x%02x%02x");
                $mainBackgroundCol = sprintf("#%02x%02x%02x", $mainColorRGB[0] * 0.6, $mainColorRGB[1] * 0.6, $mainColorRGB[2] * 0.6);
    
                // Darken the mainBackgroundCol further for darkenedColor
                $darkenedColor = sprintf("#%02x%02x%02x", $mainColorRGB[0] * 0.4, $mainColorRGB[1] * 0.4, $mainColorRGB[2] * 0.4);


                $learnerSyllabusProgressData = DB::table('learner_syllabus_progress')
                ->select(
                    'learner_syllabus_progress.learner_syllabus_progress_id',
                    'learner_syllabus_progress.learner_course_id',
                    'learner_syllabus_progress.learner_id',
                    'learner_syllabus_progress.course_id',
                    'learner_syllabus_progress.syllabus_id',
                    'learner_syllabus_progress.category',
                    'learner_syllabus_progress.status', 
                    'course.course_name',
                    
                    'quizzes.quiz_id',
                    'quizzes.quiz_title',
                    'quizzes.duration'
                )
                ->join('quizzes', 'learner_syllabus_progress.syllabus_id', '=', 'quizzes.syllabus_id')
                ->join('course','learner_syllabus_progress.course_id','=','course.course_id')

                ->where('learner_syllabus_progress.course_id', $course->course_id)
                ->where('learner_syllabus_progress.syllabus_id', $syllabus->syllabus_id)
                ->where('learner_syllabus_progress.learner_id', $learner->learner_id)
                ->where('learner_syllabus_progress.learner_course_id', $learner_course->learner_course_id)
                ->first();


                $quizReferenceData = DB::table('quiz_reference')
                ->select(
                    'quiz_reference.quiz_reference_id',
                    'quiz_reference.quiz_id',
                    'quiz_reference.course_id',
                    'quiz_reference.syllabus_id',
                    'syllabus.topic_title',
                )
                ->join('syllabus', 'quiz_reference.syllabus_id', '=', 'syllabus.syllabus_id' )
                ->where('quiz_reference.quiz_id', $learnerSyllabusProgressData->quiz_id)
                ->get();

                $learnerQuizProgressData = DB::table('learner_quiz_progress')
                ->select(
                    'learner_quiz_progress.learner_quiz_progress_id',
                    'learner_quiz_progress.learner_course_id',
                    'learner_quiz_progress.syllabus_id',
                    'learner_quiz_progress.quiz_id',
                    'learner_quiz_progress.status',
                    'learner_quiz_progress.attempt',
                    'learner_quiz_progress.max_attempt',
                    'learner_quiz_progress.score',
                    'learner_quiz_progress.remarks',
                    'learner_quiz_progress.updated_at',
                )
                ->where('learner_quiz_progress.learner_course_id', $learner_course->learner_course_id)
                ->where('learner_quiz_progress.course_id', $course->course_id)
                ->where('learner_quiz_progress.syllabus_id', $syllabus->syllabus_id)
                ->where('learner_quiz_progress.quiz_id', $learnerSyllabusProgressData->quiz_id)
                ->first();

                $totalCount = DB::table('learner_quiz_output')
                ->where('learner_course_id', $learner_course->learner_course_id)
                ->where('course_id', $course->course_id)
                ->where('syllabus_id', $syllabus->syllabus_id)
                ->where('quiz_id', $learnerQuizProgressData->quiz_id)
                ->where('attempts', $learnerQuizProgressData->attempt)
                ->count();


            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        } else {
            return redirect('/learner');
        }

        $data = [
            'title' => 'Course Lesson',
            'scripts' => ['/.js'],
            'mainBackgroundCol' => $mainBackgroundCol,
            'darkenedColor' => $darkenedColor,
            'learnerSyllabusProgressData' => $learnerSyllabusProgressData,
            'learnerQuizProgressData' => $learnerQuizProgressData,
            'quizReferenceData' => $quizReferenceData,
            'totalQuestionCount' => $totalCount,
        ];

        // dd($data);

        return view('learner_course.courseQuiz', compact('learner'))
        ->with($data);

    }


    // public function generate_quiz($learner_course, $learner, $course, $syllabus, $quiz, $attempt) {
        
    //     $updated_attempt = $attempt++;

    //     $quizContentData = DB::table('quiz_content')
    //     ->select(
    //         'quiz_content.quiz_content_id',
    //         'quiz_content.quiz_id',
    //         'quiz_content.course_id',
    //         'quiz_content.syllabus_id',
    //         'quiz_content.question_id',
    //     )
    //     ->where('quiz_content.quiz_id', $quiz)
    //     ->where('quiz_content.course_id', $course)
    //     ->where('quiz_content.syllabus_id', $syllabus)
    //     ->inRandomOrder()
    //     ->get();

    //     foreach($quizContentData as $question) {
    //         $questionRowData = [
    //             'learner_course_id' => $learner_course,
    //             'learner_id' => $learner,
    //             'course_id' => $question->course_id,
    //             'syllabus_id' => $question->syllabus_id,
    //             'quiz_id' => $question->quiz_id,
    //             'quiz_content_id' => $question->quiz_content_id,
    //             'attempts' => $updated_attempt,
    //         ];

    //         // DB::table('learner_quiz_output')->insert($questionRowData);
    //         LearnerQuizOutputs::create($questionRowData);
    //     };


    //     $learnerQuizOutputData = DB::table('learner_quiz_output')
    //     ->select(
    //         'learner_quiz_output_id',
    //         'learner_course_id',
    //         'course_id',
    //         'syllabus_id',
    //         'quiz_id',
    //         'quiz_content_id',
    //         'attempts',
    //         'answer',
    //         'isCorrect',
    //     )
    //     ->where('quiz_id', $quiz)
    //     ->where('course_id', $course)
    //     ->where('syllabus_id', $syllabus)
    //     ->get();

    //     return [
    //         'learnerQuizOutputData' => $learnerQuizOutputData,
    //         'questionRowData' => $quizContentData,
    //     ];
    // }


    public function answer_quiz(Course $course, LearnerCourse $learner_course, Syllabus $syllabus) {

        if (auth('learner')->check()) {
            $learner = session('learner'); 
            try {
                if (!function_exists('getRandomColor')) {
                    function getRandomColor() {
                        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                    }
                }
    
                // Generate a random color for mainBackgroundCol
                $mainBackgroundCol = getRandomColor();
    
                // Darken the mainBackgroundCol
                $mainColorRGB = sscanf($mainBackgroundCol, "#%02x%02x%02x");
                $mainBackgroundCol = sprintf("#%02x%02x%02x", $mainColorRGB[0] * 0.6, $mainColorRGB[1] * 0.6, $mainColorRGB[2] * 0.6);
    
                // Darken the mainBackgroundCol further for darkenedColor
                $darkenedColor = sprintf("#%02x%02x%02x", $mainColorRGB[0] * 0.4, $mainColorRGB[1] * 0.4, $mainColorRGB[2] * 0.4);
    
                $learnerSyllabusProgressData = DB::table('learner_syllabus_progress')
                    ->select(
                        'learner_syllabus_progress.learner_syllabus_progress_id',
                        'learner_syllabus_progress.learner_course_id',
                        'learner_syllabus_progress.learner_id',
                        'learner_syllabus_progress.course_id',
                        'learner_syllabus_progress.syllabus_id',
                        'learner_syllabus_progress.category',
                        'learner_syllabus_progress.status', 
                        'course.course_name',
                        'quizzes.quiz_id',
                        'quizzes.quiz_title',
                        'quizzes.duration',
                    )
                    ->join('quizzes', 'learner_syllabus_progress.syllabus_id', '=', 'quizzes.syllabus_id')
                    ->join('course','learner_syllabus_progress.course_id','=','course.course_id')
                    ->where('learner_syllabus_progress.course_id', $course->course_id)
                    ->where('learner_syllabus_progress.syllabus_id', $syllabus->syllabus_id)
                    ->where('learner_syllabus_progress.learner_id', $learner->learner_id)
                    ->where('learner_syllabus_progress.learner_course_id', $learner_course->learner_course_id)
                    ->first();

                    $quizReferenceData = DB::table('quiz_reference')
                    ->select(
                        'quiz_reference.quiz_reference_id',
                        'quiz_reference.quiz_id',
                        'quiz_reference.course_id',
                        'quiz_reference.syllabus_id',
                        'syllabus.topic_title',
                    )
                    ->join('syllabus', 'quiz_reference.syllabus_id', '=', 'syllabus.syllabus_id' )
                    ->where('quiz_reference.quiz_id', $learnerSyllabusProgressData->quiz_id)
                    ->get();


                    $learnerQuizProgressData = DB::table('learner_quiz_progress')
                    ->select(
                        'learner_quiz_progress.learner_quiz_progress_id',
                        'learner_quiz_progress.learner_course_id',
                        'learner_quiz_progress.syllabus_id',
                        'learner_quiz_progress.quiz_id',
                        'learner_quiz_progress.status',
                        'learner_quiz_progress.max_attempt',
                        'learner_quiz_progress.attempt',
                        'learner_quiz_progress.score',
                    )
                    ->where('learner_quiz_progress.learner_course_id', $learner_course->learner_course_id)
                    ->where('learner_quiz_progress.course_id', $course->course_id)
                    ->where('learner_quiz_progress.syllabus_id', $syllabus->syllabus_id)
                    ->where('learner_quiz_progress.quiz_id', $learnerSyllabusProgressData->quiz_id)
                    ->orderBy('learner_quiz_progress.learner_quiz_progress_id', 'DESC')
                    ->first();


                    if($learnerQuizProgressData->status === 'COMPLETED' || $learnerSyllabusProgressData === 'COMPLETED') {
                        return redirect()->route('view_quiz', [
                            'course' => $learnerSyllabusProgressData->course_id,
                            'learner_course' => $learnerSyllabusProgressData->learner_course_id,
                            'syllabus' => $learnerSyllabusProgressData->syllabus_id,
                        ])->with('error', 'Maximum number of Attempts taken.');
                    } else {

                        $learnerQuizOutputData = DB::table('learner_quiz_output')
                        ->select(
                            'learner_quiz_output.learner_quiz_output_id',
                            'learner_quiz_output.quiz_id',
                            'learner_quiz_output.quiz_content_id',
                            'learner_quiz_output.attempts',
                            'learner_quiz_output.answer',
                            'learner_quiz_output.isCorrect',
                        )
                        ->where('learner_quiz_output.learner_course_id', $learner_course->learner_course_id)
                        ->where('learner_quiz_output.course_id', $course->course_id)
                        ->where('learner_quiz_output.syllabus_id', $syllabus->syllabus_id)
                        ->where('learner_quiz_output.quiz_id', $learnerSyllabusProgressData->quiz_id)
                        ->where('learner_quiz_output.attempts', '=', $learnerQuizProgressData->attempt)
                        ->get();


                        if($learnerQuizOutputData->isEmpty()) {
                            $quizContentData = DB::table('quiz_content')
                                ->select(
                                    'quiz_content.quiz_content_id',
                                    'quiz_content.quiz_id',
                                    'quiz_content.course_id',
                                    'quiz_content.syllabus_id',
                                    'quiz_content.question_id',
                                )
                                ->where('quiz_content.quiz_id', $learnerSyllabusProgressData->quiz_id)
                                ->where('quiz_content.course_id', $learnerSyllabusProgressData->course_id)
                                ->where('quiz_content.syllabus_id', $learnerSyllabusProgressData->syllabus_id)
                                ->inRandomOrder()
                                ->get();

                                foreach($quizContentData as $question) {
                                    $questionRowData = [
                                        'learner_course_id' => $learner_course->learner_course_id,
                                        'learner_id' => $learnerSyllabusProgressData->learner_id,
                                        'course_id' => $question->course_id,
                                        'syllabus_id' => $question->syllabus_id,
                                        'quiz_id' => $question->quiz_id,
                                        'quiz_content_id' => $question->quiz_content_id,
                                        'attempts' => $learnerQuizProgressData->attempt,
                                    ];

                                    
                                    LearnerQuizOutputs::create($questionRowData);
                        }

                        $learnerQuizData = DB::table('learner_quiz_output')
                        ->select(
                            'learner_quiz_output.learner_quiz_output_id',
                            'learner_quiz_output.quiz_id',
                            'learner_quiz_output.quiz_content_id',
                            'quiz_content.course_id',
                            'quiz_content.question_id',
                            'questions.syllabus_id',
                            'questions.question',
                            'questions.category',
                            DB::raw('JSON_ARRAYAGG(question_answer.answer) as answers'),
                        )
                        ->join('quiz_content', 'learner_quiz_output.quiz_content_id', '=', 'quiz_content.quiz_content_id')
                        ->join('questions', 'quiz_content.question_id', '=', 'questions.question_id')
                        ->leftJoin('question_answer', 'questions.question_id', '=', 'question_answer.question_id')
                        ->where('learner_quiz_output.attempts', $learnerQuizProgressData->attempt)
                        ->where('quiz_content.quiz_id', $learnerSyllabusProgressData->quiz_id)
                        ->where('quiz_content.course_id', $learnerSyllabusProgressData->course_id)
                        ->where('quiz_content.syllabus_id', $learnerSyllabusProgressData->syllabus_id)
                        ->groupBy(
                            'learner_quiz_output.learner_quiz_output_id', // Include this line
                            'learner_quiz_output.quiz_content_id',
                            'quiz_content.course_id',
                            'quiz_content.question_id',
                            'questions.syllabus_id',
                            'questions.question',
                            'questions.category'
                        )
                        ->get();

                        
                    } else {
                        $learnerQuizData = DB::table('learner_quiz_output')
                        ->select(
                            'learner_quiz_output.learner_quiz_output_id',
                            'learner_quiz_output.quiz_id',
                            'learner_quiz_output.quiz_content_id',
                            'quiz_content.course_id',
                            'quiz_content.question_id',
                            'questions.syllabus_id',
                            'questions.question',
                            'questions.category',
                            DB::raw('JSON_ARRAYAGG(question_answer.answer) as answers'),
                        )
                        ->join('quiz_content', 'learner_quiz_output.quiz_content_id', '=', 'quiz_content.quiz_content_id')
                        ->join('questions', 'quiz_content.question_id', '=', 'questions.question_id')
                        ->leftJoin('question_answer', 'questions.question_id', '=', 'question_answer.question_id')
                        ->where('learner_quiz_output.attempts', $learnerQuizProgressData->attempt)
                        ->where('quiz_content.quiz_id', $learnerSyllabusProgressData->quiz_id)
                        ->where('quiz_content.course_id', $learnerSyllabusProgressData->course_id)
                        ->where('quiz_content.syllabus_id', $learnerSyllabusProgressData->syllabus_id)
                        ->groupBy(
                            'learner_quiz_output.learner_quiz_output_id', // Include this line
                            'learner_quiz_output.quiz_content_id',
                            'quiz_content.course_id',
                            'quiz_content.question_id',
                            'questions.syllabus_id',
                            'questions.question',
                            'questions.category'
                        )
                        ->get();

                    }
                }
    
                

                    $data = [
                        'title' => 'Quiz',
                        'scripts' => ['/L_course_quiz.js'],
                        'mainBackgroundCol' => $mainBackgroundCol,
                        'darkenedColor' => $darkenedColor,
                        'learnerSyllabusProgressData' => $learnerSyllabusProgressData,
                        'quizReferences' => $quizReferenceData,
                        'quizProgressData' => $learnerQuizProgressData,
                        'quizLearnerData' => $learnerQuizData,
                    ];

                    // dd($data);
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        } else {
            return redirect('/learner');
        }
    
        return view('learner_course.courseQuizAnswer', compact('learner'))
            ->with($data);
    }


    public function answer_quiz_json (Course $course, LearnerCourse $learner_course, Syllabus $syllabus) {


        try {

            $learnerSyllabusProgressData = DB::table('learner_syllabus_progress')
                    ->select(
                        'learner_syllabus_progress.learner_syllabus_progress_id',
                        'learner_syllabus_progress.learner_course_id',
                        'learner_syllabus_progress.learner_id',
                        'learner_syllabus_progress.course_id',
                        'learner_syllabus_progress.syllabus_id',
                        'learner_syllabus_progress.category',
                        'learner_syllabus_progress.status', 
                        'course.course_name',
                        'quizzes.quiz_id',
                        'quizzes.quiz_title',
                        'quizzes.duration',
                    )
                    ->join('quizzes', 'learner_syllabus_progress.syllabus_id', '=', 'quizzes.syllabus_id')
                    ->join('course','learner_syllabus_progress.course_id','=','course.course_id')
                    ->where('learner_syllabus_progress.course_id', $course->course_id)
                    ->where('learner_syllabus_progress.syllabus_id', $syllabus->syllabus_id)
                    ->where('learner_syllabus_progress.learner_course_id', $learner_course->learner_course_id)
                    ->first();

                
                    $quizReferenceData = DB::table('quiz_reference')
                    ->select(
                        'quiz_reference.quiz_reference_id',
                        'quiz_reference.quiz_id',
                        'quiz_reference.course_id',
                        'quiz_reference.syllabus_id',
                        'syllabus.topic_title',
                    )
                    ->join('syllabus', 'quiz_reference.syllabus_id', '=', 'syllabus.syllabus_id' )
                    ->where('quiz_reference.quiz_id', $learnerSyllabusProgressData->quiz_id)
                    ->get();


                    $learnerQuizProgressData = DB::table('learner_quiz_progress')
                    ->select(
                        'learner_quiz_progress.learner_quiz_progress_id',
                        'learner_quiz_progress.learner_course_id',
                        'learner_quiz_progress.syllabus_id',
                        'learner_quiz_progress.quiz_id',
                        'learner_quiz_progress.status',
                        'learner_quiz_progress.max_attempt',
                        'learner_quiz_progress.attempt',
                        'learner_quiz_progress.score',
                    )
                    ->where('learner_quiz_progress.learner_course_id', $learner_course->learner_course_id)
                    ->where('learner_quiz_progress.course_id', $course->course_id)
                    ->where('learner_quiz_progress.syllabus_id', $syllabus->syllabus_id)
                    ->where('learner_quiz_progress.quiz_id', $learnerSyllabusProgressData->quiz_id)
                    ->orderBy('learner_quiz_progress.learner_quiz_progress_id', 'DESC')
                    ->first();


                    if($learnerQuizProgressData->status === 'COMPLETED' || $learnerSyllabusProgressData === 'COMPLETED') {
                        return redirect()->route('view_quiz', [
                            'course' => $learnerSyllabusProgressData->course_id,
                            'learner_course' => $learnerSyllabusProgressData->learner_course_id,
                            'syllabus' => $learnerSyllabusProgressData->syllabus_id,
                        ])->with('error', 'Maximum number of Attempts taken.');
                    } else {

                        $learnerQuizOutputData = DB::table('learner_quiz_output')
                        ->select(
                            'learner_quiz_output.learner_quiz_output_id',
                            'learner_quiz_output.learner_course_id',
                            'learner_quiz_output.quiz_id',
                            'learner_quiz_output.quiz_content_id',
                            'learner_quiz_output.attempts',
                            'learner_quiz_output.answer',
                            'learner_quiz_output.isCorrect',
                        )
                        ->where('learner_quiz_output.learner_course_id', $learner_course->learner_course_id)
                        ->where('learner_quiz_output.course_id', $course->course_id)
                        ->where('learner_quiz_output.syllabus_id', $syllabus->syllabus_id)
                        ->where('learner_quiz_output.quiz_id', $learnerSyllabusProgressData->quiz_id)
                        ->where('learner_quiz_output.attempts', '=', $learnerQuizProgressData->attempt)
                        ->get();


                        if($learnerQuizOutputData->isEmpty()) {
                            $quizContentData = DB::table('quiz_content')
                                ->select(
                                    'quiz_content.quiz_content_id',
                                    'quiz_content.quiz_id',
                                    'quiz_content.course_id',
                                    'quiz_content.syllabus_id',
                                    'quiz_content.question_id',
                                )
                                ->where('quiz_content.quiz_id', $learnerSyllabusProgressData->quiz_id)
                                ->where('quiz_content.course_id', $learnerSyllabusProgressData->course_id)
                                ->where('quiz_content.syllabus_id', $learnerSyllabusProgressData->syllabus_id)
                                ->inRandomOrder()
                                ->get();

                                foreach($quizContentData as $question) {
                                    $questionRowData = [
                                        'learner_course_id' => $learner_course->learner_course_id,
                                        'learner_id' => $learnerSyllabusProgressData->learner_id,
                                        'course_id' => $question->course_id,
                                        'syllabus_id' => $question->syllabus_id,
                                        'quiz_id' => $question->quiz_id,
                                        'quiz_content_id' => $question->quiz_content_id,
                                        'attempts' => $learnerQuizProgressData->attempt,
                                    ];

                                    
                                    LearnerQuizOutputs::create($questionRowData);
                        }

                        $learnerQuizData = DB::table('learner_quiz_output')
                        ->select(
                            'learner_quiz_output.learner_quiz_output_id',
                            'learner_quiz_output.quiz_id',
                            'learner_quiz_output.learner_course_id',
                            'learner_quiz_output.quiz_content_id',
                            'quiz_content.course_id',
                            'quiz_content.question_id',
                            'questions.syllabus_id',
                            'questions.question',
                            'questions.category',
                            DB::raw('JSON_ARRAYAGG(question_answer.answer) as answers'),
                        )
                        ->join('quiz_content', 'learner_quiz_output.quiz_content_id', '=', 'quiz_content.quiz_content_id')
                        ->join('questions', 'quiz_content.question_id', '=', 'questions.question_id')
                        ->leftJoin('question_answer', 'questions.question_id', '=', 'question_answer.question_id')
                        ->where('learner_quiz_output.attempts', $learnerQuizProgressData->attempt)
                        ->where('learner_quiz_output.learner_course_id', $learner_course->learner_course_id)
                        ->where('quiz_content.quiz_id', $learnerSyllabusProgressData->quiz_id)
                        ->where('quiz_content.course_id', $learnerSyllabusProgressData->course_id)
                        ->where('quiz_content.syllabus_id', $learnerSyllabusProgressData->syllabus_id)
                        ->groupBy(
                            'learner_quiz_output.learner_quiz_output_id', // Include this line
                            'learner_quiz_output.quiz_content_id',
                            'quiz_content.course_id',
                            'quiz_content.question_id',
                            'questions.syllabus_id',
                            'questions.question',
                            'questions.category'
                        )
                        ->get();

                        
                    } else {
                        $learnerQuizData = DB::table('learner_quiz_output')
                        ->select(
                            'learner_quiz_output.learner_quiz_output_id',
                            'learner_quiz_output.quiz_id',
                            'learner_quiz_output.quiz_content_id',
                            'quiz_content.course_id',
                            'quiz_content.question_id',
                            'questions.syllabus_id',
                            'questions.question',
                            'questions.category',
                            DB::raw('JSON_ARRAYAGG(question_answer.answer) as answers'),
                        )
                        ->join('quiz_content', 'learner_quiz_output.quiz_content_id', '=', 'quiz_content.quiz_content_id')
                        ->join('questions', 'quiz_content.question_id', '=', 'questions.question_id')
                        ->leftJoin('question_answer', 'questions.question_id', '=', 'question_answer.question_id')
                        ->where('learner_quiz_output.attempts', $learnerQuizProgressData->attempt)
                        ->where('learner_quiz_output.learner_course_id', $learner_course->learner_course_id)
                        ->where('quiz_content.quiz_id', $learnerSyllabusProgressData->quiz_id)
                        ->where('quiz_content.course_id', $learnerSyllabusProgressData->course_id)
                        ->where('quiz_content.syllabus_id', $learnerSyllabusProgressData->syllabus_id)
                        ->groupBy(
                            'learner_quiz_output.learner_quiz_output_id', // Include this line
                            'learner_quiz_output.quiz_content_id',
                            'quiz_content.course_id',
                            'quiz_content.question_id',
                            'questions.syllabus_id',
                            'questions.question',
                            'questions.category'
                        )
                        ->get();

                    }
                }
    
                    $data = [
                        'learnerSyllabusProgressData' => $learnerSyllabusProgressData,
                        'quizReferences' => $quizReferenceData,
                        'quizProgressData' => $learnerQuizProgressData,
                        'quizLearnerData' => $learnerQuizData,
                    ];


                    return response()->json($data);

        } catch (ValidationException $e) {
                $errors = $e->validator->errors();
        
                return response()->json(['errors' => $errors], 422);
            }
    }


    public function submit_quiz (Course $course, LearnerCourse $learner_course, Syllabus $syllabus, Request $request) {

        try {
            
            $learner_quiz_output_id = $request->input('learner_quiz_output_id');
            $quiz_id = $request->input('quiz_id');
            $quiz_content_id = $request->input('quiz_content_id');
            $question_id = $request->input('question_id');

            $answer = $request->input('answer');

            DB::table('learner_quiz_output')
            ->where('learner_quiz_output_id', $learner_quiz_output_id)
            ->where('quiz_id', $quiz_id)
            ->where('quiz_content_id', $quiz_content_id)
            ->update([
                'answer' => $answer
            ]);


            $this->check_answer($learner_quiz_output_id, $quiz_id, $quiz_content_id, $question_id, $answer);



            // Return the counts in the response
            $data = [
            'message' => 'Learner Quiz Output submitted successfully',
            ];


            return response()->json($data);

        } catch (ValidationException $e) {
                $errors = $e->validator->errors();
        
                return response()->json(['errors' => $errors], 422);
            }

    }

    public function check_answer($learner_quiz_output_id, $quiz_id, $quiz_content_id, $question_id, $answer) {
        try {
            // If $answer is null, set isCorrect to 0
            $answerValue = $answer !== null
                ? DB::table('question_answer')
                    ->select('isCorrect')
                    ->where('question_id', $question_id)
                    ->where('answer', $answer)
                    ->first()
                : (object) ['isCorrect' => 0];

                $isCorrect = $answerValue !== null ? $answerValue->isCorrect : 0;
    
            DB::table('learner_quiz_output')
                ->where('learner_quiz_output_id', $learner_quiz_output_id)
                ->where('quiz_id', $quiz_id)
                ->where('quiz_content_id', $quiz_content_id)
                ->where('answer', $answer)
                ->update([
                    'isCorrect' => $isCorrect
                ]);
    
            // Return the correctness status
            return $answerValue !== null ? $answerValue->isCorrect : 0;

    
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    

    public function compute_score (Course $course, LearnerCourse $learner_course, Syllabus $syllabus, Request $request) {
        
        try {
            $learner_quiz_output_id = $request->input('learner_quiz_output_id');
            $quiz_id = $request->input('quiz_id');
            $quiz_content_id = $request->input('quiz_content_id');
            $question_id = $request->input('question_id');

            //fetch the learner_course_id, quiz_id, and attemp number for count later
            $learnerQuizOutputData = DB::table('learner_quiz_output')
            ->select(
                'learner_quiz_output_id',
                'learner_course_id',
                'course_id',
                'syllabus_id',
                'quiz_id',
                'quiz_content_id',
                'attempts',
            )
            ->where('learner_quiz_output_id', $learner_quiz_output_id)
            ->first();

            // update syllabus_progress
            DB::table('learner_syllabus_progress')
            ->where('course_id', $learnerQuizOutputData->course_id)
            ->where('syllabus_id', $learnerQuizOutputData->syllabus_id)
            ->where('learner_course_id', $learnerQuizOutputData->learner_course_id)
            ->update([
                'status' => 'IN PROGRESS'
            ]);


            // total items of the quiz
            $totalCount = DB::table('learner_quiz_output')
            ->where('quiz_id', $quiz_id)
            ->where('course_id', $learnerQuizOutputData->course_id)
            ->where('syllabus_id', $learnerQuizOutputData->syllabus_id)
            ->where('learner_course_id', $learnerQuizOutputData->learner_course_id)
            ->where('attempts', $learnerQuizOutputData->attempts)
            ->count();

            // score of the learner
            $scoreCount = DB::table('learner_quiz_output')
            ->where('isCorrect', 1)
            ->where('quiz_id', $quiz_id)
            ->where('course_id', $learnerQuizOutputData->course_id)
            ->where('syllabus_id', $learnerQuizOutputData->syllabus_id)
            ->where('learner_course_id', $learnerQuizOutputData->learner_course_id)
            ->where('attempts', $learnerQuizOutputData->attempts)
            ->count();
            

            // update the score and status
            DB::table('learner_quiz_progress')
            ->where('quiz_id', $quiz_id)
            ->where('course_id', $learnerQuizOutputData->course_id)
            ->where('syllabus_id', $learnerQuizOutputData->syllabus_id)
            ->where('learner_course_id', $learnerQuizOutputData->learner_course_id)
            ->where('attempt', $learnerQuizOutputData->attempts)
            ->update([
                'score' => $scoreCount,
                'remarks' => ($scoreCount >= $totalCount / 2) ? 'PASS' : 'FAIL',
            ]);

            $learnerQuizProgress = DB::table('learner_quiz_progress')
            ->select(
                'learner_quiz_progress_id',
                'learner_course_id',
                'course_id',
                'syllabus_id',
                'quiz_id',
                'status',
                'attempt',
                'score',
                'remarks',
            )
            ->where('quiz_id', $quiz_id)
            ->where('course_id', $learnerQuizOutputData->course_id)
            ->where('syllabus_id', $learnerQuizOutputData->syllabus_id)
            ->where('learner_course_id', $learnerQuizOutputData->learner_course_id)
            ->where('attempt', $learnerQuizOutputData->attempts)
            ->first();


            if($learnerQuizProgress !== 'COMPLETED') {

                       // update the score and status
                   DB::table('learner_quiz_progress')
                   ->where('quiz_id', $quiz_id)
                   ->where('course_id', $learnerQuizOutputData->course_id)
                   ->where('syllabus_id', $learnerQuizOutputData->syllabus_id)
                   ->where('learner_course_id', $learnerQuizOutputData->learner_course_id)
                   ->where('attempt', $learnerQuizOutputData->attempts)
                   ->update([
                       'status' => 'COMPLETED',
                   ]);

                if($scoreCount >= $totalCount / 2) {

                    // update syllabus_progress
                    DB::table('learner_syllabus_progress')
                    ->where('course_id', $learnerQuizOutputData->course_id)
                    ->where('syllabus_id', $learnerQuizOutputData->syllabus_id)
                    ->where('learner_course_id', $learnerQuizOutputData->learner_course_id)
                    ->update([
                        'status' => 'COMPLETED'
                    ]);


                    // Find the next lesson that is still 'LOCKED' and update its status to 'NOT YET STARTED'
                    $nextLesson = DB::table('learner_syllabus_progress')
                    ->where('learner_course_id' , $learnerQuizOutputData->learner_course_id)
                    ->where('course_id', $learnerQuizOutputData->course_id)
                    ->where('status', 'LOCKED')
                    ->orderBy('learner_syllabus_progress_id', 'ASC')
                    ->limit(1)
                    ->first();

                    if ($nextLesson) {
                        DB::table('learner_syllabus_progress')
                            ->where('learner_syllabus_progress_id', $nextLesson->learner_syllabus_progress_id)
                            ->update(['status' => 'NOT YET STARTED']);
                    }
                }

            }

            $data = [
                'message' => 'Learner Quiz Scored successfully',
                ];
    
    
                return response()->json($data);
    

        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
        
            return response()->json(['errors' => $errors], 422);
        }
    }   


    public function view_output (Course $course, LearnerCourse $learner_course, Syllabus $syllabus, $attempt) {
        if (auth('learner')->check()) {
            $learner = session('learner'); 
            try {

                if (!function_exists('getRandomColor')) {
                    function getRandomColor() {
                        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                    }
                }
    
                // Generate a random color for mainBackgroundCol
                $mainBackgroundCol = getRandomColor();
    
                // Darken the mainBackgroundCol
                $mainColorRGB = sscanf($mainBackgroundCol, "#%02x%02x%02x");
                $mainBackgroundCol = sprintf("#%02x%02x%02x", $mainColorRGB[0] * 0.6, $mainColorRGB[1] * 0.6, $mainColorRGB[2] * 0.6);
    
                // Darken the mainBackgroundCol further for darkenedColor
                $darkenedColor = sprintf("#%02x%02x%02x", $mainColorRGB[0] * 0.4, $mainColorRGB[1] * 0.4, $mainColorRGB[2] * 0.4);

                $learnerSyllabusProgressData = DB::table('learner_syllabus_progress')
                    ->select(
                        'learner_syllabus_progress.learner_syllabus_progress_id',
                        'learner_syllabus_progress.learner_course_id',
                        'learner_syllabus_progress.learner_id',
                        'learner_syllabus_progress.course_id',
                        'learner_syllabus_progress.syllabus_id',
                        'learner_syllabus_progress.category',
                        'learner_syllabus_progress.status', 
                        'course.course_name',
                        'quizzes.quiz_id',
                        'quizzes.quiz_title',
                    )
                    ->join('quizzes', 'learner_syllabus_progress.syllabus_id', '=', 'quizzes.syllabus_id')
                    ->join('course','learner_syllabus_progress.course_id','=','course.course_id')
                    ->where('learner_syllabus_progress.course_id', $course->course_id)
                    ->where('learner_syllabus_progress.syllabus_id', $syllabus->syllabus_id)
                    ->where('learner_syllabus_progress.learner_course_id', $learner_course->learner_course_id)
                    ->first();

                
                    $quizReferenceData = DB::table('quiz_reference')
                    ->select(
                        'quiz_reference.quiz_reference_id',
                        'quiz_reference.quiz_id',
                        'quiz_reference.course_id',
                        'quiz_reference.syllabus_id',
                        'syllabus.topic_title',
                    )
                    ->join('syllabus', 'quiz_reference.syllabus_id', '=', 'syllabus.syllabus_id' )
                    ->where('quiz_reference.quiz_id', $learnerSyllabusProgressData->quiz_id)
                    ->get();


                    $learnerQuizProgressData = DB::table('learner_quiz_progress')
                    ->select(
                        'learner_quiz_progress.learner_quiz_progress_id',
                        'learner_quiz_progress.learner_course_id',
                        'learner_quiz_progress.syllabus_id',
                        'learner_quiz_progress.quiz_id',
                        'learner_quiz_progress.status',
                        'learner_quiz_progress.max_attempt',
                        'learner_quiz_progress.attempt',
                        'learner_quiz_progress.score',
                    )
                    ->where('learner_quiz_progress.learner_course_id', $learner_course->learner_course_id)
                    ->where('learner_quiz_progress.course_id', $course->course_id)
                    ->where('learner_quiz_progress.syllabus_id', $syllabus->syllabus_id)
                    ->where('learner_quiz_progress.quiz_id', $learnerSyllabusProgressData->quiz_id)
                    ->orderBy('learner_quiz_progress.learner_quiz_progress_id', 'DESC')
                    ->first();


                    $data = [
                        'title' => 'Quiz',
                        'scripts' => ['/L_course_quiz_output.js'],
                        'mainBackgroundCol' => $mainBackgroundCol,
                        'darkenedColor' => $darkenedColor,
                        'learnerSyllabusProgressData' => $learnerSyllabusProgressData,
                        'quizReferences' => $quizReferenceData,
                        'quizProgressData' => $learnerQuizProgressData,
                        // 'quizLearnerData' => $learnerQuizData,
                    ];

                    // dd($data);

            return view('learner_course.courseQuizOutput', compact('learner'))
            ->with($data);


            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        } else {
            return redirect('/learner');
        }
    }

    public function view_output_json (Course $course, LearnerCourse $learner_course, Syllabus $syllabus, $attempt) {

        try {

            $learnerSyllabusProgressData = DB::table('learner_syllabus_progress')
                    ->select(
                        'learner_syllabus_progress.learner_syllabus_progress_id',
                        'learner_syllabus_progress.learner_course_id',
                        'learner_syllabus_progress.learner_id',
                        'learner_syllabus_progress.course_id',
                        'learner_syllabus_progress.syllabus_id',
                        'learner_syllabus_progress.category',
                        'learner_syllabus_progress.status', 
                        'course.course_name',
                        'quizzes.quiz_id',
                        'quizzes.quiz_title',
                    )
                    ->join('quizzes', 'learner_syllabus_progress.syllabus_id', '=', 'quizzes.syllabus_id')
                    ->join('course','learner_syllabus_progress.course_id','=','course.course_id')
                    ->where('learner_syllabus_progress.course_id', $course->course_id)
                    ->where('learner_syllabus_progress.syllabus_id', $syllabus->syllabus_id)
                    ->where('learner_syllabus_progress.learner_course_id', $learner_course->learner_course_id)
                    ->first();

                
                    $quizReferenceData = DB::table('quiz_reference')
                    ->select(
                        'quiz_reference.quiz_reference_id',
                        'quiz_reference.quiz_id',
                        'quiz_reference.course_id',
                        'quiz_reference.syllabus_id',
                        'syllabus.topic_title',
                    )
                    ->join('syllabus', 'quiz_reference.syllabus_id', '=', 'syllabus.syllabus_id' )
                    ->where('quiz_reference.quiz_id', $learnerSyllabusProgressData->quiz_id)
                    ->get();


                    $learnerQuizProgressData = DB::table('learner_quiz_progress')
                    ->select(
                        'learner_quiz_progress.learner_quiz_progress_id',
                        'learner_quiz_progress.learner_course_id',
                        'learner_quiz_progress.syllabus_id',
                        'learner_quiz_progress.quiz_id',
                        'learner_quiz_progress.status',
                        'learner_quiz_progress.max_attempt',
                        'learner_quiz_progress.attempt',
                        'learner_quiz_progress.score',
                    )
                    ->where('learner_quiz_progress.learner_course_id', $learner_course->learner_course_id)
                    ->where('learner_quiz_progress.course_id', $course->course_id)
                    ->where('learner_quiz_progress.syllabus_id', $syllabus->syllabus_id)
                    ->where('learner_quiz_progress.quiz_id', $learnerSyllabusProgressData->quiz_id)
                    ->orderBy('learner_quiz_progress.learner_quiz_progress_id', 'DESC')
                    ->first();


                    $correctAnswerSubquery = DB::table('question_answer')
                        ->select('question_id', DB::raw('JSON_ARRAYAGG(answer) as correct_answer'))
                        ->where('isCorrect', 1)
                        ->groupBy('question_id');

                    $learnerQuizData = DB::table('learner_quiz_output')
                        ->select(
                            'learner_quiz_output.learner_quiz_output_id',
                            'learner_quiz_output.quiz_id',
                            'learner_quiz_output.quiz_content_id',
                            'learner_quiz_output.attempts',
                            'learner_quiz_output.answer',
                            'learner_quiz_output.isCorrect',
                            'quiz_content.course_id',
                            'quiz_content.question_id',
                            'questions.syllabus_id',
                            'questions.question',
                            'questions.category',
                            DB::raw('JSON_ARRAYAGG(question_answer.answer) as all_choices'),
                            DB::raw('correct_answers.correct_answer')
                        )
                        ->join('quiz_content', 'learner_quiz_output.quiz_content_id', '=', 'quiz_content.quiz_content_id')
                        ->join('questions', 'quiz_content.question_id', '=', 'questions.question_id')
                        ->leftJoinSub($correctAnswerSubquery, 'correct_answers', function ($join) {
                            $join->on('questions.question_id', '=', 'correct_answers.question_id');
                        })
                        ->leftJoin('question_answer', 'questions.question_id', '=', 'question_answer.question_id')
                        ->where('learner_quiz_output.attempts', $attempt)
                        ->where('learner_quiz_output.learner_course_id', $learner_course->learner_course_id)
                        ->where('quiz_content.quiz_id', $learnerSyllabusProgressData->quiz_id)
                        ->where('quiz_content.course_id', $learnerSyllabusProgressData->course_id)
                        ->where('quiz_content.syllabus_id', $learnerSyllabusProgressData->syllabus_id)
                        ->groupBy(
                            'learner_quiz_output.learner_quiz_output_id',
                            'learner_quiz_output.quiz_content_id',
                            'quiz_content.course_id',
                            'quiz_content.question_id',
                            'questions.syllabus_id',
                            'questions.question',
                            'questions.category',
                            'correct_answers.correct_answer'
                        )
                        ->get();



                    $data = [
                        'learnerSyllabusProgressData' => $learnerSyllabusProgressData,
                        'quizReferences' => $quizReferenceData,
                        'quizProgressData' => $learnerQuizProgressData,
                        'quizLearnerData' => $learnerQuizData,
                    ];

                    return response()->json($data);

        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
        
            return response()->json(['errors' => $errors], 422);
        }

    }


}
