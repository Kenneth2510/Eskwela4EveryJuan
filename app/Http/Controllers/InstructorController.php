<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Learner;
use App\Models\Instructor;
use App\Models\Course;
use App\Models\Admin;
use App\Models\session_log;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;


class InstructorController extends Controller
{
    public function index() {
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            return redirect('/instructor/dashboard')->with('title', 'Instructor Dashboard');
            // return back();
        } else {
        return view('instructor.login')
        ->with([
            'title'=> 'Instructor Login',
            'scripts' => ['instructorLogin.js'],
        ]);
        }

    }

    public function login_process(Request $request) {
        
        $instructorData = $request->validate([
            "instructor_username" =>  ['required'],
            "password" =>  ['required'],
        ]);

        if (auth('instructor')->attempt($instructorData)) {
            $instructor = auth('instructor')->user();
            $instructor = Instructor::find($instructor->instructor_id);
            // dd($instructor);

            if($instructor) {
                $request->session()->put("instructor", $instructor);
                // dd(session('instructor'));
                $request->session()->put("instructor_authenticated", true);
                // dd($request->session()->get("instructor_authenticated"));
            }
            
            // $request->session()->regenerate();
    
            return redirect('/instructor/authenticate')->with('message', "Welcome Back");
        }

        
        return back()->withErrors(['instructor_username' => 'Login Failed'])->withInput($request->except('password'));

    }

    public function login_authentication(Request $request) {
        if (!$request->session()->has('instructor_authenticated')) {
            return redirect(route('instructor.login'))->withErrors(['instructor_username' => 'Authentication Required']);
        }

        
        // dd($request->session()->get('instructor_authenticated'));
        return view('instructor.authenticate')->with('title', 'Instructor Login');

    }

    public function authenticate_instructor(Request $request) {

        if (!$request->session()->has('instructor_authenticated')) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect(route('instructor.login'))->withErrors(['instructor_username' => 'Authentication Required']);
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

        $instructor = auth('instructor')->user();
        $instructorSecurityCode = $instructor->instructor_security_code;



        if ($securityCodeNumber === $instructorSecurityCode) {
            $request->session()->forget('instructor_authenticated');

            $now = Carbon::now();
            $timestampString = $now->toDateTimeString();


            $session_log_data = [
                "session_user_id" => $instructor->instructor_id,
                "session_user_type" => "INSTRUCTOR",
                "session_in" => $timestampString,
            ];

            session_log::create($session_log_data);

            // $request->session()->regenerate();
            return redirect('/instructor/dashboard')->with('message', 'Authenticated Successfully');
        } 

        return back()->withErrors(['security_code' => 'Invalid Security Code']);
}

    public function logout(Request $request) {

        $instructor = auth('instructor')->user();

        $now = Carbon::now();
        $timestampString = $now->toDateTimeString();
    

        $session_data = DB::table('session_logs')
        ->where('session_user_id', $instructor->instructor_id)
        ->where('session_user_type' , "INSTRUCTOR")
        ->orderBy('session_log_id', 'DESC')
        ->first();

        if ($session_data) {

            DB::table('session_logs')
                ->where('session_log_id', $session_data->session_log_id)
                ->where('session_user_id', $instructor->instructor_id)
                ->where('session_user_type', "INSTRUCTOR")
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

        auth('instructor')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/instructor')->with('message', 'Logout Successful');

    }

    // public function register(){
    //     return view('instructor.register')->with('title', 'Instructor Register');
    // }

    public function register1(){
        return view('instructor.register1')
        ->with([
            'title' => 'Instructor Register',
            'scripts' =>  ['instructorRegister.js'],
        ]);
    }

    public function register_process(Request $request) {
        // dd($request);
        $instructorData = $request->validate([
            "instructor_fname" => ['required'],
            "instructor_lname" => ['required'],
            "instructor_bday" => ['required'],
            "instructor_gender" => ['required'],
            "instructor_contactno" => ['required', Rule::unique('instructor', 'instructor_contactno')],
            "instructor_email" => ['required', 'email', Rule::unique('instructor', 'instructor_email')],
            "instructor_username" => ['required', Rule::unique('instructor' , 'instructor_username')],
            "password" => 'required|confirmed',
            // "instructor_security_code" => ['required'],
            "instructor_credentials" => ['required', 'file'],
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
        $instructorData['instructor_security_code'] = $securityCodeNumber;


        $instructorData['instructor_credentials'] = '';
        $instructorData['password'] = bcrypt($instructorData['password']);
    
        $folderName = "{$instructorData['instructor_lname']} {$instructorData['instructor_fname']}";
        $folderName = Str::slug($folderName, '_');
        if($request->hasFile('instructor_credentials')) {
            
            $file = $request->file('instructor_credentials');
            
            try {

           
                $fileName = time() . '-' . $file->getClientOriginalName();
                $folderPath = 'instructors/' . $folderName;
                $filePath = $file->storeAs($folderPath, $fileName, 'public');

                // Copy the default photo to the same directory
                $defaultPhoto = 'public/images/default_profile.png';
                // $isExists = Storage::exists($defaultPhoto);

                $defaultPhoto_path = $folderPath . '/default_profile.png';
                // dd($defaultPhoto_path);

                Storage::copy($defaultPhoto, 'public/' . $defaultPhoto_path);
                // $isExists = Storage::exists($defaultPhoto_path);
                // dd($isExists);
              
                
                // add to database
                $instructorData['profile_picture'] = $defaultPhoto_path;

            $instructorData['instructor_credentials'] = $filePath;
            // dd($instructorData);
            Instructor::create($instructorData);

            //add to storage
            // if(!Storage::exists($folderPath)) {
            //     Storage::makeDirectory($folderPath);
            // }

            // Storage::putFileAs($folderPath, $file, $fileName);


           } catch (\Exception $e) {
            dd($e->getMessage());
           }

           return redirect('/instructor')->with('title', 'Instructor Login')->with('message' , 'Account Successfully created');
        }
    }

    public function dashboard(){

        if (auth('instructor')->check()) {
            $instructor = session('instructor');
        } else {
            return redirect('/instructor');
        }

        try {
            $coursesCount = Course::where('instructor_id', $instructor->instructor_id)->count();
            $courseApproved = Course::where('course_status', "LIKE", 'Approved%')
            ->where('instructor_id', $instructor->instructor_id)
            ->count();

            // $courses = Course::where('instructor_id', $instructor->instructor_id)->limit(3)->get();

            $courses = DB::table('course')
            ->select(
                'course.course_id',
                'course.course_name',
                'course.course_code',
                'course.course_status',
                'course.course_difficulty',
                'course.instructor_id',

                'instructor.instructor_fname',
                'instructor.instructor_lname',
            )
            ->join('instructor', 'course.instructor_id', '=', 'instructor.instructor_id')
            ->where('course.instructor_id', $instructor->instructor_id)
            ->get();

            // dd($courses);

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
       

        return view('instructor.dashboard', compact('instructor'))
        ->with([
            'title' => 'Instructor Dashboard',
            'scripts' => ['instructor_dashboard.js'],
            'courses' => $courses,
            'coursesCount' => $coursesCount,
            'courseApproved'=>$courseApproved,
        ]);
    }

    public function overviewNum() {
        if (auth('instructor')->check()) {
            $instructor = session('instructor');

            try {

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
            }

        } else {
            return redirect('/instructor');
        }


    }

    public function settings(){

        
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            // dd($instructor);

        } else {
            return redirect('/instructor');
        }
        return view('instructor.settings', compact('instructor'))
        ->with([
            'title' => 'Instructor Profile',
            'scripts' => ['instructorSettings.js'],
        ]);
    }

    public function update_info(Request $request) {
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            // dd($instructor);


            
        $updated_instructorData = $request->validate([
            "instructor_fname" => ['required'],
            "instructor_lname" => ['required'],
            "instructor_bday" => ['required'],
            "instructor_gender" => ['required'],
            "instructor_contactno" => ['required'],
        ]);

        $passwordConfirm = $request->input('password_confirmation');

        if (!empty($passwordConfirm)) {
            if (!Hash::check($passwordConfirm, $instructor['password'])) {
                return back()->withErrors(['password_confirmation' => 'Password confirmation does not match.'])->withInput();
            }
        } else {
            return back()->withErrors(['password_confirmation' => 'Password confirmation is required.'])->withInput();
        }

        Instructor::where('instructor_id', $instructor['instructor_id'])
                    ->update($updated_instructorData);
        
        $instructor->instructor_fname = $updated_instructorData['instructor_fname'];
        $instructor->instructor_lname = $updated_instructorData['instructor_lname'];
        $instructor->instructor_bday = $updated_instructorData['instructor_bday'];
        $instructor->instructor_gender = $updated_instructorData['instructor_gender'];
        $instructor->instructor_contactno = $updated_instructorData['instructor_contactno'];
            
        session(['instructor' => $instructor]);

        return redirect('/instructor/settings')->with('message' , 'Profile updated successfully');
        
        } else {
            return redirect('/instructor');
        }  
    }

    public function update_profile(Request $request) {
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
        } else {
            return redirect('/instructor');
        }
    
        $instructorData = $request->validate([
            "profile_picture" => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $folderName = "{$instructor['instructor_lname']} {$instructor['instructor_fname']}";
        $folderName = Str::slug($folderName, '_');
        $fileName = time() . '-' . $instructorData['profile_picture']->getClientOriginalName();
        $folderPath = 'instructors/' . $folderName; // Specify the public directory
        $filePath = $instructorData['profile_picture']->storeAs($folderPath, $fileName, 'public');
    
        try {
            // Update the instructor's profile_picture directly with the correct path
            Instructor::where('instructor_id', $instructor['instructor_id'])
                ->update(['profile_picture' => $filePath]);

                $instructor['profile_picture'] = $filePath;
                session(['instructor' => $instructor]);
    
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    
        return redirect('/instructor/settings')->with('message', 'Profile picture updated successfully');
    }
   

    
    
}
