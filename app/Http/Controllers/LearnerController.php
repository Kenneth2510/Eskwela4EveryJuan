<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Learner;
use Illuminate\Support\Facades\Hash;

class LearnerController extends Controller
{
    public function index() {

        if (auth('learner')->check()) {
            $learner = session('learner');
            // return redirect('/instructor/dashboard')->with('title', 'Instructor Dashboard');
            return back();
        } else {
        return view('learner.login')->with('title', 'Learner Login');
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

            // $request->session()->regenerate();
            return redirect('/learner/dashboard')->with('message', 'Authenticated Successfully');
        } 

        return back()->withErrors(['security_code' => 'Invalid Security Code']);
    }


    public function logout(Request $request) {
        auth('learner')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/learner')->with('message', 'Logout Successful');

    }

    public function register(){
        return view('learner.register')->with('title', 'Learner Register');
    }

    public function dashboard() {
        if (auth('learner')->check()) {
            $learner = session('learner');
        } else {
            return redirect('/learner');
        }

        return view('learner.dashboard')->with('title', 'Learner Dashboard');
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
        return view('learner.settings', compact('learner', 'business'))->with('title', 'Learner Settings');
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
    
}
