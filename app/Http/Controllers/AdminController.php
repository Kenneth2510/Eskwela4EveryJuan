<?php
// sample
namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Learner;
use App\Models\Instructor;
use App\Models\Course;
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


class AdminController extends Controller
{
    public function index()
{
    if (auth('admin')->check()) {
        return redirect('/admin/dashboard');
    }

    // Return the login page for administrators
    return view('admin.index')->with('title', 'Eskwela4EveryJuan Admin');
}


    public function login_process(Request $request) {
        $adminData = $request->validate([
            "admin_username" => ['required'],
            "password" => ['required']
        ]);
    
        if (auth('admin')->attempt($adminData)) {

            $admin = auth('admin')->user();
            // dd($admin);

            $admin = Admin::find($admin->admin_id);

            if($admin) {
                $request->session()->put('admin' , $admin);
            }

            $request->session()->regenerate();
    
            return redirect('/admin/dashboard')->with('message', "Welcome Back");
        }
    
        return back()->withErrors(['admin_username' => 'Login Failed'])->withInput($request->except('password'));
    }
    
    public function logout(Request $request) {
        auth('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin')->with('message', 'Logout Successful');
    
    }

    

    public function dashboard() {
        if (auth('admin')->check()) {
            $admin = session('admin');
            // dd($admin);
            $admin_codename = $admin['admin_codename'];
        } else {
            return redirect('/admin');
        }


        try {
            $learnerCount = Learner::count();
            $approvedLearnerCount = Learner::where("status", "LIKE", "Approved%")->count();
            $pendingLearnerCount = Learner::where("status", "LIKE", "Pending%")->count();
        
            $instructorCount = Instructor::count();
            $approvedInstructorCount = Instructor::where("status", "LIKE", "Approved%")->count();
            $pendingInstructorCount = Instructor::where("status", "LIKE", "Pending%")->count();

            return view('admin.dashboard', ['totalLearner' => $learnerCount,
                                            'totalInstructor' => $instructorCount,
                                            'approvedLearner' => $approvedLearnerCount,
                                            'approvedInstructor' => $approvedInstructorCount,
                                            'pendingLearner' => $pendingLearnerCount,
                                            'pendingInstructor' => $pendingInstructorCount,
                                            'adminCodeName' => $admin_codename])
                        ->with('title', 'Admin Dashboard');
        } catch(\Exception $e) {
            dd($e->getMessage());
        }}



// -------------------admin learner area------------------------
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
    
            return view('admin.learners', compact('learners'))
            ->with(['title' => 'Learner Management', 
                'adminCodeName' => $admin_codename,
                'scripts' => ['AD_learners.js']]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    

    public function add_learner() {
        if (auth('admin')->check()) {
            $admin = session('admin');
            // dd($admin);
            $admin_codename = $admin['admin_codename'];
        } else {
            return redirect('/admin');
        }

        return view('admin.add_learner')->with(['title' => 'Add New Learner', 'adminCodeName' => $admin_codename]);
    }
    
    public function store_new_learner(Request $request) {
        // dd($request);

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
            "learner_security_code" => ['required' , 'max:6'],
        ]);

        

        $LearnerData = array_merge($LearnerPersonalData , $LearnerLoginData);
        $LearnerData['password'] = bcrypt($LearnerData['password']);

        // $folderName = Str::slug($course->course_name, '_');
        
        $folderName = "{$LearnerData['learner_lname']} {$LearnerData['learner_fname']}";
        $folderName = Str::slug($folderName, '_');
        $folderPath = 'learners/' . $folderName;

        // Copy the default photo to the same directory
        $defaultPhoto = '/public/images/default_profile.png';
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

