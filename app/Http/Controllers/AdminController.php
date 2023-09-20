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

    public function learners() {

        $data = array("learners" => DB::table('learner')->orderBy('created_at' , 'DESC')->paginate(10));

        return view('admin.learners' , $data)->with('title', 'Learner Management');
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

        return redirect('/admin/learners')->with('title', 'Learner Management'); //add with('message') later
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
        // dd($id);

        try {
            $learner->update(['status' => 'Approved']);  
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        // $learner = Learner::where('learner_id', $id)->first();
        // dd($learner);
        // if ($learner) {
        //     $learner->update(['status' => 'Approved']);
        // }
        
        return redirect()->back();
    }

    public function rejectLearner(Learner $learner)
    {
        try {
            $learner->update(['status' => 'Rejected']);  
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        return redirect()->back();
    }

    public function pendingLearner(Learner $learner)
    {
        try {
            $learner->update(['status' => 'Rejected']);  
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        return redirect()->back();
    }

    public function update_learner(Request $request, Learner $learner) {
        // dd($request);
        // dd($learner);

        $l_id = $learner->learner_id;

        // DB::update("UPDATE learner
        //             SET learner_fname = 'sample22'
        //             WHERE learner_id = 38");

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

        // $LearnerData = array_merge($LearnerPersonalData , $LearnerLoginData);
        // $learner->update($LearnerData);

        // $learner->update($LearnerPersonalData);

        return back(); //add ->with('message') later
    }

    public function destroy_learner(Learner $learner) {
        // dd($learner);

        $learner->delete();


        return redirect('/admin/learner'); //add with message later
    }

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
