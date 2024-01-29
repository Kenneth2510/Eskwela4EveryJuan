<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Learner;
use App\Models\Course;
use App\Models\LearnerCourse;
use App\Models\session_log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class LearnerController extends Controller
{
    public function index() {

        if (auth('learner')->check()) {
            $learner = session('learner');
            // return redirect('/instructor/dashboard')->with('title', 'Instructor Dashboard');
            return back();
        } else {
        return view('learner.login')
        ->with([
            'title' => 'Learner Login',
            'scripts' => ['instructorLogin.js']
        ]);
        }

        // return view('learner.login')->with('title', 'Learner Login');
    }

    
    public function login_process(Request $request) {
        
        $learnerData = $request->validate([
            "learner_username" =>  ['required'],
            "password" =>  ['required'],
        ]);

        // dd($learnerData);

        if (auth('learner')->attempt($learnerData)) {
            $learner = auth('learner')->user();
            $learner = Learner::find($learner->learner_id);
            // dd($instructor);

            if($learner) {
                $request->session()->put("learner", $learner);
                // dd(session('instructor'));
                $request->session()->put("learner_authenticated", true);
                // dd($request->session()->get("instructor_authenticated"));
            }
            
            // $request->session()->regenerate();
    
            return redirect('/learner/authenticate')->with('message', "Welcome Back");
        }

        
        return back()->withErrors(['learner_username' => 'Login Failed'])->withInput($request->except('password'));

    }

    public function login_authentication(Request $request) {
        if (!$request->session()->has('learner_authenticated')) {
            return redirect(route('learner.login'))->withErrors(['learner_username' => 'Authentication Required']);
        }

        
        // dd($request->session()->get('instructor_authenticated'));
        return view('learner.authenticate')->with('title', 'Learner Login');

    }

    public function authenticate_learner(Request $request) {

        if (!$request->session()->has('learner_authenticated')) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect(route('learner.login'))->withErrors(['learner_username' => 'Authentication Required']);
        }
            // dd($request);
        $codeNumber = $request->validate([
            "security_code_1" => ['required', 'numeric'],
            "security_code_2" => ['required', 'numeric'],
            "security_code_3" => ['required', 'numeric'],
            "security_code_4" => ['required', 'numeric'],
            "security_code_5" => ['required', 'numeric'],
            "security_code_6" => ['required', 'numeric'],
        ]);

        $securityCodeNumber = implode('', $codeNumber);

        $learner = auth('learner')->user();
        $learnerSecurityCode = $learner->learner_security_code;



        if ($securityCodeNumber === $learnerSecurityCode) {
            $request->session()->forget('learner_authenticated');

            $now = Carbon::now();
            $timestampString = $now->toDateTimeString();


            $session_log_data = [
                "session_user_id" => $learner->learner_id,
                "session_user_type" => "LEARNER",
                "session_in" => $timestampString,
            ];

            session_log::create($session_log_data);

            // $request->session()->regenerate();
            return redirect('/learner/dashboard')->with('message', 'Authenticated Successfully');
        } 

        return back()->withErrors(['security_code' => 'Invalid Security Code']);
    }


    public function logout(Request $request) {

        $learner = auth('learner')->user();

        $now = Carbon::now();
        $timestampString = $now->toDateTimeString();
    

        $session_data = DB::table('session_logs')
        ->where('session_user_id', $learner->learner_id)
        ->where('session_user_type' , "LEARNER")
        ->orderBy('session_log_id', 'DESC')
        ->first();

        if ($session_data) {

            DB::table('session_logs')
                ->where('session_log_id', $session_data->session_log_id)
                ->where('session_user_id', $learner->learner_id)
                ->where('session_user_type', "LEARNER")
                ->update([
                    "session_out" => $timestampString,
                ]);

            $sessionIn = Carbon::parse($session_data->session_in);
            $sessionOut = $now;
            $timeDifference = $sessionOut->diffInSeconds($sessionIn);
        
            DB::table('session_logs')
                ->where('session_log_id', $session_data->session_log_id)
                ->update([
                    "time_difference" => $timeDifference,
                ]);
        }


        auth('learner')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/learner')->with('message', 'Logout Successful');

    }

    public function register(){
        return view('learner.register')
        ->with([
            'title' => 'Learner Register',
            'scripts' => ['learnerRegister.js'] ,
        ]);
    }
    // public function register1(){
    //     return view('learner.register1')->with('title', 'Learner Register');
    // }


    public function register_process(Request $request) {
        $LearnerPersonalData = $request->validate ([
            "learner_fname" => ['required'],
            "learner_lname" => ['required'],
            "learner_bday" => ['required'],
            "learner_gender" => ['required'],
            "learner_contactno" => ['required' , Rule::unique('learner' , 'learner_contactno')],
            "learner_email" => ['required' , 'email' , Rule::unique('learner' , 'learner_email')],
        ]);

        $businessData = $request->validate ([
            "business_name" => ['required'],
            "business_address" => ['required'],
            "business_owner_name" => ['required'],
            "bplo_account_number" => ['required'],
            "business_category" => ['required'],
        ]);

        $LearnerLoginData = $request->validate([
            "learner_username" => ['required', Rule::unique('learner' , 'learner_username')],
            "password" => 'required|confirmed',
        ]);

        $codeNumber = $request->validate([
            "security_code_1" => ['required', 'alpha_num'],
            "security_code_2" => ['required', 'alpha_num'],
            "security_code_3" => ['required', 'alpha_num'],
            "security_code_4" => ['required', 'alpha_num'],
            "security_code_5" => ['required', 'alpha_num'],
            "security_code_6" => ['required', 'alpha_num'],
        ]);


        $securityCodeNumber = implode('', $codeNumber);
        // dd($securityCodeNumber);


        

        $LearnerData = array_merge($LearnerPersonalData , $LearnerLoginData , ["learner_security_code" => $securityCodeNumber]);
        $LearnerData['password'] = bcrypt($LearnerData['password']);
        
        $LearnerData['learner_security_code'] = $securityCodeNumber;

        $folderName = "{$LearnerData['learner_lname']} {$LearnerData['learner_fname']}";
        $folderName = Str::slug($folderName, '_');
        $folderPath = 'learners/' . $folderName;

        // Copy the default photo to the same directory
        $defaultPhoto = 'public/images/default_profile.png';
        // $isExists = Storage::exists($defaultPhoto);

        $defaultPhoto_path = $folderPath . '/default_profile.png';
        // dd($defaultPhoto_path);

        $LearnerData['profile_picture'] = $defaultPhoto_path;
        Storage::copy($defaultPhoto, 'public/' . $defaultPhoto_path);
        // $isExists = Storage::exists($defaultPhoto_path);
        // dd($isExists);

        Learner::create($LearnerData);

        $latestStudent = DB::table('learner')->orderBy('created_at', 'DESC')->first();

        $latestStudentId = $latestStudent->learner_id;

        $businessData['learner_id'] = $latestStudentId;

        Business::create($businessData);

        $folderName = "{$LearnerData['learner_lname']} {$LearnerData['learner_fname']}";
        $folderName = Str::slug($folderName, '_');
        
        // $fileName = time() . '-' . $file->getClientOriginalName();
        $folderPath = '/public/learners/' . $folderName;
        // $filePath = $file->storeAs($folderPath, $fileName, 'public');

        if(!Storage::exists($folderPath)) { 
            Storage::makeDirectory($folderPath);
        }

        return redirect('/learner')->with('title', 'Learner Management')->with('message' , 'Data was successfully stored');
    
    }

    public function dashboard() {
        if (auth('learner')->check()) {
            $learner = session('learner');
    
            try {
                // Get the courses the learner is enrolled in
                $enrolledCoursesCheck = DB::table('learner_course')
                    ->select('learner_course.course_id')
                    ->where('learner_course.learner_id', '=', $learner->learner_id)
                    ->get()
                    ->pluck('course_id'); // Get an array of course_ids
    
                // Query for approved courses not in the enrolledCourses list
                $query = DB::table('course')
                    ->select(
                        "course.course_id",
                        "course.course_name",
                        "course.course_code",
                        "instructor.instructor_lname",
                        "instructor.instructor_fname",
                        "instructor.profile_picture"
                    )
                    ->where('course.course_status', '=', 'Approved')
                    ->whereNotIn('course.course_id', $enrolledCoursesCheck)
                    ->join('instructor', 'instructor.instructor_id', '=', 'course.instructor_id')
                    ->orderBy("course.course_name", "ASC");
    
                $courses = $query->get();

                      // Get the courses the learner is enrolled in
                $enrolledCourses = DB::table('learner_course')
                    ->select(
                        'learner_course.course_id',
                        'learner_course.status',
                        'learner_course.created_at',
                        'course.course_name',
                        'course.course_code',
                        'course.course_difficulty',
                        'course.instructor_id',
                        'instructor.instructor_fname',
                        'instructor.instructor_lname',
                        'instructor.profile_picture'
                    )
                    ->join('course', 'learner_course.course_id', '=', 'course.course_id')
                    ->join('instructor', 'course.instructor_id', '=', 'instructor.instructor_id')
                    ->where('learner_course.learner_id', '=', $learner->learner_id)
                    ->where('learner_course.status', '=', 'Approved')
                    ->get();

                // dd($enrolledCourses);
    
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
    
            return view('learner.dashboard', compact('learner', 'courses', 'enrolledCourses'))
            ->with([
                'title' => 'Learner Dashboard',
                'scripts' => ['learner_dashboard.js'],
            ]);
    
        } else {
            return redirect('/learner');
        }
    }

    public function overviewNum() {
        if (auth('learner')->check()) {
            $learner = session('learner');

            try{
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

                $totalLearnerCourseCompleted = DB::table('learner_course_progress')
                ->where('learner_course_progress.learner_id', $learner->learner_id)
                ->where('learner_course_progress.course_progress', "COMPLETED")
                ->count();

                $totalDaysActive = DB::table('session_logs')
                ->select(DB::raw('DATE(session_in) as date'))
                ->where('session_user_id', $learner->learner_id)
                ->where('session_user_type', 'LEARNER')
                ->groupBy(DB::raw('DATE(session_in)'))
                ->get()
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
                    'totalLearnerApprovedCourseCount' => $totalLearnerApprovedCourseCount,
                    'totalLearnerPendingCourseCount' => $totalLearnerPendingCourseCount,
                    'totalLearnerRejectedCourseCount' => $totalLearnerRejectedCourseCount,
                    'totalCoursesLessonCount' => $totalCoursesLessonCount,
                    'totalCoursesActivityCount' => $totalCoursesActivityCount,
                    'totalCoursesQuizCount' => $totalCoursesQuizCount,
                    'totalCoursesLessonCompletedCount' => $totalCoursesLessonCompletedCount,
                    'totalCoursesActivityCompletedCount' => $totalCoursesActivityCompletedCount,
                    'totalCoursesQuizCompletedCount' => $totalCoursesQuizCompletedCount,
                    'totalDaysActive' => $totalDaysActive,
                    'totalLearnerCourseCompleted' => $totalLearnerCourseCompleted,
                ];
                
        
                return response()->json($data);
            } catch (ValidationException $e) {
                $errors = $e->validator->errors();

                return response()->json(['errors' => $errors], 422);
            }


        } else {
            return redirect('/learner');
        }
    }

    public function sessionData() {
        if (auth('learner')->check()) {
            $learner = session('learner');

            try{
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
            return redirect('/learner');
        }
    }

    public function settings() {

        if (auth('learner')->check()) {
            $learner = session('learner');
            // dd($learner);

            $business = Business::where('learner_id', $learner->learner_id)->first();
            // dd($business);
        } else {
            return redirect('/learner');
        }
        return view('learner.settings', compact('learner', 'business'))
        ->with([
            'title' => 'Learner Settings',
            'scripts' => ['learnerUserSettings.js'],
        ]);
    }

    public function update_info(Request $request) {
        if (auth('learner')->check()) {
            $learner = session('learner');
            // dd($learner);

            // dd($request);
            
        $updated_learnerData = $request->validate([
            "learner_fname" => ['required'],
            "learner_lname" => ['required'],
            "learner_bday" => ['required'],
            "learner_gender" => ['required'],
        ]);

        $updated_businessData = $request->validate([
            "business_name" => ['required'],
            "business_address" => ['required'],
            "business_owner_name" => ['required'],
        ]);

        $passwordConfirm = $request->input('password_confirmation');

        if (!empty($passwordConfirm)) {
            if (!Hash::check($passwordConfirm, $learner['password'])) {
                return back()->withErrors(['password_confirmation' => 'Password confirmation does not match.'])->withInput();
            }
        } else {
            return back()->withErrors(['password_confirmation' => 'Password confirmation is required.'])->withInput();
        }

        Learner::where('learner_id', $learner['learner_id'])
                    ->update($updated_learnerData);
        

        if ($learner && !empty($businessData)) {

            $learnerBusiness = Business::where('learner_id', $learner['learner_id'])->first();
            if ($learnerBusiness) {
                try {
                    $learnerBusiness->update($updated_businessData);
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }
        }
        

                    
        $learner->learner_fname = $updated_learnerData['learner_fname'];
        $learner->learner_lname = $updated_learnerData['learner_lname'];
        $learner->learner_bday = $updated_learnerData['learner_bday'];
        $learner->learner_gender = $updated_learnerData['learner_gender'];
            
        session(['learner' => $learner]);

        return redirect('/learner/settings')->with('message' , 'Profile updated successfully');
        
        } else {
            return redirect('/learner');
        }  
    }

    public function update_profile(Request $request) {
        if (auth('learner')->check()) {
            $learner = session('learner');
        } else {
            return redirect('/learner');
        }
    
        $learnerData = $request->validate([
            "profile_picture" => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $folderName = "{$learner['learner_lname']} {$learner['learner_fname']}";
        $folderName = Str::slug($folderName, '_');
        $fileName = time() . '-' . $learnerData['profile_picture']->getClientOriginalName();
        $folderPath = 'learners/' . $folderName; // Specify the public directory
        $filePath = $learnerData['profile_picture']->storeAs($folderPath, $fileName, 'public');
    
        try {
            // Update the instructor's profile_picture directly with the correct path
            Learner::where('learner_id', $learner['learner_id'])
                ->update(['profile_picture' => $filePath]);

                $learner['profile_picture'] = $filePath;
                session(['learner' => $learner]);
    
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    
        return redirect('/learner/settings')->with('message', 'Profile picture updated successfully');
    }
    
    
}
