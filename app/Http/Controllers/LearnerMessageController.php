<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LearnerMessageController extends Controller
{
    public function index() {
        if (session()->has('learner')) {
            $learner= session('learner');
            

            try {
                
            


            $data = [
                'title' => 'Message',
                'scripts' => ['learner_discussion.js'],

            ];

            // dd($data);
            return view('learner_message.message' , compact('learner'))
            ->with($data);

            } catch (\Exception $e) {
                dd($e->getMessage());
            }

        } else {
            return redirect('/learner');
        }

    }
}
