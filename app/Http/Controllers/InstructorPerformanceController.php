<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\LearnerCourse;
use App\Models\LessonContents;
use App\Models\ActivityContents;
use App\Models\ActivityContentCriterias;
use App\Models\Syllabus;
use App\Models\Lessons;
use App\Models\Activities;
use App\Models\Quizzes;
use App\Models\LearnerCourseProgress;
use App\Models\LearnerSyllabusProgress;
use App\Models\LearnerLessonProgress;
use App\Models\LearnerActivityProgress;
use App\Models\LearnerQuizProgress;
use App\Models\LearnerActivityOutput;
use App\Models\LearnerActivityCriteriaScore;
use App\Models\QuizContents;
use App\Models\QuizReferences;
use App\Models\Questions;
use App\Models\QuestionAnswers;
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
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\URL;
use Dompdf\Dompdf;

class InstructorPerformanceController extends Controller
{
    

    public function performances() {
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            

            try {
                $courses = DB::table('course')
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
                ->orderBy("course.created_at", "ASC")
                ->get();

            } catch (\Exception $e) {
                dd($e->getMessage());
            }

        } else {
            return redirect('/instructor');
        }

        $data = [
            'title' => 'Performance',
            'scripts' => ['instructor_performance.js'],
            'courses' => $courses,
        ];

