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
use App\Models\LearnerPreAssessmentProgress;
use App\Models\LearnerPreAssessmentOutput;
use App\Models\LearnerPostAssessmentProgress;
use App\Models\LearnerPostAssessmentOutput;
use App\Models\Message;
use App\Models\MessageContent;
use App\Models\MessageContentFile;
use App\Models\MessageReply;
use App\Models\MessageReplyContent;
use App\Models\MessageReplyContentFile;
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
use Carbon\Carbon;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Codedge\Fpdf\Fpdf\Fpdf;


class AdminPerformanceController extends Controller
{
    public function index() {
        if (auth('admin')->check()) {
            $adminSession = session('admin');
                try {

                    $data = [
                        'title' => 'Performance',
                        'scripts' => ['AD_performance.js'],
                        'admin' => $adminSession,
                    ];


                    return view('adminPerformance.performance')
                    ->with($data);

                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }  else {
                return redirect('/admin');
            }
    }

    public function learner_overview() {
        if (auth('admin')->check()) {
            $adminSession = session('admin');
                try {

                    $totalLearnerCount = DB::table('learner')
                    ->count();

                    $learnersPerDay = DB::table('learner')
                    ->select(DB::raw('DATE(created_at) as day'), DB::raw('COUNT(*) as count'))
                    ->groupBy('day')
                    ->orderBy('day')
                    ->get();

                // Format the date in words
                $learnersPerDay->transform(function ($item) {
                    $item->day = Carbon::parse($item->day)->format('F j, Y');
                    return $item;
                });

                $learnerStatusCount = DB::table('learner')
                ->select(
                    'status'
                )
                ->get();


                $learnersPerWeek = DB::table('learner')
                ->select(DB::raw('CONCAT("Week ", WEEK(created_at), " of ", YEAR(created_at)) as week'), DB::raw('COUNT(*) as count'))
                ->groupBy('week')
                ->orderBy('week')
                ->get();

                $learnersPerMonth = DB::table('learner')
                ->select(DB::raw('DATE_FORMAT(created_at, "%M %Y") as month'), DB::raw('COUNT(*) as count'))
                ->groupBy('month')
                ->orderBy('month')
                ->get();


                // $hourlyCounts = DB::table('session_logs')
                // ->select(DB::raw("DATE_FORMAT(session_in, '%W, %M %e, %Y %l:00 %p') AS hour_start"), DB::raw('COUNT(*) as session_count'))
                // ->where('session_user_type', 'LEARNER')
                // ->groupBy(DB::raw("DATE(session_in)"), DB::raw("HOUR(session_in)"))
                // ->orderByRaw("DATE(session_in) DESC, HOUR(session_in) DESC")
                // ->get();
            
   $hourlyCounts = DB::table('session_logs')
                ->select(DB::raw("DATE_FORMAT(session_in, '%W, %M %e, %Y %l:00 %p') AS hour_start"), DB::raw('COUNT(*) as session_count'))
                ->where('session_user_type', 'LEARNER')
                ->groupBy('hour_start')
                ->orderBy('hour_start' , 'DESC')
                ->get();

                $dailyCounts = DB::table('session_logs')
                ->select(DB::raw("DATE_FORMAT(session_in, '%W, %M %e, %Y') AS day_start"), DB::raw('COUNT(*) as session_count'))
                ->where('session_user_type', 'LEARNER')
                ->groupBy('day_start')
                ->orderBy('day_start' ,  'DESC')
                ->get();


                $weeklyCounts = DB::table('session_logs')
                ->select(DB::raw("CONCAT('Week ', WEEK(session_in), ', ', YEAR(session_in)) AS week_start"), DB::raw('COUNT(*) as session_count'))
                ->where('session_user_type', 'LEARNER')
                ->groupBy('week_start')
                ->orderBy('week_start'  , 'DESC')
                ->get();

                $monthlyCounts = DB::table('session_logs')
                ->select(DB::raw("DATE_FORMAT(session_in, '%M %Y') AS month_start"), DB::raw('COUNT(*) as session_count'))
                ->where('session_user_type', 'LEARNER')
                ->groupBy('month_start')
                ->orderBy('month_start'  , 'DESC')
                ->get();

                    $data = [
                        'title' => 'Performance',
                        'scripts' => ['AD_performance.js'],
                        'admin' => $adminSession,
                        'totalLearnerCount' => $totalLearnerCount,
                        'learnerStatusData' => $learnerStatusCount,
                        'learnersPerDay' => $learnersPerDay,
                        'learnersPerWeek' => $learnersPerWeek,
                        'learnersPerMonth' => $learnersPerMonth,
                        'hourlyCounts' => $hourlyCounts,
                        'dailyCounts' => $dailyCounts,
                        'weeklyCounts' => $weeklyCounts,
                        'monthlyCounts' => $monthlyCounts,
                    ];


                    // return view('adminPerformance.performance')
                    // ->with($data);

                    return response()->json($data);

                } catch (ValidationException $e) {
                    $errors = $e->validator->errors();
            
                    return response()->json(['errors' => $errors], 422);
                }
            }  else {
                return redirect('/admin');
            }
    }


    public function instructor_overview() {
        if (auth('admin')->check()) {
            $adminSession = session('admin');
                try {

                    $totalInstructorCount = DB::table('instructor')
                    ->count();

                    $instructorsPerDay = DB::table('instructor')
                    ->select(DB::raw('DATE(created_at) as day'), DB::raw('COUNT(*) as count'))
                    ->groupBy('day')
                    ->orderBy('day')
                    ->get();

                // Format the date in words
                $instructorsPerDay->transform(function ($item) {
                    $item->day = Carbon::parse($item->day)->format('F j, Y');
                    return $item;
                });

                $instructorStatusCount = DB::table('instructor')
                ->select(
                    'status'
                )
                ->get();


                $instructorsPerWeek = DB::table('instructor')
                ->select(DB::raw('CONCAT("Week ", WEEK(created_at), " of ", YEAR(created_at)) as week'), DB::raw('COUNT(*) as count'))
                ->groupBy('week')
                ->orderBy('week')
                ->get();

                $instructorsPerMonth = DB::table('instructor')
                ->select(DB::raw('DATE_FORMAT(created_at, "%M %Y") as month'), DB::raw('COUNT(*) as count'))
                ->groupBy('month')
                ->orderBy('month')
                ->get();


                // $hourlyCounts = DB::table('session_logs')
                // ->select(DB::raw("DATE_FORMAT(session_in, '%W, %M %e, %Y %l:00 %p') AS hour_start"), DB::raw('COUNT(*) as session_count'))
                // ->where('session_user_type', 'LEARNER')
                // ->groupBy(DB::raw("DATE(session_in)"), DB::raw("HOUR(session_in)"))
                // ->orderByRaw("DATE(session_in) DESC, HOUR(session_in) DESC")
                // ->get();
            
   $hourlyCounts = DB::table('session_logs')
                ->select(DB::raw("DATE_FORMAT(session_in, '%W, %M %e, %Y %l:00 %p') AS hour_start"), DB::raw('COUNT(*) as session_count'))
                ->where('session_user_type', 'INSTRUCTOR')
                ->groupBy('hour_start')
                ->orderBy('hour_start' , 'DESC')
                ->get();

                $dailyCounts = DB::table('session_logs')
                ->select(DB::raw("DATE_FORMAT(session_in, '%W, %M %e, %Y') AS day_start"), DB::raw('COUNT(*) as session_count'))
                ->where('session_user_type', 'INSTRUCTOR')
                ->groupBy('day_start')
                ->orderBy('day_start' ,  'DESC')
                ->get();


                $weeklyCounts = DB::table('session_logs')
                ->select(DB::raw("CONCAT('Week ', WEEK(session_in), ', ', YEAR(session_in)) AS week_start"), DB::raw('COUNT(*) as session_count'))
                ->where('session_user_type', 'INSTRUCTOR')
                ->groupBy('week_start')
                ->orderBy('week_start'  , 'DESC')
                ->get();

                $monthlyCounts = DB::table('session_logs')
                ->select(DB::raw("DATE_FORMAT(session_in, '%M %Y') AS month_start"), DB::raw('COUNT(*) as session_count'))
                ->where('session_user_type', 'INSTRUCTOR')
                ->groupBy('month_start')
                ->orderBy('month_start'  , 'DESC')
                ->get();

                    $data = [
                        'title' => 'Performance',
                        'scripts' => ['AD_performance.js'],
                        'admin' => $adminSession,
                        'totalInstructorCount' => $totalInstructorCount,
                        'instructorStatusData' => $instructorStatusCount,
                        'instructorsPerDay' => $instructorsPerDay,
                        'instructorsPerWeek' => $instructorsPerWeek,
                        'instructorsPerMonth' => $instructorsPerMonth,
                        'hourlyCounts' => $hourlyCounts,
                        'dailyCounts' => $dailyCounts,
                        'weeklyCounts' => $weeklyCounts,
                        'monthlyCounts' => $monthlyCounts,
                    ];


                    // return view('adminPerformance.performance')
                    // ->with($data);

                    return response()->json($data);

                } catch (ValidationException $e) {
                    $errors = $e->validator->errors();
            
                    return response()->json(['errors' => $errors], 422);
                }
            }  else {
                return redirect('/admin');
            }
    }



    public function course_overview(){
        if (auth('admin')->check()) {
            $adminSession = session('admin');
                try {

                    $totalCourseCount = DB::table('course')
                    ->count();

                    $coursePerDay = DB::table('course')
                    ->select(DB::raw('DATE(created_at) as day'), DB::raw('COUNT(*) as count'))
                    ->groupBy('day')
                    ->orderBy('day')
                    ->get();

                // Format the date in words
                $coursePerDay->transform(function ($item) {
                    $item->day = Carbon::parse($item->day)->format('F j, Y');
                    return $item;
                });

                $courseStatusCount = DB::table('course')
                ->select(
                    'course_status'
                )
                ->get();


                $coursePerWeek = DB::table('course')
                ->select(DB::raw('CONCAT("Week ", WEEK(created_at), " of ", YEAR(created_at)) as week'), DB::raw('COUNT(*) as count'))
                ->groupBy('week')
                ->orderBy('week')
                ->get();

                $coursePerMonth = DB::table('course')
                ->select(DB::raw('DATE_FORMAT(created_at, "%M %Y") as month'), DB::raw('COUNT(*) as count'))
                ->groupBy('month')
                ->orderBy('month')
                ->get();

                $learnerCourseCount = DB::table('learner_course')
                ->select('course.course_name', DB::raw('COUNT(*) as count'))
                ->join('course', 'course.course_id', 'learner_course.course_id')
                ->groupBy('course.course_name')
                ->get();

                // $hourlyCounts = DB::table('session_logs')
                // ->select(DB::raw("DATE_FORMAT(session_in, '%W, %M %e, %Y %l:00 %p') AS hour_start"), DB::raw('COUNT(*) as session_count'))
                // ->where('session_user_type', 'LEARNER')
                // ->groupBy(DB::raw("DATE(session_in)"), DB::raw("HOUR(session_in)"))
                // ->orderByRaw("DATE(session_in) DESC, HOUR(session_in) DESC")
                // ->get();
            
//    $hourlyCounts = DB::table('session_logs')
//                 ->select(DB::raw("DATE_FORMAT(session_in, '%W, %M %e, %Y %l:00 %p') AS hour_start"), DB::raw('COUNT(*) as session_count'))
//                 ->where('session_user_type', 'INSTRUCTOR')
//                 ->groupBy('hour_start')
//                 ->orderBy('hour_start' , 'DESC')
//                 ->get();

//                 $dailyCounts = DB::table('session_logs')
//                 ->select(DB::raw("DATE_FORMAT(session_in, '%W, %M %e, %Y') AS day_start"), DB::raw('COUNT(*) as session_count'))
//                 ->where('session_user_type', 'INSTRUCTOR')
//                 ->groupBy('day_start')
//                 ->orderBy('day_start' ,  'DESC')
//                 ->get();


//                 $weeklyCounts = DB::table('session_logs')
//                 ->select(DB::raw("CONCAT('Week ', WEEK(session_in), ', ', YEAR(session_in)) AS week_start"), DB::raw('COUNT(*) as session_count'))
//                 ->where('session_user_type', 'INSTRUCTOR')
//                 ->groupBy('week_start')
//                 ->orderBy('week_start'  , 'DESC')
//                 ->get();

//                 $monthlyCounts = DB::table('session_logs')
//                 ->select(DB::raw("DATE_FORMAT(session_in, '%M %Y') AS month_start"), DB::raw('COUNT(*) as session_count'))
//                 ->where('session_user_type', 'INSTRUCTOR')
//                 ->groupBy('month_start')
//                 ->orderBy('month_start'  , 'DESC')
//                 ->get();

                    $data = [
                        'title' => 'Performance',
                        'scripts' => ['AD_performance.js'],
                        'admin' => $adminSession,
                        'totalCourseCount' => $totalCourseCount,
                        'courseStatusData' => $courseStatusCount,
                        'coursePerDay' => $coursePerDay,
                        'coursePerWeek' => $coursePerWeek,
                        'coursePerMonth' => $coursePerMonth,
                        'learnerCourseCount' => $learnerCourseCount,
                        // 'hourlyCounts' => $hourlyCounts,
                        // 'dailyCounts' => $dailyCounts,
                        // 'weeklyCounts' => $weeklyCounts,
                        // 'monthlyCounts' => $monthlyCounts,
                    ];


                    // return view('adminPerformance.performance')
                    // ->with($data);

                    return response()->json($data);

                } catch (ValidationException $e) {
                    $errors = $e->validator->errors();
            
                    return response()->json(['errors' => $errors], 422);
                }
            }  else {
                return redirect('/admin');
            }        
    }
}
