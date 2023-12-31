<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\LearnerCourse;
use App\Models\LessonContents;
use App\Models\ActivityContents;
use App\Models\ActivityContentCriterias;
use App\Models\Syllabus;
use App\Models\Lessons;
use App\Models\Activities;
use App\Models\Quizzes;
use App\Models\LearnerCourseProgress;
use App\Models\LearnerSyllabusProgress;
use App\Models\LearnerLessonProgress;
use App\Models\LearnerActivityProgress;
use App\Models\LearnerQuizProgress;
use App\Models\LearnerActivityOutput;
use App\Models\LearnerActivityCriteriaScore;
use App\Models\QuizContents;
use App\Models\QuizReferences;
use App\Models\Questions;
use App\Models\QuestionAnswers;
use App\Models\LearnerQuizOutputs;
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
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\URL;
use Dompdf\Dompdf;
use App\Http\Controllers\DateTime;

class InstructorDiscussionController extends Controller
{
    public function discussions() {
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            

            try {
                

            } catch (\Exception $e) {
                dd($e->getMessage());
            }

        } else {
            return redirect('/instructor');
        }

        $data = [
            'title' => 'Performance',
            'scripts' => ['instructor_discussion.js'],

        ];

        // dd($data);
        return view('instructor_discussions.instructorDiscussion' , compact('instructor'))
        ->with($data);
    }


    public function createDiscussion() {
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            

            try {
                $courseData = DB::table('course')
                ->select(
                    'course_id',
                    'course_name',
                    'course_code',
                )
                ->where('instructor_id', $instructor->instructor_id)
                ->get();

                
            $data = [
                'title' => 'Performance',
                'scripts' => ['instructor_create_discussion.js'],
                'courses' => $courseData,
            ];

            // dd($data);
            return view('instructor_discussions.instructorCreateThread' , compact('instructor'))
            ->with($data);

            } catch (\Exception $e) {
                dd($e->getMessage());
            }

        } else {
            return redirect('/instructor');
        }
    }
}