        // dd($data);
        return view('instructor_performance.instructorPerformance' , compact('instructor', 'courses'))
        ->with($data);
    }


    public function totalCourseNum () {
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            
            try{

                $totalCourseNum = DB::table('course')
                ->where('instructor_id', $instructor->instructor_id)
                ->count();

                $totalPendingCourseNum = DB::table('course')
                ->where('instructor_id', $instructor->instructor_id)
                ->where('course_status', 'Pending')
                ->count();

                $totalApprovedCourseNum = DB::table('course')
                ->where('instructor_id', $instructor->instructor_id)
                ->where('course_status', 'Approved')
                ->count();

                $totalRejectedCourseNum = DB::table('course')
                ->where('instructor_id', $instructor->instructor_id)
                ->where('course_status', 'Rejected')
                ->count();

                $allInstructorCourses = DB::table('course')
                ->select(
                    'course.course_id',
                    'course.course_name',
                    'course.course_code',
                    'course.course_description',
                    'course.course_status',
                    'course.course_difficulty',
                    'course.created_at',
                    'course.updated_at',
                    DB::raw('COUNT(learner_course.learner_course_id) as learnerCount'),
                    DB::raw('COUNT(CASE WHEN learner_course.status = "Approved" THEN learner_course.learner_course_id END) as approvedLearnerCount')
                )
                ->join('learner_course', 'learner_course.course_id', '=', 'course.course_id')
                ->where('instructor_id', $instructor->instructor_id)
                ->groupBy(
                    'course.course_id',
                    'course.course_name',
                    'course.course_code',
                    'course.course_description',
                    'course.course_status',
                    'course.course_difficulty',
                    'course.created_at',
                    'course.updated_at'
                )
                ->get();




                $totalLearnersCount = 0;
                $totalPendingLearnersCount = 0;
                $totalApprovedLearnersCount = 0;
                $totalRejectedLearnersCount = 0;

                $totalSyllabusCount = 0;
                $totalLessonsCount = 0;
                $totalActivitiesCount = 0;
                $totalQuizzesCount = 0;

                foreach ($allInstructorCourses as $course) {

                    $totalLearnersCount += DB::table('learner_course')
                    ->where('course_id', $course->course_id)
                    ->count();

                    $totalPendingLearnersCount += DB::table('learner_course')
                    ->where('course_id', $course->course_id)
                    ->where('status', 'Pending')
                    ->count();

                    $totalApprovedLearnersCount += DB::table('learner_course')
                    ->where('course_id', $course->course_id)
                    ->where('status', 'Approved')
                    ->count();

                    $totalRejectedLearnersCount += DB::table('learner_course')
                    ->where('course_id', $course->course_id)
                    ->where('status', 'Rejected')
                    ->count();

                    $totalSyllabusCount += DB::table('syllabus')
                    ->where('course_id', $course->course_id)
                    ->count();

                    $totalLessonsCount += DB::table('syllabus')
                    ->where('course_id', $course->course_id)
                    ->where('category', 'LESSON')
                    ->count();

                    $totalActivitiesCount += DB::table('syllabus')
                    ->where('course_id', $course->course_id)
                    ->where('category', 'ACTIVITY')
                    ->count();

                    $totalQuizzesCount += DB::table('syllabus')
                    ->where('course_id', $course->course_id)
                    ->where('category', 'QUIZ')
                    ->count();
                }

                $data = [
                    'title' => 'Performance',
                    'scripts' => ['instructor_performance.js'],
                    'totalCourseNum' => $totalCourseNum,
                    'allInstructorCourses' => $allInstructorCourses,
                    'totalLearnersCount' => $totalLearnersCount,
                    'totalPendingLearnersCount' => $totalPendingLearnersCount,
                    'totalApprovedLearnersCount' => $totalApprovedLearnersCount,
                    'totalRejectedLearnersCount' => $totalRejectedLearnersCount,
                    'totalSyllabusCount' => $totalSyllabusCount,
                    'totalLessonsCount' => $totalLessonsCount,
                    'totalActivitiesCount' => $totalActivitiesCount,
                    'totalQuizzesCount' => $totalQuizzesCount,
                    'totalPendingCourseNum' => $totalPendingCourseNum,
                    'totalApprovedCourseNum' => $totalApprovedCourseNum,
                    'totalRejectedCourseNum' => $totalRejectedCourseNum,
                ];
        
                return response()->json($data);
            } catch (ValidationException $e) {
                $errors = $e->validator->errors();

                return response()->json(['errors' => $errors], 422);
            }


        } else {
            return redirect('/instructor');
        }
    }


    public function courseChartData(Request $request) {
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            
            try{
                
                $selectedCourse = $request->input('selectedCourse');

                $totalCourseNum = DB::table('course')
                ->where('instructor_id', $instructor->instructor_id)
                ->count();

                $totalPendingCourseNum = DB::table('course')
                ->where('instructor_id', $instructor->instructor_id)
                ->where('course_status', 'Pending')
                ->count();

                $totalApprovedCourseNum = DB::table('course')
                ->where('instructor_id', $instructor->instructor_id)
                ->where('course_status', 'Approved')
                ->count();

                $totalRejectedCourseNum = DB::table('course')
                ->where('instructor_id', $instructor->instructor_id)
                ->where('course_status', 'Rejected')
                ->count();

                if ($selectedCourse === "ALL") {
                    $courseData = DB::table('learner_course')
                    ->select(
                        'learner_course.learner_course_id',
                        'learner_course.status',
                        DB::raw('YEAR(learner_course.created_at) as year'), // Extract year
                        DB::raw('MONTH(learner_course.created_at) as month'), // Extract month
                        DB::raw('DAY(learner_course.created_at) as day'), // Extract day
                        DB::raw('TIME(learner_course.created_at) as time'), // Extract time
                        'course.course_name',
                        'learner_course.course_id',
                    )
                    ->join('course', 'learner_course.course_id', '=', 'course.course_id')
                    ->where('course.instructor_id', $instructor->instructor_id)
                    ->get();

                    $data = [
                        'title' => 'Performance',
                        'scripts' => ['instructor_performance.js'],
                        'courseData' => $courseData,
                        'totalCourseNum' => $totalCourseNum,
                        'totalPendingCourseNum' => $totalPendingCourseNum,
                        'totalApprovedCourseNum' => $totalApprovedCourseNum,
                        'totalRejectedCourseNum' => $totalRejectedCourseNum
                        ];
                } else {
                    $courseData = DB::table('learner_course')
                    ->select(
                        'learner_course.learner_course_id',
                        'learner_course.status',
                        DB::raw('YEAR(learner_course.created_at) as year'), // Extract year
                        DB::raw('MONTH(learner_course.created_at) as month'), // Extract month
                        DB::raw('DAY(learner_course.created_at) as day'), // Extract day
                        DB::raw('TIME(learner_course.created_at) as time'), // Extract time
                        'learner_course.course_id',

                        'course.course_name',
                        'course.course_status',
                        'course.course_code',
                        'course.created_at',
                        'course.updated_at',
                    )
                    ->join('course', 'learner_course.course_id', '=', 'course.course_id')
                    ->where('course.instructor_id', $instructor->instructor_id)
                    ->where('learner_course.course_id', $selectedCourse)
                    ->get();

                    $totalLearnersCount = 0;
                    $totalPendingLearnersCount = 0;
                    $totalApprovedLearnersCount = 0;
                    $totalRejectedLearnersCount = 0;
    
                    $totalSyllabusCount = 0;
                    $totalLessonsCount = 0;
                    $totalActivitiesCount = 0;
                    $totalQuizzesCount = 0;

                    if ($courseData->isNotEmpty()) {
                        $course = $courseData->first();

                        $totalLearnersCount += DB::table('learner_course')
                        ->where('course_id', $course->course_id)
                        ->count();
    
                        $totalPendingLearnersCount += DB::table('learner_course')
                        ->where('course_id', $course->course_id)
                        ->where('status', 'Pending')
                        ->count();
    
                        $totalApprovedLearnersCount += DB::table('learner_course')
                        ->where('course_id', $course->course_id)
                        ->where('status', 'Approved')
                        ->count();
    
                        $totalRejectedLearnersCount += DB::table('learner_course')
                        ->where('course_id', $course->course_id)
                        ->where('status', 'Rejected')
                        ->count();
    
                        $totalSyllabusCount += DB::table('syllabus')
                        ->where('course_id', $course->course_id)
                        ->count();
    
                        $totalLessonsCount += DB::table('syllabus')
                        ->where('course_id', $course->course_id)
                        ->where('category', 'LESSON')
                        ->count();
    
                        $totalActivitiesCount += DB::table('syllabus')
                        ->where('course_id', $course->course_id)
                        ->where('category', 'ACTIVITY')
                        ->count();
    
                        $totalQuizzesCount += DB::table('syllabus')
                        ->where('course_id', $course->course_id)
                        ->where('category', 'QUIZ')
                        ->count();


                        $data = [
                            'title' => 'Performance',
                            'scripts' => ['instructor_performance.js'],
                            'courseData' => $courseData,
                            'totalLearnersCount' => $totalLearnersCount,
                            'totalPendingLearnersCount' => $totalPendingLearnersCount,
                            'totalApprovedLearnersCount' => $totalApprovedLearnersCount,
                            'totalRejectedLearnersCount' => $totalRejectedLearnersCount,
                            'totalSyllabusCount' => $totalSyllabusCount,
                            'totalLessonsCount' => $totalLessonsCount,
                            'totalActivitiesCount' => $totalActivitiesCount,
                            'totalQuizzesCount' => $totalQuizzesCount,'totalCourseNum' => $totalCourseNum,
                            'totalPendingCourseNum' => $totalPendingCourseNum,
                            'totalApprovedCourseNum' => $totalApprovedCourseNum,
                            'totalRejectedCourseNum' => $totalRejectedCourseNum
                            ];
                    } else {
                    }
                    

                    
                }

    
            return response()->json($data);
            } catch (ValidationException $e) {
                $errors = $e->validator->errors();

                return response()->json(['errors' => $errors], 422);
            }


        } else {
            return redirect('/instructor');
        }
    }

    public function coursePerformance(Course $course) {
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            

            try {
                $course = DB::table('course')
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
                ->orderBy("course.created_at", "ASC")
                ->where('course.course_id', $course->course_id)
                ->first();

                $syllabus = DB::table('syllabus')
                ->select(
                    'syllabus_id',
                    'topic_id',
                    'topic_title',
                    'category',
                )
                ->where('course_id', $course->course_id)
                ->get();

            } catch (\Exception $e) {
                dd($e->getMessage());
            }

        } else {
            return redirect('/instructor');
        }

        $data = [
            'title' => 'Course Performance',
            'scripts' => ['instructor_course_performance.js'],
            'course' => $course,
            'syllabus' => $syllabus
        ];

        // dd($data);
        return view('instructor_performance.instructorCoursePerformance' , compact('instructor', 'course'))
        ->with($data);
    }

    public function selectedCoursePerformance(Course $course) {
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            

            try {
                $totalLearnerCourseCount = DB::table('learner_course')
                ->where('course_id', $course->course_id)
                ->count();
                
                $totalApprovedLearnerCourseCount = DB::table('learner_course')
                ->where('course_id', $course->course_id)
                ->where('status', 'Approved')
                ->count();

                $totalPendingLearnerCourseCount = DB::table('learner_course')
                ->where('course_id', $course->course_id)
                ->where('status', 'Pending')
                ->count();

                $totalRejectedLearnerCourseCount = DB::table('learner_course')
                ->where('course_id', $course->course_id)
                ->where('status', 'Rejected')
                ->count();


                $totalSyllabusCount = DB::table('syllabus')
                ->where('course_id', $course->course_id)
                ->count();

                $totalLessonsCount = DB::table('syllabus')
                ->where('course_id', $course->course_id)
                ->where('category', 'LESSON')
                ->count();

                $totalActivitiesCount = DB::table('syllabus')
                ->where('course_id', $course->course_id)
                ->where('category', 'ACTIVITY')
                ->count();

                $totalQuizzesCount = DB::table('syllabus')
                ->where('course_id', $course->course_id)
                ->where('category', 'QUIZ')
                ->count();

                $data = [
                    'title' => 'Performance',
                    'totalLearnerCourseCount' => $totalLearnerCourseCount,
                    'totalApprovedLearnerCourseCount' => $totalApprovedLearnerCourseCount,
                    'totalPendingLearnerCourseCount' => $totalPendingLearnerCourseCount,
                    'totalRejectedLearnerCourseCount' => $totalRejectedLearnerCourseCount,
                    'totalSyllabusCount' => $totalSyllabusCount,
                    'totalLessonsCount' => $totalLessonsCount,
                    'totalActivitiesCount' => $totalActivitiesCount,
                    'totalQuizzesCount' => $totalQuizzesCount,
                    ];

                return response()->json($data);
            } catch (ValidationException $e) {
                $errors = $e->validator->errors();

                return response()->json(['errors' => $errors], 422);
            }


        } else {
            return redirect('/instructor');
        }
    }

    public function learnerCourseData(Course $course) {
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            

            try {
                // $learnerCourseData = DB::table('learner_course')
                // ->select(
                //     'learner_course.learner_course_id',
                //     'learner_course.learner_id',
                //     'learner_course.status',

                //     'learner.learner_fname',
                //     'learner.learner_lname',
                // )
                // ->join('learner', 'learner.learner_id', '=', 'learner_course.learner_id')
                // ->where('learner_course.course_id', $course->course_id)
                // ->get();

                $learnerCourseProgressData = DB::table('learner_course_progress')
                ->select(
                    'learner_course_progress.learner_course_progress_id',
                    'learner_course_progress.learner_course_id',
                    'learner_course_progress.course_progress',
                    'learner_course_progress.start_period',
                    'learner_course_progress.finish_period',

                    'learner.learner_fname',
                    'learner.learner_lname',
                )
                ->join('learner', 'learner.learner_id', '=', 'learner_course_progress.learner_id')
                ->where('learner_course_progress.course_id', $course->course_id)
                ->get();

                $data = [
                    'title' => 'Performance',
                    // 'learnerCourseData' => $learnerCourseData,
                    'learnerCourseProgressData' => $learnerCourseProgressData,
                    ];

                return response()->json($data);
            } catch (ValidationException $e) {
                $errors = $e->validator->errors();

                return response()->json(['errors' => $errors], 422);
            }


        } else {
            return redirect('/instructor');
        }
    }

    public function learnerSyllabusData(Course $course, Request $request) {
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            
            try {

                $syllabus_id = $request->input('syllabus_id');

                $syllabusData = DB::table('syllabus')
                ->select(
                    'syllabus_id',
                    'course_id',
                    'topic_id',
                    'topic_title',
                    'category',
                )
                ->where('course_id', $course->course_id)
                ->where('syllabus_id', $syllabus_id)
                ->first();

                if($syllabusData->category == 'LESSON') {
                    $learnerSyllabusData = DB::table('learner_lesson_progress')
                    ->select(
                        'learner_lesson_progress.learner_lesson_progress_id AS learner_progress_id',
                        'learner_lesson_progress.learner_course_id',
                        'learner_lesson_progress.course_id',
                        'learner_lesson_progress.syllabus_id',
                        'learner_lesson_progress.lesson_id AS topic_id',
                        'learner_lesson_progress.status',
                        'learner_lesson_progress.start_period',
                        'learner_lesson_progress.finish_period',

                        'learner.learner_fname',
                        'learner.learner_lname',

                        'learner_course.created_at',
                    )
                    ->join('learner', 'learner_lesson_progress.learner_id', '=', 'learner.learner_id')
                    ->join('learner_course', 'learner.learner_id', '=', 'learner_course.learner_id')
                    ->where('learner_lesson_progress.course_id', $course->course_id)
                    ->where('learner_lesson_progress.syllabus_id', $syllabus_id)
                    ->get();
                } else if ($syllabusData->category == 'ACTIVITY') {
                    $learnerSyllabusData = DB::table('learner_activity_progress')
                    ->select(
                        'learner_activity_progress.learner_activity_progress_id AS learner_progress_id',
                        'learner_activity_progress.learner_course_id',
                        'learner_activity_progress.course_id',
                        'learner_activity_progress.syllabus_id',
                        'learner_activity_progress.activity_id AS topic_id',
                        'learner_activity_progress.status',
                        'learner_activity_progress.start_period',
                        'learner_activity_progress.finish_period',

                        
                        'learner.learner_fname',
                        'learner.learner_lname',

                        'learner_course.created_at',
                    )
                    ->join('learner', 'learner_activity_progress.learner_id', '=', 'learner.learner_id')
                    ->join('learner_course', 'learner.learner_id', '=', 'learner_course.learner_id')
                    ->where('learner_activity_progress.course_id', $course->course_id)
                    ->where('learner_activity_progress.syllabus_id', $syllabus_id)
                    ->get();
                } else {
                    $learnerSyllabusData = DB::table('learner_quiz_progress')
                    ->select(
                        'learner_quiz_progress.learner_quiz_progress_id AS learner_progress_id',
                        'learner_quiz_progress.learner_course_id',
                        'learner_quiz_progress.course_id',
                        'learner_quiz_progress.syllabus_id',
                        'learner_quiz_progress.quiz_id AS topic_id',
                        'learner_quiz_progress.status',
                        'learner_quiz_progress.start_period',
                        'learner_quiz_progress.finish_period',
                        'learner_quiz_progress.attempt',
                      
                        'learner.learner_fname',
                        'learner.learner_lname',

                        'learner_course.created_at',
                    )
                    ->join('learner', 'learner_quiz_progress.learner_id', '=', 'learner.learner_id')
                    ->join('learner_course', 'learner.learner_id', '=', 'learner_course.learner_id')
                    ->where('learner_quiz_progress.course_id', $course->course_id)
                    ->where('learner_quiz_progress.syllabus_id', $syllabus_id)
                    ->get();
                }

                $data = [
                    'title' => 'Performance',
                    'syllabusData' => $syllabusData,
                    'learnerSyllabusData' => $learnerSyllabusData,
                    ];

                return response()->json($data);
            } catch (ValidationException $e) {
                $errors = $e->validator->errors();

                return response()->json(['errors' => $errors], 422);
            }


        } else {
            return redirect('/instructor');
        }
    }
}
