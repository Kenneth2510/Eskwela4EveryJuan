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

class LearnerMessageController extends Controller
{
    public function index() {
        if (session()->has('learner')) {
            $learner= session('learner');
            

            try {
                
            

            $data = [
                'title' => 'Message',
                'scripts' => ['learnerMessage.js'],

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

    public function search_recipient(Request $request) {

        try{
        $searchVal = $request->input('search_recipient');

        $resultData = [];

        $learnerSearch = DB::table('learner')
        ->select(
            'learner_fname',
            'learner_lname',
            'learner_email',
            'profile_picture',
        )
        ->where('learner_email','LIKE', '%' .$searchVal .'%')
        ->get();

        $instructorSearch = DB::table('instructor')
        ->select(
            'instructor_fname',
            'instructor_lname',
            'instructor_email',
            'profile_picture',
        )
        ->where('instructor_email', 'LIKE', '%' .$searchVal .'%')
        ->get();


        foreach ($learnerSearch as $learner) {
            $learnerTemp = [
                "type" => "Learner",
                "fname" => $learner->learner_fname,
                "lname" => $learner->learner_lname,
                "email" => $learner->learner_email,
                "profile" => $learner->profile_picture,
            ];
            array_push($resultData, $learnerTemp);
        }
    
        foreach ($instructorSearch as $instructor) {
            $instructorTemp = [
                "type" => "Instructor",
                "fname" => $instructor->instructor_fname,
                "lname" => $instructor->instructor_lname,
                "email" => $instructor->instructor_email,
                "profile" => $instructor->profile_picture,
            ];
            array_push($resultData, $instructorTemp);
        }


        $data = [
            'title' => 'Search Results',
            'results' => $resultData,
        ];
        

        return response()->json($data);
    } catch (ValidationException $e) {
        $errors = $e->validator->errors();

        return response()->json(['errors' => $errors], 422);
    }

    }

    public function send(Request $request) {
        if (session()->has('learner')) {
            $learner= session('learner');
            
        try{
            // dd($request);
            $subject = $request->input('subject');
            $content = $request->input('content');
            $emailToReceive = json_decode($request->input('emailToReceive'));

            $filesToSend = $request->file('filesToSend');

            $now = Carbon::now();
            $timestampString = $now->toDateTimeString();

            $hasFiles = is_array($filesToSend) && count($filesToSend) > 0 ? 1 : 0;

            $messageContent = MessageContent::create([
                'message_subject' => $subject,
                'message_content' => $content,
                'message_has_file' => $hasFiles,
                'date_updated' => $timestampString,

            ]);

            foreach($emailToReceive as $email) {
                $messageData = Message::create([
                    'message_content_id' => $messageContent->message_content_id,
                    'sender_user_type' => 'Learner',
                    'sender_user_email' => $learner->learner_email,
                    'receiver_user_type' => $email->type,
                    'receiver_user_email' => $email->email,
                    'date_sent' => $timestampString,
                ]);
            }

            $folderName = "Message_$messageContent->message_content_id";
            $folderName = Str::slug($folderName, '_');

            $folderPath = 'message/' . $folderName;

            if(!Storage::exists($folderPath)) { 
                Storage::makeDirectory($folderPath);
            }


            if (!empty($filesToSend)) {
                foreach ($filesToSend as $file) {
                    $filename = time() . '-' . $file->getClientOriginalName();

                    // $file->storeAs('uploads', $filename);
                    $filePath = $file->storeAs($folderPath, $filename, 'public');

                    $rowMessageContentFileData = [
                        'message_id' => $messageData->message_id,
                        'message_content_id' => $messageContent->message_content_id,
                        'message_content_file' => $filePath,
                    ];

                    MessageContentFile::create($rowMessageContentFileData);
                }
            }
            
        $data = [
            'title' => 'Send Message',
            'message' => 'message_sent',
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

    public function getMessages(Request $request) {
            if (session()->has('learner')) {
                $learner= session('learner');
                
            try{

                $searchVal = $request->input('searchVal');

                $messageContentData = DB::table('message_content')
                    ->select(
                        'message_content.message_content_id',
                        'message_content.message_subject',
                        'message_content.message_content',
                        'message_content.message_has_file',
                        'message_content.date_updated',
                        'message.sender_user_type',
                        'message.sender_user_email',
                        'message.date_sent',
                        DB::raw('CASE 
                        WHEN message.sender_user_type = "learner" THEN (SELECT CONCAT(learner_fname, " ", learner_lname) FROM learner WHERE learner_email = message.sender_user_email)
                        WHEN message.sender_user_type = "instructor" THEN (SELECT CONCAT(instructor_fname, " ", instructor_lname) FROM instructor WHERE instructor_email = message.sender_user_email)
                        ELSE NULL
                    END AS sender_name'),
                    DB::raw('CASE 
                        WHEN message.sender_user_type = "learner" THEN (SELECT profile_picture FROM learner WHERE learner_email = message.sender_user_email)
                        WHEN message.sender_user_type = "instructor" THEN (SELECT profile_picture FROM instructor WHERE instructor_email = message.sender_user_email)
                        ELSE NULL
                    END AS sender_profile_picture'),
                    )
                    ->join('message', 'message.message_content_id', 'message_content.message_content_id')
                    ->where(function($query) use ($learner, $searchVal) {
                        $query->where('message.sender_user_email', $learner->learner_email)
                            ->orWhere('message.receiver_user_email', $learner->learner_email)
                            ->where(function($query) use ($searchVal) {
                                $query->where('message.sender_user_email', 'LIKE', '%'. $searchVal . '%')
                                    ->orWhere('message.receiver_user_email', 'LIKE', '%'. $searchVal . '%')
                                    ->orWhere('message_content.message_subject', 'LIKE', '%'. $searchVal . '%')
                                    ->orWhere('message.date_sent', 'LIKE', '%'. $searchVal . '%');
                            });
                    })
                    ->orderBy('message_content.date_updated', 'DESC')
                    ->distinct()
                    ->get();

                foreach ($messageContentData as $messageContent) {
                    $messageContent->messages = DB::table('message')
                        ->select(
                            'message.message_id',
                            'message.date_sent',
                            'message.isRead',
                            'message.date_read',

                            DB::raw('CASE 
                                WHEN message.receiver_user_type = "learner" THEN (SELECT CONCAT(learner_fname, " ", learner_lname) FROM learner WHERE learner_email = message.receiver_user_email)
                                WHEN message.receiver_user_type = "instructor" THEN (SELECT CONCAT(instructor_fname, " ", instructor_lname) FROM instructor WHERE instructor_email = message.receiver_user_email)
                                ELSE NULL
                            END AS receiver_name'),
                            DB::raw('CASE 
                                WHEN message.receiver_user_type = "learner" THEN (SELECT profile_picture FROM learner WHERE learner_email = message.receiver_user_email)
                                WHEN message.receiver_user_type = "instructor" THEN (SELECT profile_picture FROM instructor WHERE instructor_email = message.receiver_user_email)
                                ELSE NULL
                            END AS receiver_profile_picture')
                        )
                        ->where('message.message_content_id', $messageContent->message_content_id)
                        ->orderBy('message.date_sent', 'DESC')
                        ->get();

                        foreach($messageContent->messages as $messageDetails) {
                            $messageDetails->replies = DB::table('message_reply')
                            ->select(
                                'message_reply_id',
                                'message_content_id',
                                'date_sent',
                                'isRead',
                                'date_read',
                            )
                            ->where('message_content_id', $messageContent->message_content_id)
                            ->orderBy('date_sent', 'DESC')
                            ->get();
                        }


                }


            
                
            $data = [
                'title' => 'Get all Message',
                'learner' => $learner,
                'messageData' => $messageContentData,
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

    public function getSelectedMessage(Request $request) {
        if (session()->has('learner')) {
            $learner= session('learner');
            
        try{

            $messageContentID = $request->input('messageContent');

            $messageContentData = DB::table('message_content')
                ->select(
                    'message_content.message_content_id',
                    'message_content.message_subject',
                    'message_content.message_content',
                    'message_content.message_has_file',
                    'message.sender_user_type',
                    'message.sender_user_email',
                    'message.date_sent',
                    DB::raw('CASE 
                    WHEN message.sender_user_type = "learner" THEN (SELECT CONCAT(learner_fname, " ", learner_lname) FROM learner WHERE learner_email = message.sender_user_email)
                    WHEN message.sender_user_type = "instructor" THEN (SELECT CONCAT(instructor_fname, " ", instructor_lname) FROM instructor WHERE instructor_email = message.sender_user_email)
                    ELSE NULL
                END AS sender_name'),
                DB::raw('CASE 
                    WHEN message.sender_user_type = "learner" THEN (SELECT profile_picture FROM learner WHERE learner_email = message.sender_user_email)
                    WHEN message.sender_user_type = "instructor" THEN (SELECT profile_picture FROM instructor WHERE instructor_email = message.sender_user_email)
                    ELSE NULL
                END AS sender_profile_picture'),
                )
                ->join('message', 'message.message_content_id', 'message_content.message_content_id')
                ->where('message_content.message_content_id', $messageContentID)
                ->first();

                $messageContentData->messages = DB::table('message')
                    ->select(
                        'message.message_id',
                        'message.date_sent',
                        'message.isRead',
                        'message.date_read',
                        'message.receiver_user_type',
                        'message.receiver_user_email',
                        DB::raw('CASE 
                            WHEN message.receiver_user_type = "learner" THEN (SELECT CONCAT(learner_fname, " ", learner_lname) FROM learner WHERE learner_email = message.receiver_user_email)
                            WHEN message.receiver_user_type = "instructor" THEN (SELECT CONCAT(instructor_fname, " ", instructor_lname) FROM instructor WHERE instructor_email = message.receiver_user_email)
                            ELSE NULL
                        END AS receiver_name'),
                        DB::raw('CASE 
                            WHEN message.receiver_user_type = "learner" THEN (SELECT profile_picture FROM learner WHERE learner_email = message.receiver_user_email)
                            WHEN message.receiver_user_type = "instructor" THEN (SELECT profile_picture FROM instructor WHERE instructor_email = message.receiver_user_email)
                            ELSE NULL
                        END AS receiver_profile_picture')
                    )
                    ->where('message.message_content_id', $messageContentData->message_content_id)
                    ->orderBy('message.date_sent', 'DESC')
                    ->get();

                
                    foreach($messageContentData->messages as $messageDetails) {
                        $messageDetails->replies = DB::table('message_reply')
                        ->select(
                            'message_reply_id',
                            'message_content_id',
                            'date_sent',
                            'isRead',
                            'date_read',
                        )
                        ->where('message_content_id', $messageContentData->message_content_id)
                        ->orderBy('date_sent', 'DESC')
                        ->get();


                    //     foreach ($messageDetails->replies as $reply) {
                    //         $reply->replyContent = DB::table('message_reply_content')
                    //             ->select(
                    //                 'message_reply_content_id',
                    //                 'message_reply_id',
                    //                 'message_id',
                    //                 'message_reply_content',
                    //                 'message_has_file'
                    //             )
                    //             ->where('message_reply_id', $reply->message_reply_id)
                    //             ->get();
                        
                    //         $replyData = $reply->replyContent;
                        
                    //         foreach ($replyData as $replyItem) {
                    //             if ($replyItem->message_has_file === 1) {
                    //                 $replyItem->fileContents = DB::table('message_reply_content_file')
                    //                     ->select(
                    //                         'message_reply_content_file'
                    //                     )
                    //                     ->where('message_reply_content_id', $replyItem->message_reply_content_id)
                    //                     ->get();
                    //             }
                    //         }
                    //     }
                        
                    }
            
            if($messageContentData->message_has_file === 1) {
                $messageContentData->files = DB::table('message_content_file')
                ->select(
                    'message_content_file'
                )
                ->where('message_content_id', $messageContentData->message_content_id)
                ->get();
            }


            $replyData = DB::table('message_reply')
            ->select(
                'message_reply.message_reply_id',
                'message_reply.message_content_id',
                'message_reply.reply_user_type',
                'message_reply.reply_user_email',
                'message_reply.date_sent',
                'message_reply.isRead',
                'message_reply.date_read',
                'message_reply_content.message_reply_content_id',
                'message_reply_content.message_has_file',
                'message_reply_content.message_reply_content',
                DB::raw('CASE 
                    WHEN message_reply.reply_user_type = "learner" THEN (SELECT CONCAT(learner_fname, " ", learner_lname) FROM learner WHERE learner_email = message_reply.reply_user_email)
                    WHEN message_reply.reply_user_type = "instructor" THEN (SELECT CONCAT(instructor_fname, " ", instructor_lname) FROM instructor WHERE instructor_email = message_reply.reply_user_email)
                    ELSE NULL
                END AS reply_name'),
                DB::raw('CASE 
                    WHEN message_reply.reply_user_type = "learner" THEN (SELECT profile_picture FROM learner WHERE learner_email = message_reply.reply_user_email)
                    WHEN message_reply.reply_user_type = "instructor" THEN (SELECT profile_picture FROM instructor WHERE instructor_email = message_reply.reply_user_email)
                    ELSE NULL
                END AS reply_profile_picture')
            )
            ->join('message_reply_content', 'message_reply.message_reply_id', '=', 'message_reply_content.message_reply_id')
            ->where('message_reply.message_content_id', $messageContentID)
            ->orderBy('date_sent', 'asc')
            ->get();
        
        foreach ($replyData as $reply) {
            if ($reply->message_has_file === 1) {
                $reply->fileContents = DB::table('message_reply_content_file')
                    ->select(
                        'message_reply_content_file'
                    )
                    ->where('message_reply_content_id', $reply->message_reply_content_id)
                    ->get();
            } else {
                $reply->fileContents = [];
            }
        }


        $data = [
            'title' => 'View Selected Message',
            'learner' => $learner,
            'messageData' => $messageContentData,
            'replyData' => $replyData
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


    public function reply(Request $request) {
        if (session()->has('learner')) {
            $learner= session('learner');
            
        try{
            $message_content_id = $request->input('messageContentID');
            $content = $request->input('content');

            $filesToSend = $request->file('filesToSend');

            $now = Carbon::now();
            $timestampString = $now->toDateTimeString();

            $hasFiles = is_array($filesToSend) && count($filesToSend) > 0 ? 1 : 0;

            $messageReply = MessageReply::create([
                'message_content_id' => $message_content_id,
                'reply_user_type' => 'Learner',
                'reply_user_email' => $learner->learner_email,
                'date_sent' => $timestampString
            ]);
            
            $messageReplyContent = MessageReplyContent::create([
                'message_reply_id' => $messageReply->message_reply_id,
                'message_reply_content' => $content,
                'message_has_file' => $hasFiles,

            ]);

            DB::table('message_content')
            ->where('message_content_id', $message_content_id)
            ->update([
                'date_updated' => $timestampString
            ]);

            $folderName = "Message_$message_content_id";
            $folderName = Str::slug($folderName, '_');

            $folderPath = 'message/' . $folderName;

            if(!Storage::exists($folderPath)) { 
                Storage::makeDirectory($folderPath);
            }


            if (!empty($filesToSend)) {
                foreach ($filesToSend as $file) {
                    $filename = time() . '-' . $file->getClientOriginalName();

                    // $file->storeAs('uploads', $filename);
                    $filePath = $file->storeAs($folderPath, $filename, 'public');

                    $rowMessageContentFileData = [
                        'message_reply_id' => $messageReply->message_reply_id,
                        'message_reply_content_id' => $messageReplyContent->message_reply_content_id,
                        'message_reply_content_file' => $filePath,
                    ];

                    MessageReplyContentFile::create($rowMessageContentFileData);
                }
            }
            
        $data = [
            'title' => 'Send Message',
            'message' => 'message_sent',
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
}
