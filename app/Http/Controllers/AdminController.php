<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Learner;
use App\Models\Instructor;
use App\Models\Admin;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\Support\Facades\Log;

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
    
            return view('admin.learners', compact('learners'))->with(['title' => 'Learner Management', 'adminCodeName' => $admin_codename]);
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
            "learner_password" => 'required|confirmed',
            "learner_security_code" => ['required' , 'max:6'],
        ]);

        

        $LearnerData = array_merge($LearnerPersonalData , $LearnerLoginData);
        $LearnerData['learner_password'] = bcrypt($LearnerData['learner_password']);

        Learner::create($LearnerData);

        $latestStudent = DB::table('learner')->orderBy('created_at', 'DESC')->first();

        $latestStudentId = $latestStudent->learner_id;

        $businessData['learner_id'] = $latestStudentId;

        Business::create($businessData);

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
        ])->with(['title' => 'View Learner', 'adminCodeName' => $admin_codename]);
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

        $learner->delete();


        return redirect('/admin/learners')->with('message' , 'Data was successfully deleted'); //add with message later
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
                "instructor_security_code" => ['required'],
                "instructor_credentials" => ['required', 'file'],
            ]);

            $instructorData['instructor_credentials'] = '';
            $instructorData['password'] = bcrypt($instructorData['password']);
        
            $folderName = "{$instructorData['instructor_lname']} {$instructorData['instructor_fname']}";

            if($request->hasFile('instructor_credentials')) {
                
                $file = $request->file('instructor_credentials');
                
                try {

                $fileName = time() . '-' . $file->getClientOriginalName();
                $folderPath = 'instructors/' . $folderName;
                $filePath = $file->storeAs($folderPath, $fileName, 'public');

                // add to database
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
            return view('admin.view_instructor', ['instructor' => $instructorData])->with(['title' => 'View Instructor', 'adminCodeName' => $admin_codename]);
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
            "instructor_credentials" => ['required','file'],
        ]);

        $folderName = "{$instructorData['instructor_lname']} {$instructorData['instructor_fname']}";

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
    
            return redirect('/admin/instructors')->with('message', 'Data and associated file were successfully deleted');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    
}
