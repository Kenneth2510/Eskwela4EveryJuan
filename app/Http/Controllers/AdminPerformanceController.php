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


    public function learners() {
        return $this->search_learner();
    }
    
    public function search_learner() {
        
        if (auth('admin')->check()) {
            $admin = session('admin');
            // dd($admin);
            $admin_codename = $admin['admin_codename'];
        } else {
            return redirect('/admin');
        }

        $search_by = request('searchBy');
        $search_val = request('searchVal');

        $filter_date = request('filterDate');
        $filter_status = request('filterStatus');



        try {
            $query = DB::table('learner')
                ->select(
                    'learner.learner_id',
                    'learner.learner_fname',
                    'learner.learner_lname',
                    'learner.learner_contactno',
                    'learner.learner_email',
                    'learner.created_at',
                    'business.business_name',
                    'learner.status'
                )
                ->join('business', 'business.learner_id', '=', 'learner.learner_id')
                ->orderBy('learner.created_at', 'DESC');
    
            if(!empty($filter_date) || !empty($filter_status)) {
                if(!empty($filter_date) && empty($filter_status)){
                    $query->where('learner.created_at', 'LIKE', $filter_date.'%');
                } elseif(empty($filter_date) && !empty($filter_status)){
                    $query->where('learner.status', 'LIKE', $filter_status);
                } else {
                    $query->where(function ($query) use ($filter_date, $filter_status) {
                        $query->where('learner.created_at', 'LIKE', $filter_date.'%')
                            ->where('learner.status', 'LIKE', $filter_status);
                    });
                }
            }

            if (!empty($search_by) && !empty($search_val)) {
                if ($search_by == 'name') {
                    $query->where(function ($query) use ($search_val) {
                        $query->where('learner.learner_fname', 'LIKE', $search_val . '%')
                            ->orWhere('learner.learner_lname', 'LIKE', $search_val . '%');
                    });
                } elseif ($search_by == 'learner_id') {
                    $query->where('learner.learner_id', 'LIKE', $search_val . '%');
                } else {
                    $query->where($search_by, 'LIKE', $search_val . '%');    
                }
            }

 
    
            $learners = $query->paginate(10);
    
            return view('adminPerformance.learners', compact('learners'))
            ->with(['title' => 'Performance', 
                'adminCodeName' => $admin_codename,
                'admin' => $admin,
                'scripts' => []]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }


    public function view_learner(Learner $learner) {
        if (auth('admin')->check()) {
            $adminSession = session('admin');
                try {


                    try {
                        $learnerData = DB::table('learner')
                        ->select(
                            DB::raw('CONCAT(learner_fname, " ", learner_lname) as name'),
                        )
                        ->where('learner_id', $learner->learner_id)
                        ->first();

                        $learnerCourseData = DB::table('learner_course_progress')
                        ->select(
                            'learner_course_progress.learner_course_progress_id',
                            'learner_course_progress.learner_course_id',
                            'learner_course_progress.course_id',
                            'learner_course_progress.course_progress',
                            'learner_course_progress.start_period',
                            'learner_course_progress.finish_period',
        
                            'course.course_id',
                            'course.course_name',
                            'course.course_code',
                            'course.instructor_id',
        
                            'instructor.instructor_fname',
                            'instructor.instructor_lname',
                        )
                        ->join('course', 'learner_course_progress.course_id', '=', 'course.course_id')
                        ->join('instructor', 'course.instructor_id', '=', 'instructor.instructor_id')
                        ->where('learner_course_progress.learner_id', $learner->learner_id)
                        ->get();
        
                        
                        $data = [
                            'title' => 'Performance',
                            'scripts' => ['AD_learnerPerformance.js'],
                            'courseData' => $learnerCourseData,
                            'admin' => $adminSession,
                            'learner' => $learnerData,
                        ];
                
                        // dd($data);
                        return view('adminPerformance.learnerPerformance')
                        ->with($data);
                    } catch (\Exception $e) {
                        dd($e->getMessage());
                    }

                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }  else {
                return redirect('/admin');
            }   
    }




    public function enrolledCoursesPerformances(Learner $learner) {
        if (auth('admin')->check()) {
            $adminSession = session('admin');
                try {
                $learnerCourseData = DB::table('learner_course_progress')
                ->select(
                    'learner_course_progress.learner_course_progress_id',
                    'learner_course_progress.learner_course_id',
                    'learner_course_progress.course_id',
                    'learner_course_progress.course_progress',
                    'learner_course_progress.start_period',
                    'learner_course_progress.finish_period',

                    'course.course_name',
                    'course.course_code',
                    'course.instructor_id',

                    'instructor.instructor_fname',
                    'instructor.instructor_lname',
                )
                ->join('course', 'learner_course_progress.course_id', '=', 'course.course_id')
                ->join('instructor', 'course.instructor_id', '=', 'instructor.instructor_id')
                ->where('learner_course_progress.learner_id', $learner->learner_id)
                ->get();

                $totalLearnerCourseCount = DB::table('learner_course_progress')
                ->where('learner_course_progress.learner_id', $learner->learner_id)
                ->count();

                $totalLearnerApprovedCourseCount = DB::table('learner_course')
                ->where('learner_course.learner_id', $learner->learner_id)
                ->where('learner_course.status', 'Approved')
                ->count();

                $totalLearnerPendingCourseCount = DB::table('learner_course')
                ->where('learner_course.learner_id', $learner->learner_id)
                ->where('learner_course.status', 'Pending')
                ->count();

                $totalLearnerRejectedCourseCount = DB::table('learner_course')
                ->where('learner_course.learner_id', $learner->learner_id)
                ->where('learner_course.status', 'Rejected')
                ->count();


                $totalCoursesLessonCount = 0;
                $totalCoursesActivityCount = 0;
                $totalCoursesQuizCount = 0;

                $totalCoursesLessonCompletedCount = 0;
                $totalCoursesActivityCompletedCount = 0;
                $totalCoursesQuizCompletedCount = 0;

                foreach ($learnerCourseData as $course) {

                    $totalCoursesLessonCount += DB::table('learner_syllabus_progress')
                    ->where('learner_id', $learner->learner_id)
                    ->where('learner_course_id', $course->learner_course_id)
                    ->where('course_id', $course->course_id)
                    ->where('category', 'LESSON')
                    ->count();

                    $totalCoursesActivityCount += DB::table('learner_syllabus_progress')
                    ->where('learner_id', $learner->learner_id)
                    ->where('learner_course_id', $course->learner_course_id)
                    ->where('course_id', $course->course_id)
                    ->where('category', 'ACTIVITY')
                    ->count();

                    $totalCoursesQuizCount += DB::table('learner_syllabus_progress')
                    ->where('learner_id', $learner->learner_id)
                    ->where('learner_course_id', $course->learner_course_id)
                    ->where('course_id', $course->course_id)
                    ->where('category', 'QUIZ')
                    ->count();


                    $totalCoursesLessonCompletedCount += DB::table('learner_syllabus_progress')
                    ->where('learner_id', $learner->learner_id)
                    ->where('learner_course_id', $course->learner_course_id)
                    ->where('course_id', $course->course_id)
                    ->where('category', 'LESSON')
                    ->where('status', 'COMPLETED')
                    ->count();

                    $totalCoursesActivityCompletedCount += DB::table('learner_syllabus_progress')
                    ->where('learner_id', $learner->learner_id)
                    ->where('learner_course_id', $course->learner_course_id)
                    ->where('course_id', $course->course_id)
                    ->where('category', 'ACTIVITY')
                    ->where('status', 'COMPLETED')
                    ->count();

                    $totalCoursesQuizCompletedCount += DB::table('learner_syllabus_progress')
                    ->where('learner_id', $learner->learner_id)
                    ->where('learner_course_id', $course->learner_course_id)
                    ->where('course_id', $course->course_id)
                    ->where('category', 'QUIZ')
                    ->where('status', 'COMPLETED')
                    ->count();
                }

                $data = [
                    'title' => 'Performance',
                    'learnerCourseData' => $learnerCourseData,
                    'totalLearnerCourseCount' => $totalLearnerCourseCount,
                    // 'totalLearnerCompletedCourseCount' => $totalLearnerCompletedCourseCount,
                    // 'totalLearnerInProgressCourseCount' => $totalLearnerInProgressCourseCount,
                    'totalLearnerApprovedCourseCount' => $totalLearnerApprovedCourseCount,
                    'totalLearnerPendingCourseCount' => $totalLearnerPendingCourseCount,
                    'totalLearnerRejectedCourseCount' => $totalLearnerRejectedCourseCount,
                    'totalCoursesLessonCount' => $totalCoursesLessonCount,
                    'totalCoursesActivityCount' => $totalCoursesActivityCount,
                    'totalCoursesQuizCount' => $totalCoursesQuizCount,
                    'totalCoursesLessonCompletedCount' => $totalCoursesLessonCompletedCount,
                    'totalCoursesActivityCompletedCount' => $totalCoursesActivityCompletedCount,
                    'totalCoursesQuizCompletedCount' => $totalCoursesQuizCompletedCount,
                ];
                
        
                return response()->json($data);
            } catch (ValidationException $e) {
                $errors = $e->validator->errors();

                return response()->json(['errors' => $errors], 422);
            }


        }  else {
            return redirect('/admin');
        }  
    }

    public function enrolledCoursesPerformancesData(Learner $learner, Request $request) {
        if (auth('admin')->check()) {
            $adminSession = session('admin');
                try {

                $selectedCourse = $request->input('selectedCourse');

                
                $totalLearnerCourseCount = DB::table('learner_course_progress')
                ->where('learner_course_progress.learner_id', $learner->learner_id)
                ->count();

                $totalLearnerCompletedCourseCount = DB::table('learner_course_progress')
                ->where('learner_course_progress.learner_id', $learner->learner_id)
                ->where('learner_course_progress.course_progress', 'COMPLETED')
                ->count();

                $totalLearnerInProgressCourseCount = DB::table('learner_course_progress')
                ->where('learner_course_progress.learner_id', $learner->learner_id)
                ->where('learner_course_progress.course_progress', 'IN PROGRESS')
                ->count();

                

                if($selectedCourse === "ALL") {
                    $courseData = DB::table('learner_syllabus_progress')
                    ->select(
                        'learner_syllabus_progress.learner_syllabus_progress_id',
                        'learner_syllabus_progress.learner_course_id',
                        'learner_syllabus_progress.syllabus_id',
                        'learner_syllabus_progress.course_id',
                        'learner_syllabus_progress.category',
                        'learner_syllabus_progress.status',
                        
                        'course.course_name',
                        'course.course_code',
                    )
                    ->join('course', 'learner_syllabus_progress.course_id', '=', 'course.course_id')
                    ->where('learner_syllabus_progress.learner_id', $learner->learner_id)
                    ->get();

                    $data['courseData'] = $courseData;
                } else {
                    $courseData = DB::table('learner_syllabus_progress')
                    ->select(
                        'learner_syllabus_progress.learner_syllabus_progress_id',
                        'learner_syllabus_progress.learner_course_id',
                        'learner_syllabus_progress.syllabus_id',
                        'learner_syllabus_progress.course_id',
                        'learner_syllabus_progress.category',
                        'learner_syllabus_progress.status',
                  
                        'course.course_name',
                        'course.course_code',
                        
                    )
                    ->join('course', 'learner_syllabus_progress.course_id', '=', 'course.course_id')
                    ->where('learner_syllabus_progress.learner_id', $learner->learner_id)
                    ->where('learner_syllabus_progress.course_id', $selectedCourse)
                    ->get();

                    $courseData_first = $courseData->first();

                    $learnerCourseProgressData = DB::table('learner_course_progress')
                    ->select(
                        'learner_course_progress_id',
                        'learner_course_id',
                        'course_progress',
                        'start_period',
                        'finish_period',
                    )
                    ->where('learner_course_id', $courseData_first->learner_course_id)
                    ->where('learner_id', $learner->learner_id)
                    ->where('course_id', $selectedCourse)
                    ->first();


                    $totalCourseSyllabusCount = DB::table('learner_syllabus_progress')
                    ->where('learner_course_id', $courseData_first->learner_course_id)
                    ->where('learner_id', $learner->learner_id)
                    ->where('course_id', $selectedCourse)
                    ->count();

                    $totalCourseLessonSyllabusCount = DB::table('learner_syllabus_progress')
                    ->where('learner_course_id', $courseData_first->learner_course_id)
                    ->where('learner_id', $learner->learner_id)
                    ->where('course_id', $selectedCourse)
                    ->where('category', 'LESSON')
                    ->count();

                    $totalCourseActivitySyllabusCount = DB::table('learner_syllabus_progress')
                    ->where('learner_course_id', $courseData_first->learner_course_id)
                    ->where('learner_id', $learner->learner_id)
                    ->where('course_id', $selectedCourse)
                    ->where('category', 'ACTIVITY')
                    ->count();

                    $totalCourseQuizSyllabusCount = DB::table('learner_syllabus_progress')
                    ->where('learner_course_id', $courseData_first->learner_course_id)
                    ->where('learner_id', $learner->learner_id)
                    ->where('course_id', $selectedCourse)
                    ->where('category', 'QUIZ')
                    ->count();

                    $totalCourseLessonCompletedSyllabusCount = DB::table('learner_syllabus_progress')
                    ->where('learner_course_id', $courseData_first->learner_course_id)
                    ->where('learner_id', $learner->learner_id)
                    ->where('course_id', $selectedCourse)
                    ->where('category', 'LESSON')
                    ->where('status', 'COMPLETED')
                    ->count();

                    $totalCourseActivityCompletedSyllabusCount = DB::table('learner_syllabus_progress')
                    ->where('learner_course_id', $courseData_first->learner_course_id)
                    ->where('learner_id', $learner->learner_id)
                    ->where('course_id', $selectedCourse)
                    ->where('category', 'ACTIVITY')
                    ->where('status', 'COMPLETED')
                    ->count();

                    $totalCourseQuizCompletedSyllabusCount = DB::table('learner_syllabus_progress')
                    ->where('learner_course_id', $courseData_first->learner_course_id)
                    ->where('learner_id', $learner->learner_id)
                    ->where('course_id', $selectedCourse)
                    ->where('category', 'QUIZ')
                    ->where('status', 'COMPLETED')
                    ->count();


                    $data['courseData'] = $courseData;
                    $data['learnerCourseProgressData'] = $learnerCourseProgressData;
                    $data['totalCourseSyllabusCount'] = $totalCourseSyllabusCount;
                    $data['totalCourseLessonSyllabusCount'] = $totalCourseLessonSyllabusCount;
                    $data['totalCourseActivitySyllabusCount'] = $totalCourseActivitySyllabusCount;
                    $data['totalCourseQuizSyllabusCount'] = $totalCourseQuizSyllabusCount;
                    $data['totalCourseLessonCompletedSyllabusCount'] = $totalCourseLessonCompletedSyllabusCount;
                    $data['totalCourseActivityCompletedSyllabusCount'] = $totalCourseActivityCompletedSyllabusCount;
                    $data['totalCourseQuizCompletedSyllabusCount'] = $totalCourseQuizCompletedSyllabusCount;

                }

                $data['title'] = 'Course Performance';
                $data['totalLearnerCourseCount'] = $totalLearnerCourseCount;
                $data['totalLearnerCompletedCourseCount'] = $totalLearnerCompletedCourseCount;
                $data['totalLearnerInProgressCourseCount'] = $totalLearnerInProgressCourseCount;

                return response()->json($data);
            } catch (ValidationException $e) {
                $errors = $e->validator->errors();

                return response()->json(['errors' => $errors], 422);
            }


        } else {
            return redirect('/admin');
        }
    }


    public function sessionData(Learner $learner) {
        if (auth('admin')->check()) {
            $adminSession = session('admin');
                try {

                $totalsPerDay = DB::table('session_logs')
                ->select(DB::raw('DATE(session_in) as date'), DB::raw('SUM(time_difference) as total_seconds'))
                ->where('session_user_id', $learner->learner_id)
                ->where('session_user_type', 'LEARNER')
                ->groupBy(DB::raw('DATE(session_in)'))
                ->get();

                $data = [
                    'title' => 'Performance',
                    'totalsPerDay' => $totalsPerDay,
                ];
                
        
                return response()->json($data);
            } catch (ValidationException $e) {
                $errors = $e->validator->errors();

                return response()->json(['errors' => $errors], 422);
            }


        } else {
            return redirect('/admin');
        }
    }


    public function grades($course, $learner_course) {
        if (auth('admin')->check()) {
            $adminSession = session('admin');
            try {

                $courseData = DB::table('learner_course_progress')
                ->select(
                    'learner_course_progress.learner_course_progress_id',
                    'learner_course_progress.course_progress',
                    'learner_course_progress.course_id',
                    'learner_course_progress.grade',
                    'learner_course_progress.remarks',
                    'learner_course_progress.start_period',
                    'learner_course_progress.finish_period',
                    
                    'course.course_name',
                    'course.course_code',
                )
                ->join('course', 'course.course_id', '=', 'learner_course_progress.course_id')
                ->where('learner_course_progress.course_id', $course)
                ->where('learner_course_progress.learner_course_id', $learner_course)
                ->first();

                $learnerLessonsData = DB::table('learner_lesson_progress')
                ->select(
                    'learner_lesson_progress.learner_lesson_progress_id',
                    'learner_lesson_progress.lesson_id',
                    'learner_lesson_progress.start_period',
                    'learner_lesson_progress.finish_period',

                    'lessons.lesson_title',
                )
                ->join('lessons', 'lessons.lesson_id', '=', 'learner_lesson_progress.lesson_id')
                ->where('learner_lesson_progress.learner_course_id', $learner_course)
                ->where('learner_lesson_progress.course_id', $course)
                ->get();

                $learnerActivityScoresData = DB::table('learner_activity_output')
                ->select(
                    'learner_activity_output.activity_id',
                    'learner_activity_output.activity_content_id',
                    'activities.activity_title',
                    DB::raw('COALESCE(ROUND(AVG(attempts.total_score), 2), 0) as average_score')
                )
                ->leftJoin('activities', 'activities.activity_id', '=', 'learner_activity_output.activity_id')
                ->leftJoin(
                    DB::raw('(SELECT learner_activity_output_id, AVG(total_score) as total_score FROM learner_activity_output GROUP BY learner_activity_output_id) as attempts'),
                    'attempts.learner_activity_output_id',
                    '=',
                    'learner_activity_output.learner_activity_output_id'
                )
                ->where('learner_activity_output.course_id', $course)
                ->where('learner_activity_output.learner_course_id', $learner_course)
                ->groupBy('learner_activity_output.activity_id', 'learner_activity_output.activity_content_id', 'activities.activity_title')
                ->get();
            
                $activityLearnerSumScore = 0;
                $activityTotalSum = 0;
    
                $activitiesTotalScore = DB::table('activities')
                ->select(
                    'activities.activity_id',
                    'activities.syllabus_id',
                    'activity_content.total_score',
                ) 
                ->join('activity_content', 'activities.activity_id', '=', 'activity_content.activity_id')
                ->where('activities.course_id', $course)
                ->get();
    
                foreach ($activitiesTotalScore as $activityMain) {
                    $activityTotalSum += $activityMain->total_score;
                }
    
                foreach ($learnerActivityScoresData as $activity) {
                    $activityLearnerSumScore += $activity->average_score;
                }
    
                $learnerQuizScoresData = DB::table('learner_quiz_progress')
                ->select(
                    'learner_quiz_progress.quiz_id',
                    'quizzes.quiz_title',
                    DB::raw('COALESCE(ROUND(AVG(learner_quiz_progress.score), 2), 0) as average_score')
                )
                ->leftJoin('quizzes', 'quizzes.quiz_id', '=', 'learner_quiz_progress.quiz_id')
                ->where('learner_quiz_progress.course_id', $course)
                ->where('learner_quiz_progress.learner_course_id', $learner_course)
                ->groupBy('learner_quiz_progress.quiz_id', 'quizzes.quiz_title')
                ->get();
            
    
                    $quizTotalScore = DB::table('quiz_content')
                    ->where('quiz_content.course_id', $course)
                    ->count();
        
    
                    $quizLearnerSumScore = 0;
                    $quizTotalSum = $quizTotalScore;
        
                    foreach ($learnerQuizScoresData as $quiz) {
                        $quizLearnerSumScore += $quiz->average_score;
                    }
    
    
                $learnerPostAssessmentScoresData = DB::table('learner_post_assessment_progress')
                ->select (
                        DB::raw('COALESCE(ROUND(AVG(IFNULL(learner_post_assessment_progress.score, 0)), 2), 0) as average_score')
                    )
                    ->where('course_id', $course)
                    ->where('learner_course_id', $learner_course)
                    ->get();
    
                $totalScoreCount_post_assessment = DB::table('learner_post_assessment_output')
                ->where('course_id', $course)
                ->where('learner_course_id', $learner_course)
                ->where('attempt', 1)
                ->count();
    
    
                $postAssessmentLearnerSumScore = 0;
    
    
                foreach ($learnerPostAssessmentScoresData as $post_assessment) {
                    $postAssessmentLearnerSumScore += $post_assessment->average_score;
                }
            
            $learnerPreAssessmentGrade = DB::table('learner_pre_assessment_progress')
            ->select(
                'score',
                'start_period',
                'finish_period'
            )
            ->where('course_id', $course)
            ->where('learner_course_id', $learner_course)
            ->first();

            $learnerPreAssessmentScoresData = DB::table('learner_pre_assessment_progress')
            ->select(
                'score'
            )
            ->where('course_id', $course)
            ->where('learner_course_id', $learner_course)
            ->get();

            $totalScoreCount_pre_assessment = DB::table('learner_pre_assessment_output')
            ->where('course_id', $course)
            ->where('learner_course_id', $learner_course)
            ->count();

            $preAssessmentLearnerSumScore = 0;


            foreach ($learnerPreAssessmentScoresData as $pre_assessment) {
                $preAssessmentLearnerSumScore += $pre_assessment->score;
            }


            $learnerPostAssessmentGrade = DB::table('learner_post_assessment_progress')
            ->select (
                    DB::raw('COALESCE(ROUND(AVG(IFNULL(learner_post_assessment_progress.score, 0)), 2), 0) as average_score')
                )
                ->where('course_id', $course)
                ->where('learner_course_id', $learner_course)
                ->first();

            $learnerPostAssessmentData = DB::table('learner_post_assessment_progress') 
            ->select(
                'start_period',
                'finish_period'
            )
            ->where('course_id', $course)
            ->where('learner_course_id', $learner_course)
            ->orderBy('attempt', 'DESC')
            ->first();

            $courseGrading = DB::table('course_grading')
            ->select(
                'activity_percent',
                'quiz_percent',
                'pre_assessment_percent',
                'post_assessment_percent',
            )
            ->where('course_id', $course)
            ->first();

                      // compute now the grades
                      $activityGrade = 0;
                      $quizGrade = 0;
                      $postAssessmentGrade = 0;
                      $preAssessmentGrade = 0;
                      $totalGrade = 0;
          
                      // activity
                      $activityGrade = (($activityLearnerSumScore / $activityTotalSum) * 100) * $courseGrading->activity_percent;
                      $quizGrade = (($quizLearnerSumScore / $quizTotalSum) * 100) * $courseGrading->quiz_percent;
                      $postAssessmentGrade = (($postAssessmentLearnerSumScore / $totalScoreCount_post_assessment) * 100) * $courseGrading->pre_assessment_percent;
                      $preAssessmentGrade = (($preAssessmentLearnerSumScore / $totalScoreCount_pre_assessment) * 100) * $courseGrading->post_assessment_percent;
          
          
                      $totalGrade = $activityGrade + $quizGrade + $postAssessmentGrade;
                      $totalGrade = round($totalGrade, 2);
                       
                      if ($totalGrade >= 90) {
                          $remarks = 'Excellent';
                      } elseif ($totalGrade >= 80) {
                          $remarks = 'Very Good';
                      } elseif ($totalGrade >= 70) {
                          $remarks = 'Good';
                      } elseif ($totalGrade > 50) {
                          $remarks = 'Satisfactory';
                      } else {
                          $remarks = 'Needs Improvement';
                      }

                $data = [
                    'title' => 'Course Gradesheet',
                    'scripts' => ['/learner_post_assessment.js'],
                    'mainBackgroundCol' => '#00693e',
                    'courseData' => $courseData,
                    'activityScoresData' => $learnerActivityScoresData,
                    'quizScoresData' => $learnerQuizScoresData,
                    'preAssessmentData' => $learnerPreAssessmentGrade,
                    'postAssessmentGrade' => $learnerPostAssessmentGrade,
                    'postAssessmentData' => $learnerPostAssessmentData,

                    'learnerLessonsData' => $learnerLessonsData,

                    'activityLearnerSumScore' => $activityLearnerSumScore,
                    'activityTotalSum' => $activityTotalSum,
                    'activityGrade' => $activityGrade,

                    'quizLearnerSumScore' => $quizLearnerSumScore,
                    'quizTotalSum' => $quizTotalSum,
                    'quizGrade' => $quizGrade,

                    'postAssessmentLearnerSumScore' => $postAssessmentLearnerSumScore,
                    'totalScoreCount_post_assessment' => $totalScoreCount_post_assessment,
                    'postAssessmentScoreGrade' => $postAssessmentGrade,

                    'preAssessmentGradeData' => $preAssessmentGrade,
                    'preAssessmentLearnerSumScore' => $preAssessmentLearnerSumScore,
                    'totalScoreCount_pre_assessment' => $totalScoreCount_pre_assessment,

                    'totalGrade' => $totalGrade,
                    'remarks' => $remarks,
                ];

                // dd($data);
                // return view('learner_course.courseGrades', compact('learner'))
                // ->with($data);
                return $data;

            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        } else {
            return redirect('/admin');
        }
    }


    public function coursePerformance(Learner $learner, Course $course) {
        if (auth('admin')->check()) {
            $adminSession = session('admin');
                try {

                $learnerCourseData = DB::table('learner_course_progress')
                ->select(
                    'learner_course_progress.learner_course_progress_id',
                    'learner_course_progress.learner_course_id',
                    'learner_course_progress.learner_id',
                    'learner_course_progress.course_id',
                    'learner_course_progress.course_progress',
                    'learner_course_progress.start_period',
                    'learner_course_progress.finish_period',

                    'course.course_id',
                    'course.course_name',
                    'course.course_code',
                    'course.instructor_id',

                    'instructor.instructor_fname',
                    'instructor.instructor_lname',
                )
                ->join('course', 'learner_course_progress.course_id', '=', 'course.course_id')
                ->join('instructor', 'course.instructor_id', '=', 'instructor.instructor_id')
                ->where('learner_course_progress.learner_id', $learner->learner_id)
                ->where('learner_course_progress.course_id', $course->course_id)
                ->first();

                $learnerSyllabusData = DB::table('learner_syllabus_progress')
                ->select(
                    'learner_syllabus_progress.learner_syllabus_progress_id',
                    'learner_syllabus_progress.learner_course_id',
                    'learner_syllabus_progress.syllabus_id',
                    'learner_syllabus_progress.category',
                    'learner_syllabus_progress.status',

                    'syllabus.topic_id',
                    'syllabus.topic_title',
                )
                ->join('syllabus', 'learner_syllabus_progress.syllabus_id', '=', 'syllabus.syllabus_id')
                ->where('learner_syllabus_progress.learner_course_id', $learnerCourseData->learner_course_id)
                ->where('learner_syllabus_progress.learner_id', $learner->learner_id)
                ->where('learner_syllabus_progress.course_id', $course->course_id)
                ->get();

                $learnerPreAssessmentGrade = DB::table('learner_pre_assessment_progress')
                ->select(
                    'score'
                )
                ->where('course_id', $course->course_id)
                ->where('learner_course_id', $learnerCourseData->learner_course_id)
                ->first();
    
                $learnerPostAssessmentGrade = DB::table('learner_post_assessment_progress')
                ->select (
                        DB::raw('COALESCE(ROUND(AVG(IFNULL(learner_post_assessment_progress.score, 0)), 2), 0) as average_score')
                    )
                    ->where('course_id', $course->course_id)
                    ->where('learner_course_id', $learnerCourseData->learner_course_id)
                    ->first();


                    $gradeData = DB::table('learner_course')
                    ->select(
                        'learner_course.learner_course_id',
                        'learner_course.learner_id',
                        'learner_course.created_at',
                        'learner_course_progress.course_progress',
                        'learner_course_progress.start_period',
                        'learner_course_progress.finish_period',
                        'learner_course_progress.grade',
                        'learner_course_progress.remarks',
                        'learner.learner_fname',
                        'learner.learner_lname',
                    )
                    ->join('learner_course_progress', 'learner_course_progress.learner_course_id', '=', 'learner_course.learner_course_id')
                    ->join('learner', 'learner.learner_id', '=', 'learner_course.learner_id')
                    ->where('learner_course.course_id', $course->course_id)
                    ->where('learner_course.learner_id', $learner->learner_id);
                
                    $gradeWithActivityData = $gradeData->get();
                    
                    foreach ($gradeWithActivityData as $activityData) {
                        $activityData->activities = DB::table('learner_activity_output')
                            ->select(
                                'learner_activity_output.activity_id',
                                'learner_activity_output.activity_content_id',
                                'activities.activity_title',
                                DB::raw('COALESCE(ROUND(AVG(IFNULL(attempts.total_score, 0)), 2), 0) as average_score')
                            )
                            ->leftJoin('activities', 'activities.activity_id', '=', 'learner_activity_output.activity_id')
                            ->leftJoin(
                                DB::raw('(SELECT learner_activity_output_id, AVG(total_score) as total_score FROM learner_activity_output GROUP BY learner_activity_output_id) as attempts'),
                                'attempts.learner_activity_output_id',
                                '=',
                                'learner_activity_output.learner_activity_output_id'
                            )
                            ->where('learner_activity_output.course_id', $course->course_id)
                            ->where('learner_activity_output.learner_course_id', $activityData->learner_course_id)
                            ->groupBy('learner_activity_output.activity_id', 'learner_activity_output.activity_content_id', 'activities.activity_title')
                            ->get();
                    }
                    
                    $gradeWithQuizData = $gradeWithActivityData;
                    
                    foreach ($gradeWithQuizData as $quizData) {
                        $quizData->quizzes = DB::table('learner_quiz_progress')
                            ->select(
                                'learner_quiz_progress.quiz_id',
                                'quizzes.quiz_title',
                                DB::raw('COALESCE(ROUND(AVG(IFNULL(learner_quiz_progress.score, 0)), 2), 0) as average_score')
                            )
                            ->leftJoin('quizzes', 'quizzes.quiz_id', '=', 'learner_quiz_progress.quiz_id')
                            ->where('learner_quiz_progress.course_id', $course->course_id)
                            ->where('learner_quiz_progress.learner_course_id', $quizData->learner_course_id)
                            ->groupBy('learner_quiz_progress.quiz_id', 'quizzes.quiz_title')
                            ->get();
                    }

                    
                $activitySyllabusData = DB::table('activities')
                ->select(
                    'activities.activity_id',
                    'activities.course_id',
                    'activities.syllabus_id',
                    'activities.topic_id',
                    'activities.activity_title',
                    'activity_content.total_score',
                )
                ->join('activity_content', 'activities.activity_id', 'activity_content.activity_id')
                ->where('activities.course_id', $course->course_id)
                ->orderBy('activities.topic_id',  'asc')
                ->get();

                $quizSyllabusData = DB::table('quizzes')
                ->select(
                    'quizzes.quiz_id',
                    'quizzes.course_id',
                    'quizzes.syllabus_id',
                    'quizzes.topic_id',
                    'quizzes.quiz_title',
                    DB::raw('COUNT(quiz_content.question_id) AS total_score')
                )
                ->join('quiz_content', 'quizzes.quiz_id', 'quiz_content.quiz_id')
                ->where('quizzes.course_id', $course->course_id)
                ->groupBy('quizzes.quiz_id')
                ->orderBy('quizzes.topic_id', 'asc')
                ->get();
            
                
                    $gradeComputation = $this->grades($course->course_id, $learnerCourseData->learner_course_id);

                    $learnerPreAssessmentData = DB::table('learner_pre_assessment_progress')
                    ->select(
                        'learner_pre_assessment_progress.learner_pre_assessment_progress_id',
                        'learner_pre_assessment_progress.status',
                        'learner_pre_assessment_progress.start_period',
                        'learner_pre_assessment_progress.finish_period',
                        'learner_pre_assessment_progress.score',
                        'learner_pre_assessment_progress.remarks',
                    )
                    ->join('learner_pre_assessment_output', 'learner_pre_assessment_progress.learner_course_id', 'learner_pre_assessment_output.learner_course_id')
                    ->where('learner_pre_assessment_progress.course_id', $course->course_id)
                    ->where('learner_pre_assessment_progress.learner_id', $learner->learner_id)
                    ->first();
                
                $learnerPostAssessmentData = DB::table('learner_post_assessment_progress')
                    ->select(
                        'learner_post_assessment_progress.learner_post_assessment_progress_id',
                        'learner_post_assessment_progress.status',
                        'learner_post_assessment_progress.start_period',
                        'learner_post_assessment_progress.finish_period',
                        'learner_post_assessment_progress.score',
                        'learner_post_assessment_progress.remarks',
                        'learner_post_assessment_progress.attempt',
                    )
                    ->where('learner_post_assessment_progress.course_id', $course->course_id)
                    ->where('learner_post_assessment_progress.learner_id', $learner->learner_id)
                    ->get();
                
                
                $data = [
                    'title' => 'Course Performance',
                    'scripts' => ['AD_learnerCoursePerformance.js'],
                    'learnerCourseData' => $learnerCourseData,
                    'learner' =>$learner,
                    'learnerSyllabusData' => $learnerSyllabusData,
                    'admin' => $adminSession,
                    'gradesheet' => $gradeWithQuizData,
                    'learnerPreAssessmentGrade' => $learnerPreAssessmentGrade,
                    'learnerPostAssessmentGrade' => $learnerPostAssessmentGrade,
                    'gradeComputation' => $gradeComputation,
                    'activitySyllabus' => $activitySyllabusData,
                    'quizSyllabus' => $quizSyllabusData,
                    'learnerPreAssessmentData' => $learnerPreAssessmentData,
                    'learnerPostAssessmentData' => $learnerPostAssessmentData,
                ];
        
          
                // dd($data);
                return view('adminPerformance.learnerCoursePerformance' , compact('learner'))
                ->with($data);
            } catch (\Exception $e) {
                dd($e->getMessage());
            }

        } else {
            return redirect('/admin');
        }
    }


    public function view_output_post_assessment(Course $course, LearnerCourse $learner_course, $attempt) {
        if (auth('admin')->check()) {
            $adminSession = session('admin');
            try {

           
                $courseData = DB::table('learner_course')
                ->select(
                    'learner_course.learner_course_id',
                    'learner_course.learner_id',
                    'course.course_id',
                    'course.course_name',
                    'course.course_code',
                    'course.instructor_id',
                    'instructor.instructor_fname',
                    'instructor.instructor_lname',
                    'learner.learner_fname',
                    'learner.learner_lname',
                )
                ->join('course', 'learner_course.course_id', 'course.course_id')
                ->join('learner', 'learner_course.learner_id', 'learner.learner_id')
                ->join('instructor', 'course.instructor_id', 'instructor.instructor_id')
                ->where('learner_course.course_id', $course->course_id)
                ->first();

                $postAssessmentData = DB::table('learner_post_assessment_progress')
                ->select(
                    'learner_post_assessment_progress_id',
                    'status',
                    'max_duration',
                    'score',
                    'remarks',
                    'attempt',
                    'start_period',
                    'finish_period',
                )
                ->where('learner_course_id', $learner_course->learner_course_id)
                ->where('course_id', $course->course_id)
                ->where('attempt', $attempt)
                ->first();


                    $now = Carbon::now();
                    $timestampString = $now->toDateTimeString();

        
                        $postAssessmentOutputData = DB::table('learner_post_assessment_output')
                        ->select(
                            'learner_post_assessment_output.learner_post_assessment_output_id',
                            'learner_post_assessment_output.learner_course_id',
                            'learner_post_assessment_output.course_id',
                            'learner_post_assessment_output.attempt',
                            'learner_post_assessment_output.question_id',
                            'learner_post_assessment_output.syllabus_id',
                            'learner_post_assessment_output.answer',
                            'learner_post_assessment_output.isCorrect',
                            'questions.question',
                            'questions.category',
                            DB::raw('JSON_ARRAYAGG(question_answer.answer) as answers')
                        )
                        ->join('questions', 'learner_post_assessment_output.question_id', '=', 'questions.question_id')
                        ->leftJoin('question_answer', 'questions.question_id', '=', 'question_answer.question_id')
                        ->where('learner_post_assessment_output.course_id', $courseData->course_id)
                        ->where('learner_post_assessment_output.learner_course_id', $courseData->learner_course_id)
                        ->where('attempt', $attempt)
                        ->groupBy(
                            'learner_post_assessment_output.learner_post_assessment_output_id',
                            'learner_post_assessment_output.learner_course_id',
                            'learner_post_assessment_output.course_id',
                            'learner_post_assessment_output.question_id',
                            'learner_post_assessment_output.syllabus_id',
                            'questions.question',
                            'questions.category',
                            'questions.question_id'
                        )
                        ->get();

                    

                $data = [
                    'title' => 'Course Post Assessment',
                    'scripts' => ['/learner_post_assessment_output.js'],
                    'mainBackgroundCol' => '#00693e',
                    'darkenedColor' => '#00693e',
                    'admin' => $adminSession,
                    'learnerCourseData' => $courseData,
                    'postAssessmentData' => $postAssessmentData,
                    'postAssessmentOutputData' => $postAssessmentOutputData,
                    'courseData' => $courseData
                ];

                // dd($data);

                return view('adminPerformance.learner_post_assessment_output')
                ->with($data);

            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        } else {
            return redirect('/admin');
        }
    }

    public function view_output_post_assessment_json(Course $course, LearnerCourse $learner_course, $attempt) {
        if (auth('admin')->check()) {
            $adminSession = session('admin');
            try {

           
                $courseData = DB::table('learner_course')
                ->select(
                    'learner_course.learner_course_id',
                    'learner_course.learner_id',
                    'course.course_id',
                    'course.course_name',
                    'course.course_code',
                    'course.instructor_id',
                    'instructor.instructor_fname',
                    'instructor.instructor_lname',
                )
                ->join('course', 'learner_course.course_id', 'course.course_id')
                ->join('instructor', 'course.instructor_id', 'instructor.instructor_id')
                ->where('learner_course.course_id', $course->course_id)
                ->first();

                $postAssessmentData = DB::table('learner_post_assessment_progress')
                ->select(
                    'learner_post_assessment_progress_id',
                    'status',
                    'max_duration',
                    'score',
                    'remarks',
                    'attempt',
                    'start_period',
                    'finish_period',
                )
                ->where('learner_course_id', $learner_course->learner_course_id)
                ->where('course_id', $course->course_id)
                ->where('attempt', $attempt)
                ->first();


                    $now = Carbon::now();
                    $timestampString = $now->toDateTimeString();

                    $correctAnswerSubquery = DB::table('question_answer')
                    ->select('question_id', DB::raw('JSON_ARRAYAGG(answer) as correct_answer'))
                    ->where('isCorrect', 1)
                    ->groupBy('question_id');
        
                    $postAssessmentOutputData = DB::table('learner_post_assessment_output')
                    ->select(
                        'learner_post_assessment_output.learner_post_assessment_output_id',
                        'learner_post_assessment_output.learner_course_id',
                        'learner_post_assessment_output.course_id',
                        'learner_post_assessment_output.question_id',
                        'learner_post_assessment_output.syllabus_id',
                        'learner_post_assessment_output.attempt',
                        'learner_post_assessment_output.answer',
                        'learner_post_assessment_output.isCorrect',
                        'questions.question',
                        'questions.category',
                        DB::raw('JSON_ARRAYAGG(question_answer.answer) as all_choices'),
                        DB::raw('correct_answers.correct_answer')
                    )
                    ->join('questions', 'learner_post_assessment_output.question_id', '=', 'questions.question_id')
                    ->leftJoinSub($correctAnswerSubquery, 'correct_answers', function ($join) {
                        $join->on('questions.question_id', '=', 'correct_answers.question_id');
                    })
                    ->leftJoin('question_answer', 'questions.question_id', '=', 'question_answer.question_id')
                    ->where('learner_post_assessment_output.course_id', $courseData->course_id)
                    ->where('learner_post_assessment_output.learner_course_id', $courseData->learner_course_id)
                    ->where('attempt', $attempt)
                    ->groupBy(
                        'learner_post_assessment_output.learner_post_assessment_output_id',
                        'learner_post_assessment_output.learner_course_id',
                        'learner_post_assessment_output.course_id',
                        'learner_post_assessment_output.question_id',
                        'learner_post_assessment_output.syllabus_id',
                        'questions.question',
                        'questions.category',
                        'correct_answers.correct_answer'
                    )
                    ->get();


                    

                $data = [
                    'title' => 'Course Pre Assessment',
                    'scripts' => ['/learner_pre_assessment_output.js'],
                    'mainBackgroundCol' => '#00693e',
                    'darkenedColor' => '#00693e',
                    'learnerCourseData' => $courseData,
                    'postAssessmentData' => $postAssessmentData,
                    'postAssessmentOutputData' => $postAssessmentOutputData,
                ];

                // // dd($data);

                // return view('learner_course.coursePreAssessmentOutput', compact('learner'))
                // ->with($data);
                return response()->json($data);
    

            } catch (ValidationException $e) {
                $errors = $e->validator->errors();
            
                return response()->json(['errors' => $errors], 422);
            }
        } else {
            return redirect('/admin');
        }
    }



    public function view_output_pre_assessment(Course $course, LearnerCourse $learner_course) {
        if (auth('admin')->check()) {
            $adminSession = session('admin');
            try {

           
                $courseData = DB::table('learner_course')
                ->select(
                    'learner_course.learner_course_id',
                    'learner_course.learner_id',
                    'course.course_id',
                    'course.course_name',
                    'course.course_code',
                    'course.instructor_id',
                    'instructor.instructor_fname',
                    'instructor.instructor_lname',
                    'learner.learner_fname',
                    'learner.learner_lname',
                )
                ->join('course', 'learner_course.course_id', 'course.course_id')
                ->join('learner', 'learner_course.learner_id', 'learner.learner_id')
                ->join('instructor', 'course.instructor_id', 'instructor.instructor_id')
                ->where('learner_course.course_id', $course->course_id)
                ->first();


                $preAssessmentData = DB::table('learner_pre_assessment_progress')
                ->select(
                    'learner_pre_assessment_progress_id',
                    'status',
                    'max_duration',
                    'score',
                    'remarks',
                    'start_period',
                    'finish_period',
                )
                ->where('learner_course_id', $learner_course->learner_course_id)
                ->where('course_id', $course->course_id)
                ->first();


                    $now = Carbon::now();
                    $timestampString = $now->toDateTimeString();

        
                        $preAssessmentOutputData = DB::table('learner_pre_assessment_output')
                        ->select(
                            'learner_pre_assessment_output.learner_pre_assessment_output_id',
                            'learner_pre_assessment_output.learner_course_id',
                            'learner_pre_assessment_output.course_id',
                            'learner_pre_assessment_output.question_id',
                            'learner_pre_assessment_output.syllabus_id',
                            'learner_pre_assessment_output.answer',
                            'learner_pre_assessment_output.isCorrect',
                            'questions.question',
                            'questions.category',
                            DB::raw('JSON_ARRAYAGG(question_answer.answer) as answers')
                        )
                        ->join('questions', 'learner_pre_assessment_output.question_id', '=', 'questions.question_id')
                        ->leftJoin('question_answer', 'questions.question_id', '=', 'question_answer.question_id')
                        ->where('learner_pre_assessment_output.course_id', $courseData->course_id)
                        ->where('learner_pre_assessment_output.learner_course_id', $courseData->learner_course_id)
                        ->groupBy(
                            'learner_pre_assessment_output.learner_pre_assessment_output_id',
                            'learner_pre_assessment_output.learner_course_id',
                            'learner_pre_assessment_output.course_id',
                            'learner_pre_assessment_output.question_id',
                            'learner_pre_assessment_output.syllabus_id',
                            'questions.question',
                            'questions.category',
                            'questions.question_id'
                        )
                        ->get();

                    

                $data = [
                    'title' => 'Course Pre Assessment',
                    'scripts' => ['/learner_pre_assessment_output.js'],
                    'mainBackgroundCol' => '#00693e',
                    'darkenedColor' => '#00693e',
                    'learnerCourseData' => $courseData,
                    'preAssessmentData' => $preAssessmentData,
                    'admin' => $adminSession,
                    'preAssessmentOutputData' => $preAssessmentOutputData,
                    'courseData' => $courseData,
                ];

                // dd($data);

                return view('adminPerformance.learner_pre_assessment_output')
                ->with($data);

            } catch (\Exception $e) {
                dd($e->getMessage());
            }
        } else {
            return redirect('/admin');
        }
    }

    public function view_output_pre_assessment_json(Course $course, LearnerCourse $learner_course) {
        if (auth('admin')->check()) {
            $adminSession = session('admin');
            try {

           
                $courseData = DB::table('learner_course')
                ->select(
                    'learner_course.learner_course_id',
                    'learner_course.learner_id',
                    'course.course_id',
                    'course.course_name',
                    'course.course_code',
                    'course.instructor_id',
                    'instructor.instructor_fname',
                    'instructor.instructor_lname',
                )
                ->join('course', 'learner_course.course_id', 'course.course_id')
                ->join('instructor', 'course.instructor_id', 'instructor.instructor_id')
                ->where('learner_course.course_id', $course->course_id)
                ->first();

                $preAssessmentData = DB::table('learner_pre_assessment_progress')
                ->select(
                    'learner_pre_assessment_progress_id',
                    'status',
                    'max_duration',
                    'score',
                    'remarks',
                    'start_period',
                    'finish_period',
                )
                ->where('learner_course_id', $learner_course->learner_course_id)
                ->where('course_id', $course->course_id)
                ->first();


                    $now = Carbon::now();
                    $timestampString = $now->toDateTimeString();

                    $correctAnswerSubquery = DB::table('question_answer')
                    ->select('question_id', DB::raw('JSON_ARRAYAGG(answer) as correct_answer'))
                    ->where('isCorrect', 1)
                    ->groupBy('question_id');
        
                    $preAssessmentOutputData = DB::table('learner_pre_assessment_output')
                    ->select(
                        'learner_pre_assessment_output.learner_pre_assessment_output_id',
                        'learner_pre_assessment_output.learner_course_id',
                        'learner_pre_assessment_output.course_id',
                        'learner_pre_assessment_output.question_id',
                        'learner_pre_assessment_output.syllabus_id',
                        'learner_pre_assessment_output.answer',
                        'learner_pre_assessment_output.isCorrect',
                        'questions.question',
                        'questions.category',
                        DB::raw('JSON_ARRAYAGG(question_answer.answer) as all_choices'),
                        DB::raw('correct_answers.correct_answer')
                    )
                    ->join('questions', 'learner_pre_assessment_output.question_id', '=', 'questions.question_id')
                    ->leftJoinSub($correctAnswerSubquery, 'correct_answers', function ($join) {
                        $join->on('questions.question_id', '=', 'correct_answers.question_id');
                    })
                    ->leftJoin('question_answer', 'questions.question_id', '=', 'question_answer.question_id')
                    ->where('learner_pre_assessment_output.course_id', $courseData->course_id)
                    ->where('learner_pre_assessment_output.learner_course_id', $courseData->learner_course_id)
                    ->groupBy(
                        'learner_pre_assessment_output.learner_pre_assessment_output_id',
                        'learner_pre_assessment_output.learner_course_id',
                        'learner_pre_assessment_output.course_id',
                        'learner_pre_assessment_output.question_id',
                        'learner_pre_assessment_output.syllabus_id',
                        'questions.question',
                        'questions.category',
                        'correct_answers.correct_answer'
                    )
                    ->get();


                    

                $data = [
                    'title' => 'Course Pre Assessment',
                    'scripts' => ['/learner_pre_assessment_output.js'],
                    'mainBackgroundCol' => '#00693e',
                    'darkenedColor' => '#00693e',
                    'learnerCourseData' => $courseData,
                    'preAssessmentData' => $preAssessmentData,
                    'preAssessmentOutputData' => $preAssessmentOutputData,
                ];

                // // dd($data);

                // return view('learner_course.coursePreAssessmentOutput', compact('learner'))
                // ->with($data);
                return response()->json($data);
    

            } catch (ValidationException $e) {
                $errors = $e->validator->errors();
            
                return response()->json(['errors' => $errors], 422);
            }
        } else {
            return redirect('/admin');
        }
    }


    public function coursePerformanceData(Learner $learner, Course $course) {
        if (auth('admin')->check()) {
            $adminSession = session('admin');
                try {

                $learnercourse = DB::table('learner_course')
                ->select(
                    'learner_course_id',
                    'learner_id',
                    'course_id',
                )
                ->where('learner_id', $learner->learner_id)
                ->where('course_id', $course->course_id)
                ->first();

                $learnerCourseData = DB::table('learner_syllabus_progress')
                ->select(
                    'learner_syllabus_progress_id',
                    'learner_course_id',
                    'syllabus_id',
                    'category',
                    'status',
                )
                ->where('course_id', $course->course_id)
                ->where('learner_course_id', $learnercourse->learner_course_id)
                ->get();

                $learnerCourseCount = DB::table('learner_syllabus_progress')
                ->select(
                    'learner_syllabus_progress_id',
                    'learner_course_id',
                    'syllabus_id',
                    'category',
                    'status',
                )
                ->where('course_id', $course->course_id)
                ->where('learner_course_id', $learnercourse->learner_course_id)
                ->count();

                $learnerCompletedSyllabusCount = DB::table('learner_syllabus_progress')
                ->where('course_id', $course->course_id)
                ->where('learner_course_id', $learnercourse->learner_course_id)
                ->where('status', 'COMPLETED')
                ->count();

                $learnerInProgressSyllabusCount = DB::table('learner_syllabus_progress')
                ->where('course_id', $course->course_id)
                ->where('learner_course_id', $learnercourse->learner_course_id)
                ->where('status', 'IN PROGRESS')
                ->count();

                $learnerLockedSyllabusCount = DB::table('learner_syllabus_progress')
                ->where('course_id', $course->course_id)
                ->where('learner_course_id', $learnercourse->learner_course_id)
                ->where(function ($query) {
                    $query->where('status', 'LOCKED')
                          ->orWhere('status', 'NOT YET STARTED');
                })
                ->count();

                $percentageCompleted = ($learnerCompletedSyllabusCount / $learnerCourseCount) * 100;

                $learnerLessonCompletedData = DB::table('learner_lesson_progress')
                ->select(
                    'start_period',
                    'finish_period',
                    DB::raw('TIME_FORMAT(TIMEDIFF(learner_lesson_progress.finish_period, learner_lesson_progress.start_period), "%H:%i:%s") as time_difference')

                )
                ->where('course_id', $course->course_id)
                ->where('learner_course_id', $learnercourse->learner_course_id)
                ->where('status', 'COMPLETED')
                ->get();

                $learnerActivityCompletedData = DB::table('learner_activity_progress')
                ->select(
                    'start_period',
                    'finish_period',
                    DB::raw('TIME_FORMAT(TIMEDIFF(learner_activity_progress.finish_period, learner_activity_progress.start_period), "%H:%i:%s") as time_difference')

                )
                ->where('course_id', $course->course_id)
                ->where('learner_course_id', $learnercourse->learner_course_id)
                ->where('status', 'COMPLETED')
                ->get();

                $learnerQuizCompletedData = DB::table('learner_quiz_progress')
                ->select(
                    'start_period',
                    'finish_period',
                    DB::raw('TIME_FORMAT(TIMEDIFF(learner_quiz_progress.finish_period, learner_quiz_progress.start_period), "%H:%i:%s") as time_difference')

                )
                ->where('course_id', $course->course_id)
                ->where('learner_course_id', $learnercourse->learner_course_id)
                ->where('status', 'COMPLETED')
                ->get();

                $totalLessonTimeDifference = 0;
                $totalActivityTimeDifference = 0;
                $totalQuizTimeDifference = 0;

                $numberOfLessonRows = count($learnerLessonCompletedData);
                $numberOfActivityRows = count($learnerActivityCompletedData);
                $numberOfQuizRows = count($learnerQuizCompletedData);

                foreach ($learnerLessonCompletedData as $row) {
                    
                    $startPeriod = new \DateTime($row->start_period);
                    $finishPeriod = new \DateTime($row->finish_period);

                    // Calculate time difference in seconds
                    $timeDifference = $finishPeriod->getTimestamp() - $startPeriod->getTimestamp();

                    // Calculate time difference in days
                    $daysDifference = $finishPeriod->diff($startPeriod)->days;

                    // Convert days to seconds and add to total time difference
                    $totalLessonTimeDifference += ($daysDifference * 24 * 60 * 60) + $timeDifference;
                }

                foreach ($learnerActivityCompletedData as $row) {
                    
                    $startPeriod = new \DateTime($row->start_period);
                    $finishPeriod = new \DateTime($row->finish_period);

                    // Calculate time difference in seconds
                    $timeDifference = $finishPeriod->getTimestamp() - $startPeriod->getTimestamp();

                    // Calculate time difference in days
                    $daysDifference = $finishPeriod->diff($startPeriod)->days;

                    // Convert days to seconds and add to total time difference
                    $totalActivityTimeDifference += ($daysDifference * 24 * 60 * 60) + $timeDifference;
                }

                foreach ($learnerQuizCompletedData as $row) {
                    
                    $startPeriod = new \DateTime($row->start_period);
                    $finishPeriod = new \DateTime($row->finish_period);

                    // Calculate time difference in seconds
                    $timeDifference = $finishPeriod->getTimestamp() - $startPeriod->getTimestamp();

                    // Calculate time difference in days
                    $daysDifference = $finishPeriod->diff($startPeriod)->days;

                    // Convert days to seconds and add to total time difference
                    $totalQuizTimeDifference += ($daysDifference * 24 * 60 * 60) + $timeDifference;
                }


                $totalNumberOfRows = ($numberOfLessonRows + $numberOfActivityRows + $numberOfQuizRows);
                $totalTimeDifference = ($totalLessonTimeDifference + $totalActivityTimeDifference + $totalQuizTimeDifference);

                // Calculate average time difference in seconds
                $averageTimeDifference = ($totalNumberOfRows > 0) ? ($totalTimeDifference / $totalNumberOfRows) : 0;

                // Format the average time difference
                $averageTimeFormatted = gmdate("H:i:s", $averageTimeDifference);

                $data = [
                'title' => 'Performance',
                'learnerCourseData' => $learnerCourseData,
                'learnerCourseCount' => $learnerCourseCount,
                'learnerCompletedSyllabusCount' => $learnerCompletedSyllabusCount,
                'learnerInProgressSyllabusCount' => $learnerInProgressSyllabusCount,
                'learnerLockedSyllabusCount' => $learnerLockedSyllabusCount,
                'percentageCompleted' => $percentageCompleted,
                'averageTimeFormatted' => $averageTimeFormatted,
                'learnerLessonCompletedData' => $learnerLessonCompletedData,
                'learnerActivityCompletedData' => $learnerActivityCompletedData,
                'learnerQuizCompletedData' => $learnerQuizCompletedData,
            ];

            return response()->json($data);
            } catch (ValidationException $e) {
                $errors = $e->validator->errors();

                return response()->json(['errors' => $errors], 422);
            }


        } else {
            return redirect('/admin');
        }
    }

    public function syllabusPerformanceData(Learner $learner, Course $course) {

        if (auth('admin')->check()) {
            $adminSession = session('admin');
                try {

                $learnercourse = DB::table('learner_course')
                ->select(
                    'learner_course_id',
                    'learner_id',
                    'course_id',
                )
                ->where('learner_id', $learner->learner_id)
                ->where('course_id', $course->course_id)
                ->first();


                $learnerLessonPerformanceData = DB::table('learner_lesson_progress')
                ->select(
                    'learner_lesson_progress.learner_lesson_progress_id',
                    'learner_lesson_progress.lesson_id',
                    'learner_lesson_progress.status',
                    'learner_lesson_progress.start_period',
                    'learner_lesson_progress.finish_period',
                    DB::raw('TIMEDIFF(learner_lesson_progress.finish_period, learner_lesson_progress.start_period) as time_difference'),

                    'syllabus.topic_title',
                )
                ->join('syllabus', 'learner_lesson_progress.syllabus_id', '=', 'syllabus.syllabus_id')
                ->where('learner_lesson_progress.course_id', $course->course_id)
                ->where('learner_lesson_progress.learner_course_id', $learnercourse->learner_course_id)
                ->get();

                $learnerLessonCompletedPerformanceData = DB::table('learner_lesson_progress')
                ->select(
                    'learner_lesson_progress.learner_lesson_progress_id',
                    'learner_lesson_progress.lesson_id',
                    'learner_lesson_progress.status',
                    'learner_lesson_progress.start_period',
                    'learner_lesson_progress.finish_period',
                    DB::raw('TIME_FORMAT(TIMEDIFF(learner_lesson_progress.finish_period, learner_lesson_progress.start_period), "%H:%i:%s") as time_difference'),

                
                    'syllabus.topic_title',
                )
                ->join('syllabus', 'learner_lesson_progress.syllabus_id', '=', 'syllabus.syllabus_id')
                ->where('learner_lesson_progress.course_id', $course->course_id)
                ->where('learner_lesson_progress.learner_course_id', $learnercourse->learner_course_id)
                ->where('learner_lesson_progress.status', 'COMPLETED')
                ->get();

                $totalLessonTimeDifference = 0;
                $numberOfLessonRows = count($learnerLessonCompletedPerformanceData);

                foreach ($learnerLessonCompletedPerformanceData as $row) {
                    
                    $startPeriod = new \DateTime($row->start_period);
                    $finishPeriod = new \DateTime($row->finish_period);

                    // Calculate time difference in seconds
                    $timeDifference = $finishPeriod->getTimestamp() - $startPeriod->getTimestamp();

                    // Calculate time difference in days
                    $daysDifference = $finishPeriod->diff($startPeriod)->days;

                    // Convert days to seconds and add to total time difference
                    $totalLessonTimeDifference += ($daysDifference * 24 * 60 * 60) + $timeDifference;
                }

                // Calculate average time difference in seconds
                $averageLessonTimeDifference = ($numberOfLessonRows > 0) ? ($totalLessonTimeDifference / $numberOfLessonRows) : 0;

                // Format the average time difference
                $averageLessonTimeFormatted = gmdate("H:i:s", $averageLessonTimeDifference);



                $learnerActivityPerformanceData = DB::table('learner_activity_progress')
                ->select(
                    'learner_activity_progress.learner_activity_progress_id',
                    'learner_activity_progress.course_id',
                    'learner_activity_progress.syllabus_id',
                    'learner_activity_progress.activity_id',
                    'learner_activity_progress.learner_course_id',
                    'learner_activity_progress.status',
                    'learner_activity_progress.start_period',
                    'learner_activity_progress.finish_period',
                    DB::raw('TIME_FORMAT(TIMEDIFF(learner_activity_progress.finish_period, learner_activity_progress.start_period), "%H:%i:%s") as time_difference'),

                    'syllabus.topic_title',
                    'syllabus.topic_id',
                )
                ->join('syllabus', 'learner_activity_progress.syllabus_id', '=', 'syllabus.syllabus_id')
                ->where('learner_activity_progress.course_id', $course->course_id)
                ->where('learner_activity_progress.learner_course_id', $learnercourse->learner_course_id)
                ->get();

                $learnerActivityCompletedPerformanceData = DB::table('learner_activity_progress')
                ->select(
                    'learner_activity_progress.learner_activity_progress_id',
                    'learner_activity_progress.course_id',
                    'learner_activity_progress.syllabus_id',
                    'learner_activity_progress.activity_id',
                    'learner_activity_progress.learner_course_id',
                    'learner_activity_progress.status',
                    'learner_activity_progress.start_period',
                    'learner_activity_progress.finish_period',
                    DB::raw('TIME_FORMAT(TIMEDIFF(learner_activity_progress.finish_period, learner_activity_progress.start_period), "%H:%i:%s") as time_difference'),

                    'syllabus.topic_title',
                    'syllabus.topic_id',
                )
                ->join('syllabus', 'learner_activity_progress.syllabus_id', '=', 'syllabus.syllabus_id')
                ->where('learner_activity_progress.course_id', $course->course_id)
                ->where('learner_activity_progress.learner_course_id', $learnercourse->learner_course_id)
                ->where('learner_activity_progress.status', 'COMPLETED')
                ->get();

                $learnerActivityCompletedOutputData = DB::table('learner_activity_output')
                ->select(
                    'learner_activity_output_id',
                    'learner_course_id',
                    'syllabus_id',
                    'activity_id',
                    'activity_content_id',
                    'total_score',
                    'attempt',
                    'mark',
                )
                ->where('learner_activity_output.course_id', $course->course_id)
                ->where('learner_activity_output.learner_course_id', $learnercourse->learner_course_id)
                ->get();

                $totalActivityTimeDifference = 0;
                $numberOfActivityRows = count($learnerActivityCompletedPerformanceData);

                foreach ($learnerActivityCompletedPerformanceData as $row) {
                    
                    $startPeriod = new \DateTime($row->start_period);
                    $finishPeriod = new \DateTime($row->finish_period);

                    // Calculate time difference in seconds
                    $timeDifference = $finishPeriod->getTimestamp() - $startPeriod->getTimestamp();

                    // Calculate time difference in days
                    $daysDifference = $finishPeriod->diff($startPeriod)->days;

                    // Convert days to seconds and add to total time difference
                    $totalActivityTimeDifference += ($daysDifference * 24 * 60 * 60) + $timeDifference;
                }

                // Calculate average time difference in seconds
                $averageActivityTimeDifference = ($numberOfActivityRows > 0) ? ($totalActivityTimeDifference / $numberOfActivityRows) : 0;

                // Format the average time difference
                $averageActivityTimeFormatted = gmdate("H:i:s", $averageActivityTimeDifference);



                
                $learnerQuizPerformanceData = DB::table('learner_quiz_progress')
                ->select(
                    'learner_quiz_progress.learner_quiz_progress_id',
                    'learner_quiz_progress.course_id',
                    'learner_quiz_progress.syllabus_id',
                    'learner_quiz_progress.quiz_id',
                    'learner_quiz_progress.learner_course_id',
                    'learner_quiz_progress.status',
                    'learner_quiz_progress.attempt',
                    'learner_quiz_progress.score',
                    'learner_quiz_progress.remarks',
                    'learner_quiz_progress.start_period',
                    'learner_quiz_progress.finish_period',
                    DB::raw('TIME_FORMAT(TIMEDIFF(learner_quiz_progress.finish_period, learner_quiz_progress.start_period), "%H:%i:%s") as time_difference'),

                    'syllabus.topic_title',
                    'syllabus.topic_id',
                )
                ->join('syllabus', 'learner_quiz_progress.syllabus_id', '=', 'syllabus.syllabus_id')
                ->where('learner_quiz_progress.course_id', $course->course_id)
                ->where('learner_quiz_progress.learner_course_id', $learnercourse->learner_course_id)
                ->get();

                $learnerQuizCompletedPerformanceData = DB::table('learner_quiz_progress')
                ->select(
                    'learner_quiz_progress.learner_quiz_progress_id',
                    'learner_quiz_progress.course_id',
                    'learner_quiz_progress.syllabus_id',
                    'learner_quiz_progress.quiz_id',
                    'learner_quiz_progress.learner_course_id',
                    'learner_quiz_progress.status',
                    'learner_quiz_progress.attempt',
                    'learner_quiz_progress.score',
                    'learner_quiz_progress.remarks',
                    'learner_quiz_progress.start_period',
                    'learner_quiz_progress.finish_period',
                    DB::raw('TIME_FORMAT(TIMEDIFF(learner_quiz_progress.finish_period, learner_quiz_progress.start_period), "%H:%i:%s") as time_difference'),

                    'syllabus.topic_title',
                    'syllabus.topic_id',
                )
                ->join('syllabus', 'learner_quiz_progress.syllabus_id', '=', 'syllabus.syllabus_id')
                ->where('learner_quiz_progress.course_id', $course->course_id)
                ->where('learner_quiz_progress.learner_course_id', $learnercourse->learner_course_id)
                ->where('learner_quiz_progress.status', 'COMPLETED')
                ->get();

                $totalQuizTimeDifference = 0;
                $numberOfQuizRows = count($learnerQuizCompletedPerformanceData);

                foreach ($learnerQuizCompletedPerformanceData as $row) {
                    
                    $startPeriod = new \DateTime($row->start_period);
                    $finishPeriod = new \DateTime($row->finish_period);

                    // Calculate time difference in seconds
                    $timeDifference = $finishPeriod->getTimestamp() - $startPeriod->getTimestamp();

                    // Calculate time difference in days
                    $daysDifference = $finishPeriod->diff($startPeriod)->days;

                    // Convert days to seconds and add to total time difference
                    $totalQuizTimeDifference += ($daysDifference * 24 * 60 * 60) + $timeDifference;
                }

                // Calculate average time difference in seconds
                $averageQuizTimeDifference = ($numberOfQuizRows > 0) ? ($totalQuizTimeDifference / $numberOfQuizRows) : 0;

                // Format the average time difference
                $averageQuizTimeFormatted = gmdate("H:i:s", $averageQuizTimeDifference);



                $data = [
                'title' => 'Performance',
                'learnerLessonPerformanceData' => $learnerLessonPerformanceData,
                'learnerLessonCompletedPerformanceData' => $learnerLessonCompletedPerformanceData,
                'averageLessonTimeFormatted' => $averageLessonTimeFormatted,
                'learnerActivityPerformanceData' => $learnerActivityPerformanceData,
                'learnerActivityCompletedPerformanceData' => $learnerActivityCompletedPerformanceData,
                'averageActivityTimeFormatted' => $averageActivityTimeFormatted,
                'learnerActivityCompletedOutputData' => $learnerActivityCompletedOutputData,
                'learnerQuizPerformanceData' => $learnerQuizPerformanceData,
                'learnerQuizCompletedPerformanceData' => $learnerQuizCompletedPerformanceData,
                'averageQuizTimeFormatted' => $averageQuizTimeFormatted,
                ];

            return response()->json($data);
            } catch (ValidationException $e) {
                $errors = $e->validator->errors();

                return response()->json(['errors' => $errors], 422);
            }


        } else {
            return redirect('/admin');
        }
    }
}
