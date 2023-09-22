<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Learner;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index() {

      
        return view('admin.index')->with('title', 'Eskwela4EveryJuan Admin');
    }

    public function dashboard() {
        return view('admin.dashboard')->with('title', 'Admin Dashboard');
    }



// -------------------admin learner area------------------------
    public function learners() {
        return $this->search_learner();
    }
    
    public function search_learner() {
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
    
            return view('admin.learners', compact('learners'))->with('title', 'Learner Management');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    

    public function add_learner() {
        return view('admin.add_learner')->with('title' , 'Add New Learner');
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
            "learner_username" => ['required'],
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

        return redirect('/admin/learners')->with('title', 'Learner Management')->with('message' , 'Data was successfully stored'); //add with('message') later
    }

    public function view_learner($id) {
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
        ])->with('title', 'View Learner');
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
        return view('admin.instructors')->with('title' , 'Instructor Management');
    }

    public function add_instructor() {
        return view('admin.add_instructor')->with('title' , 'Add New Instructor');
    }

    public function view_instructor () {
        return view('admin.view_instructor')->with('title' , 'View Instructor');
    }
}