        return redirect('/admin/learners')->with('title', 'Learner Management')->with('message' , 'Data was successfully stored');
    }

    public function view_learner($id) {

        if (auth('admin')->check()) {
            $admin = session('admin');
            // dd($admin);
            $admin_codename = $admin['admin_codename'];
        } else {
            return redirect('/admin');
        }

        // dd($id);

        // $learnerdata = Learner::findOrFail($id);
        // $businessdata = Business::where('learner_id' , $id)->get();
        // // dd($learnerdata);
        // dd($businessdata);

        // return view('admin.view_learner' , [
        //     'learner' => $learnerdata, 
        //     'business' => $businessdata,
        //     ])->with('title' , 'View Learner');

        $learnerdata = Learner::findOrFail($id);
        $businessdata = Business::where('learner_id', $id)->first(); 

        // dd($businessdata);

        return view('admin.view_learner', [ 
            'learner' => $learnerdata,
            'business' => $businessdata,
        ])->with(['title' => 'View Learner', 
                'adminCodeName' => $admin_codename ,
                'scripts' => ['AD_learner_manage.js'] ,
        ]);
    }

    public function approveLearner(Learner $learner)
    {

        try {
            $learner->update(['status' => 'Approved']);  
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        return redirect()->back()->with('message' , 'Learner Status successfully changed');
    }

    public function rejectLearner(Learner $learner)
    {
        try {
            $learner->update(['status' => 'Rejected']);  
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        return redirect()->back()->with('message' , 'Learner Status successfully changed');
    }

    public function pendingLearner(Learner $learner)
    {
        try {
            $learner->update(['status' => 'Pending']);  
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        return redirect()->back()->with('message' , 'Learner Status successfully changed');
    }

    public function update_learner(Request $request, Learner $learner) {
        $l_id = $learner->learner_id;

        $LearnerPersonalData = $request->validate ([
            "learner_fname" => ['required'],
            "learner_lname" => ['required'],
            "learner_bday" => ['required'],
            "learner_gender" => ['required'],
            "learner_contactno" => ['required'],
            "learner_email" => ['required' , 'email'],
        ]);
        // dd($LearnerPersonalData);
 
        $businessData = $request->validate ([
            "business_name" => ['required'],
            "business_address" => ['required'],
            "business_owner_name" => ['required'],
            "bplo_account_number" => ['required'],
            "business_category" => ['required'],
        ]);

        try { 
            // DB::update("UPDATE learner
            // SET learner_fname = ?,
            //     learner_lname = ?,
            //     learner_bday = ?,
            //     learner_gender = ?,
            //     learner_contactno = ?,
            //     learner_email = ?
            // WHERE learner_id = ?",
            // [
            //     $LearnerPersonalData['learner_fname'],
            //     $LearnerPersonalData['learner_lname'],
            //     $LearnerPersonalData['learner_bday'],
            //     $LearnerPersonalData['learner_gender'],
            //     $LearnerPersonalData['learner_contactno'],
            //     $LearnerPersonalData['learner_email'],
            //     $l_id
            // ]);

            $learner->update($LearnerPersonalData);


            if ($learner && !empty($businessData)) {

                $learnerBusiness = Business::where('learner_id', $l_id)->first();
                if ($learnerBusiness) {
                    try {
                        $learnerBusiness->update($businessData);
                    } catch (\Exception $e) {
                        dd($e->getMessage());
                    }
                }

            }

        } catch (\Exception $e) {
            dd($e->getMessage());
        }


        return back()->with('message' , 'Data was successfully updated'); //add ->with('message') later
    }

    public function destroy_learner(Learner $learner) {
        // dd($learner);
        try {

            $relativeFilePath = str_replace('public/', '', $learner->profile_picture);
            if (Storage::disk('public')->exists($relativeFilePath)) {
                // Storage::disk('public')->delete($relativeFilePath);
                $specifiedDir = explode('/', $relativeFilePath);
                array_pop($specifiedDir);

                $dirPath = implode('/', $specifiedDir);

                // dd($dirPath);
                Storage::disk('public')->deleteDirectory($dirPath);
            
                $learner->delete();
            }
    
    
            session()->flash('message', 'Learner deleted Successfully');
            return response()->json(['message' => 'Learner deleted successfully', 'redirect_url' => "/admin/learners"]);
            
        
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

    }


    







// -----------------------admin instructor------------------------- 
    public function instructors() {
        return $this->search_instructor();
    }

    public function search_instructor() {

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
            $query = DB::table('instructor')
                ->orderBy('created_at', 'DESC');

            if(!empty($filter_date) || !empty($filter_status)) {
                if(!empty($filter_date) && empty($filter_date)) {
                    $query->where('created_at', 'LIKE', $filter_date.'%');
                } elseif (empty($filter_date) && !empty($filter_status)) {
                    $query->where('status', 'LIKE', $filter_status.'%');
                } else {
                    $query->where('created_at', 'LIKE', $filter_date.'%')
                        ->where('status', 'LIKE', $filter_status.'%');
                }
            }

            if(!empty($search_by) && !empty($search_val)) {
                if($search_by == 'name') {
                    $query->where(function ($query) use ($search_val) {
                        $query->where('instructor_fname', 'LIKE', $search_val.'%')
                            ->orWhere('instructor_lname', 'LIKE', $search_val.'%');
                    });
                } else {
                    $query->where($search_by, 'LIKE', $search_val.'%');
                }
            }


            $instructors = $query->paginate(10);

            return view('admin.instructors', compact('instructors'))
                ->with(['title' => 'Instructor Management', 'adminCodeName' => $admin_codename]);

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function add_instructor() {
        if (auth('admin')->check()) {
            $admin = session('admin');
            // dd($admin);
            $admin_codename = $admin['admin_codename'];
        } else {
            return redirect('/admin');
        }

        return view('admin.add_instructor')->with(['title' => 'Add New Instructor', 'adminCodeName' => $admin_codename]);
    }

    public function store_new_instructor(Request $request) {

            $instructorData = $request->validate([
                "instructor_fname" => ['required'],
                "instructor_lname" => ['required'],
                "instructor_bday" => ['required'],
                "instructor_gender" => ['required'],
                "instructor_contactno" => ['required', Rule::unique('instructor', 'instructor_contactno')],
                "instructor_email" => ['required', 'email', Rule::unique('instructor', 'instructor_email')],
                "instructor_username" => ['required', Rule::unique('instructor' , 'instructor_username')],
                "password" => 'required|confirmed',
                "instructor_security_code" => ['required', 'min:6'],
                "instructor_credentials" => ['required', 'file'],
            ]);

            $instructorData['instructor_credentials'] = '';
            $instructorData['profile_picture'] = '';
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

               return redirect('/admin/instructors')->with('title', 'Instructor Management')->with('message' , 'Data was successfully stored');
            }
        
    }


    public function view_instructor ($id) {
        if (auth('admin')->check()) {
            $admin = session('admin');
            // dd($admin);
            $admin_codename = $admin['admin_codename'];
        } else {
            return redirect('/admin');
        }

        try {
            $instructorData = Instructor::where('instructor_id', $id)->first();
            // dd($instructorData);
            return view('admin.view_instructor', ['instructor' => $instructorData])
            ->with(['title' => 'View Instructor', 
                    'adminCodeName' => $admin_codename ,
                    'scripts' => ['AD_instructor_manage.js'],
                ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function approveInstructor(Instructor $instructor)
    {

        try {
            $instructor->update(['status' => 'Approved']);  
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        return redirect()->back()->with('message' , 'Instructor Status successfully changed');
    }

    public function rejectInstructor(Instructor $instructor)
    {
        try {
            $instructor->update(['status' => 'Rejected']);  
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        return redirect()->back()->with('message' , 'Instructor Status successfully changed');
    }

    public function pendingInstructor(Instructor $instructor)
    {
        try {
            $instructor->update(['status' => 'Pending']);  
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        return redirect()->back()->with('message' , 'Instructor Status successfully changed');
    }

    public function update_instructor(Request $request, Instructor $instructor) {
        $i_id = $instructor->instructor_id;

        $instructorData = $request->validate([
            "instructor_fname" => ['required'],
            "instructor_lname" => ['required'],
            "instructor_bday" => ['required'],
            "instructor_gender" => ['required'],
            "instructor_contactno" => ['required'],
            // "instructor_email" => ['required' , 'email'],
            // "instructor_credentials" => ['required','file'],
        ]);

        $folderName = "{$instructorData['instructor_lname']} {$instructorData['instructor_fname']}";
        $folderName = Str::slug($folderName, '_');
        if($request->hasFile('instructor_credentials')) {
            
            $file = $request->file('instructor_credentials');
            try {
                $fileName = time() . '-' . $file->getClientOriginalName();
                $folderPath = 'instructors/' . $folderName;
                $filePath = $file->storeAs($folderPath, $fileName, 'public');

                $instructorData['instructor_credentials'] = $filePath;

                $instructor->update($instructorData);

                // Storage::putFileAs($folderPath, $file, $fileName);

            } catch (\Exception $e) {
                dd($e->getMessage());
            }

        } else {
            $instructorData['instructor_credentials'] = $instructor->instructor_credentials;

            $instructor->update($instructorData);
        }
        
        return back()->with('message' , 'Data was successfully updated');
    }

    public function destroy_instructor(Instructor $instructor) {
        
        try {

            $relativeFilePath = str_replace('public/', '', $instructor->instructor_credentials);
            if (Storage::disk('public')->exists($relativeFilePath)) {
                // Storage::disk('public')->delete($relativeFilePath);
                $specifiedDir = explode('/', $relativeFilePath);
                array_pop($specifiedDir);

                $dirPath = implode('/', $specifiedDir);

                // dd($dirPath);
                Storage::disk('public')->deleteDirectory($dirPath);
            }
    
            $instructor->delete();
    
            session()->flash('message', 'Instructor deleted Successfully');
            return response()->json(['message' => 'Instructor deleted successfully', 'redirect_url' => "/admin/instructors"]);
            
        
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }


    

// -----------------------admin courses------------------------- 
    public function courses() {
        return $this->search_course();
    }

    public function search_course() {

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

            return view('admin.courses', compact('courses'))
                ->with(['title' => 'Course Management', 'adminCodeName' => $admin_codename]);

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function add_course() {
        if (auth('admin')->check()) {
            $admin = session('admin');
            $admin_codename = $admin['admin_codename'];
    
            $instructors = DB::table('instructor')
                ->select(
                    DB::raw("CONCAT(instructor_fname, ' ', instructor_lname) as name"), 
                    'instructor_id as id'
                )
                ->where('status', '=', 'Approved')
                ->orderBy('instructor_fname', 'ASC')
                ->get();
    
            return view('admin.add_course', [
                'title' => 'Course Management',
                'adminCodeName' => $admin_codename,
                'instructors' => $instructors,
            ]);
        } else {
            return redirect('/admin');
        }
    }
    
    public function store_new_course(Request $request) {
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

            Course::create($courseData);

            session()->flash('message', 'Course created Successfully');
            return response()->json(['message' => 'Course created successfully', 'redirect_url' => '/admin/courses']);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
    
            return response()->json(['errors' => $errors], 422);
        }
    }

    public function view_course($id) {
        if (auth('admin')->check()) {
            $admin = session('admin');
            $admin_codename = $admin['admin_codename'];

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


            } catch (\Exception $e) {
                dd($e->getMessage());
            }

        } else {
            return redirect('/admin');
        }
        return view('admin.view_course', compact('course'), [
            'title' => 'Course Management',
            'adminCodeName' => $admin_codename,
            'instructors' => $instructors,
            'scripts' => ['AD_course_manage.js'],
        ]);

    }

    public function update_course(Course $course, Request $request) {
    
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
            // dd($learnerCourse);
            $learnerCourse->update(['status' => 'Approved']);  

            $courseProgressData = [
                "learner_course_id" => $learnerCourse->learner_course_id,
                "learner_id" => $learnerCourse->learner_id,
                "course_id" => $learnerCourse->course_id
            ];

            // LearnerCourseProgress::create($courseProgressData);
            LearnerCourseProgress::firstOrCreate($courseProgressData);

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
                        ->where('topic_id', $syllabus->topic_id)
                        ->first();

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
                        ->where('topic_id', $syllabus->topic_id)
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
                    ->orderBy('learner_lesson_progress_id','ASC')
                    ->limit(1)
                    ->update(['status' => 'NOT YET STARTED']);
                    break;
                case "QUIZ":
                    DB::table('learner_quiz_progress')
                    ->where('learner_course_id', $learnerCourse->learner_course_id)
                    ->orderBy('learner_lesson_progress_id','ASC')
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

            DB::table('learner_activity_progress')
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
