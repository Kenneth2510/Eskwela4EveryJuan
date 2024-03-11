<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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

class ChatBotController extends Controller
{

    public function get_pdf_files($directory){

        $files = Storage::files($directory);
    
        $pdfFiles = collect($files)->filter(function ($file) {
            return pathinfo($file, PATHINFO_EXTENSION) === 'pdf';
        })->values()->all();
    
        $subDirectories = Storage::directories($directory);
    
        foreach ($subDirectories as $subDirectory) {
            $pdfFiles = array_merge($pdfFiles, $this->get_pdf_files($subDirectory));
        }
    
        return $pdfFiles;
    }



    public function index($session_id) {


        if(!$session_id) {
            $learner= session('learner');
            $session_id = $learner->learner_id;
        }
        $directory = 'public/courses';
        $files = $this->get_pdf_files($directory);
    
        // Create a Guzzle HTTP client instance
        $client = new Client();
    
        foreach ($files as $file) {
            $filePath = Storage::path($file);
            $fileName = pathinfo($file, PATHINFO_BASENAME);
    
            // Send the PDF file to the Flask application
            // $response = $client->request('POST', "http://127.0.0.1:5000/add_file/$session_id", [
            //     'multipart' => [
            //         [
            //             'name'     => 'files',
            //             'contents' => fopen($filePath, 'r'),
            //             'filename' => $fileName,
            //         ],
            //     ],
            // ]);

            
            //     Send the PDF file to the Flask application
            $response = $client->request('POST', "https://eskwela4everyjuanchatbot-e5285e41c4cf.herokuapp.com/add_file/$session_id", [
                'multipart' => [
                    [
                        'name'     => 'files',
                        'contents' => fopen($filePath, 'r'),
                        'filename' => $fileName,
                    ],
                ],
            ]);
            // Output the response for debugging
            echo $response->getBody();
        }
    }


    public function get_learner_pdf_files($directory){

        $files = Storage::files($directory);
    
        $pdfFiles = collect($files)->filter(function ($file) {
            return pathinfo($file, PATHINFO_EXTENSION) === 'pdf';
        })->values()->all();
    
        $subDirectories = Storage::directories($directory);
    
        foreach ($subDirectories as $subDirectory) {
            $pdfFiles = array_merge($pdfFiles, $this->get_pdf_files($subDirectory));
        }
    
        return $pdfFiles;
    }



    public function learner($session_id) {

        $learnerData = DB::table('learner')
        ->select(
            'learner_id',
            'learner_fname',
            'learner_lname',
        )
        ->where('learner_id', $session_id)
        ->first();

        $filePath = "$learnerData->learner_lname $learnerData->learner_fname";
        $folderName = Str::slug($filePath, '_');

        if(!$session_id) {
            $learner= session('learner');
            $session_id = $learner->learner_id;
        }
        $directory = "public/learners/$folderName";
        $files = $this->get_pdf_files($directory);
    
        // dd($files);
        // Create a Guzzle HTTP client instance
        $client = new Client();
    
        foreach ($files as $file) {
            $filePath = Storage::path($file);
            $fileName = pathinfo($file, PATHINFO_BASENAME);
    
            // Send the PDF file to the Flask application
            $response = $client->request('POST', "https://eskwela4everyjuanchatbot-e5285e41c4cf.herokuapp.com/add_file/$session_id", [
                'multipart' => [
                    [
                        'name'     => 'files',
                        'contents' => fopen($filePath, 'r'),
                        'filename' => $fileName,
                    ],
                ],
            ]);
    
            // Output the response for debugging
            echo $response->getBody();
        }

    }


    public function process($session_id) {
                // Create a Guzzle HTTP client instance
                $client = new Client();
    
                try {
                    // Send the reset request to the Flask application
                    $response = $client->request('GET', "https://eskwela4everyjuanchatbot-e5285e41c4cf.herokuapp.com/process_session/$session_id");
            
                    // Output the response for debugging
                    echo $response->getBody();
                } catch (\Exception $e) {
                    // Output any errors that occur
                    echo "Error resetting session $session_id: " . $e->getMessage();
                }
    }


    public function reset($session_id) {
        // Create a Guzzle HTTP client instance
        $client = new Client();
    
        try {
            // Send the reset request to the Flask application
            $response = $client->request('POST', "https://eskwela4everyjuanchatbot-e5285e41c4cf.herokuapp.com/reset/$session_id");
    
            // Output the response for debugging
            echo $response->getBody();
        } catch (\Exception $e) {
            // Output any errors that occur
            echo "Error resetting session $session_id: " . $e->getMessage();
        }
    }

    
    
    public function chat($session_id, Request $request) {
    // Get the user's message from the request
    $user_message = $request->input('question', '');
    $course = $request->input('course', '');
    $lesson = $request->input('lesson', '');

    // Create a Guzzle HTTP client instance
    $client = new Client();

    try {
        // Send the chat request to the Flask application
        $response = $client->request('POST', "https://eskwela4everyjuanchatbot-e5285e41c4cf.herokuapp.com/chat/$session_id", [
            'json' => [
                'question' => $user_message,
                'course' => $course,
                'lesson' => $lesson,
            ]
        ]);

        // Get the AI's response from the response body
        $ai_response = json_decode($response->getBody(), true);

        // Return the AI's response
        return response()->json(['message' => $ai_response['message']]);
    } catch (\Exception $e) {
        // Output any errors that occur
        return response()->json(['error' => "Error processing message: " . $e->getMessage()], 500);
    }
}
    
    

public function courseData(Course $course) {
    $courseData = DB::table('course')
    ->select(
        'course_name',
    )
    ->where('course_id', $course->course_id)
    ->first();
    
    return response()->json([
        'course' => $courseData,
    ]);
}


public function syllabusData(Course $course, Syllabus $syllabus) {
    $syllabusData = DB::table('syllabus')
    ->select(
        'topic_title',
        'category',
    )
    ->where('course_id', $course->course_id)
    ->where('syllabus_id', $syllabus->syllabus_id)
    ->first();
    
    return response()->json([
        'syllabus' => $syllabusData,
    ]);
}


}
