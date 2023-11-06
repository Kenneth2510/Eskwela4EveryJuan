<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Learner;
use App\Models\Instructor;
use App\Models\Admin;
use App\Models\Course;
use App\Models\LearnerCourse;
use App\Models\LessonContents;
use App\Models\Syllabus;
use App\Models\Lessons;
use App\Models\Activities;
use App\Models\Quizzes;
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

class InstructorCourseController extends Controller
{
    public function courses(){
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            

            try {
                $query = DB::table('course')
                    ->select(
                        "course.course_id",
                        "course.course_name",
                        "course.course_code",
                        "instructor.instructor_lname",
                        "instructor.instructor_fname",
                        "instructor.profile_picture"
                    )
                ->where('course.instructor_id', '=', $instructor['instructor_id'])
                ->join('instructor', 'instructor.instructor_id', '=', 'course.instructor_id')
                ->orderBy("course.created_at", "ASC");

                $courses = $query->paginate(50);
                    // $courses = $query;
            } catch (\Exception $e) {
                dd($e->getMessage());
            }

        } else {
            return redirect('/instructor');
        }

        return view('instructor_course.courses' , compact('instructor', 'courses'))->with('title', 'My Courses');
    }

    
    public function courseCreate(){
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            // dd($instructor);

            // $color = '#' . Str::random(6);
            // dd($color);

        } else {
            return redirect('/instructor');
        }
        return view('instructor_course.coursesCreate', compact('instructor'))
        ->with(['title' => 'Creeate Course',
                'scripts' => ['instructor_course_create.js']]);
        
    }

    public function courseCreate_process(Request $request) {
        $instructor = session('instructor');

        if($instructor['status'] !== 'Approved') {
            session()->flash('message', 'Account is not yet Approved');
            return response()->json(['message' => 'Account is not yet Approved', 'redirect_url' => '/instructor/courses']);
        } else {
            try {
                $courseData = $request->validate([
                    'course_name' => ['required'],
                    'course_description' => ['required'],
                    'course_difficulty' => ['required'],
                ]);

                $courseData['course_code'] = Str::random(6);
                $courseData['instructor_id'] = $instructor['instructor_id'];
    
                
                $course = Course::create($courseData);
                
                $folderName = $course->course_id . ' ' . $courseData['course_name'];
                $folderPath = 'public/courses/' . $folderName;
    
                if(!Storage::exists($folderPath)) {
                    Storage::makeDirectory($folderPath);
                }

       
                // $latestCourse = DB::table('course')->orderBy('created_at', 'DESC')->first();
                // $latestCourseID = $latestCourse->course_id;
    
                session()->flash('message', 'Course created Successfully');

                $response = [
                    'message' => 'Course created successfully',
                    'redirect_url' => '/instructor/courses',
                    'course_id' => $course->course_id,
                ];
        
                return response()->json($response);


                // return response()->json(['message' => 'Course created successfully', 'redirect_url' => '/instructor/courses']);
            } catch (ValidationException $e) {
                $errors = $e->validator->errors();
        
                return response()->json(['errors' => $errors], 422);
            }
        }
    }


    
    public function overview(Course $course){
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            // dd($instructor);

            try {
                $course = DB::table('course')
                ->where('course_id', $course->course_id)
                ->first();

            } catch (\Exception $e) {
                dd($e->getMessage());
            }

        } else {
            return redirect('/instructor');
        }

        return view('instructor_course.courseOverview', compact('course'))
        ->with([
            'title' => 'Course Overview',
            'scripts' => ['instructor_course_manage.js'],
        ]
        );
    }

    public function manage_course(Request $request, Course $course) {
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            // dd($instructor);

            try {

                $search_by = $request->input('searchBy');
                $search_val = $request->input('searchVal');

                $filter_date = $request->input('filterDate');
                $filter_status = $request->input('filterStatus');

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
            return redirect('/instructor');
        }

        $response = [
            'course' => $course,
            'enrollees'=> $enrollees,
            'filterDate' => $filter_date,
            'filterStatus' => $filter_status,
            'searchBy' => $search_by,
            'searchVal' => $search_val,
        ];

        return response()->json($response);
    }



    public function update_course(Course $course, Request $request) {
        $instructor = session('instructor');

        if($instructor['status'] !== 'Approved') {
            session()->flash('message', 'Account is not yet Approved');
            return response()->json(['message' => 'Account is not yet Approved', 'redirect_url' => '/instructor/courses']);
        } else {
            try {
                $courseData = $request->validate([
                    'course_name' => ['required'],
                    'course_description' => ['required'],
                    'course_difficulty' => ['required'],
                ]);

                $course->update($courseData);

                session()->flash('message', 'Course updated Successfully');
                return response()->json(['message' => 'Course updated successfully', 'redirect_url' => "/instructor/course/$course->course_id"]);
                
            
            } catch (ValidationException $e) {
                // dd($e->getMessage());
                $errors = $e->validator->errors();        
                return response()->json(['errors' => $errors], 422);
            }
        }
    }

    public function delete_course(Course $course) {
        $instructor = session('instructor');

        if($instructor['status'] !== 'Approved') {
            session()->flash('message', 'Account is not yet Approved');
            return response()->json(['message' => 'Account is not yet Approved', 'redirect_url' => '/instructor/courses']);
        } else {
            try {
                $course->delete();


                session()->flash('message', 'Course deleted Successfully');
                return response()->json(['message' => 'Course deleted successfully', 'redirect_url' => "/instructor/courses"]);
                
            
            } catch (ValidationException $e) {
                // dd($e->getMessage());
                $errors = $e->validator->errors();        
                return response()->json(['errors' => $errors], 422);
            }
        }
    }

    public function create_syllabus(Request $request) {
        $syllabusData = $request->validate([
            'course_id' => ['required'],
            'topic_id' => ['required'],
            'topic_title'=> ['required'],
            'category'=> ['required'],
        ]);

        $syllabus = Syllabus::create($syllabusData);

        if($syllabusData['category'] == 'LESSON') {

            $lessonData = [
                'syllabus_id'=> $syllabus->syllabus_id,
                'course_id' => $syllabus->course_id,
                'topic_id' => $syllabus->topic_id,
                'lesson_title' => $syllabus->topic_title,
            ];

            $lesson = Lessons::create($lessonData);

        } else if($syllabusData['category'] == 'ACTIVITY') {
            $activityData = [
                'syllabus_id'=> $syllabus->syllabus_id,
                'course_id' => $syllabus->course_id,
                'topic_id' => $syllabus->topic_id,
                'activity_title' => $syllabus->topic_title,
            ];

            $activity = Activities::create($activityData);
        } else {
            $quizData = [
                'syllabus_id'=> $syllabus->syllabus_id,
                'course_id' => $syllabus->course_id,
                'topic_id' => $syllabus->topic_id,
                'quiz_title' => $syllabus->topic_title,
            ];

            $quiz = Quizzes::create($quizData);
        }

       
        // $latestSyllabus = DB::table('syllabus')->orderBy('created_at', 'DESC')->first();

        session()->flash('message', 'Syllabus created Successfully');

        $response = [
            'message' => 'Syllabus created successfully',
            'redirect_url' => '/instructor/courses',
            'syllabus' => $syllabus->syllabus_id,
        ];

        return response()->json($response);
    }


    public function display_course_syllabus_view(Course $course) {
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            
            $instructor = session('instructor');
            if($instructor['status'] !== 'Approved') {
                session()->flash('message', 'Account is not yet Approved');
                return response()->json(['message' => 'Account is not yet Approved', 'redirect_url' => '/instructor/courses']);
            } else {
                try {

                    if (!function_exists('getRandomColor')) {
                        function getRandomColor() {
                        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                        }
                    }
                    
                    // Generate a random color for mainBackgroundCol
                    $mainBackgroundCol = getRandomColor();
        
                    // Darken the mainBackgroundCol
                    $mainColorRGB = sscanf($mainBackgroundCol, "#%02x%02x%02x");
                    $mainBackgroundCol = sprintf("#%02x%02x%02x", $mainColorRGB[0] * 0.6, $mainColorRGB[1] * 0.6, $mainColorRGB[2] * 0.6);
        
                    // Darken the mainBackgroundCol further for darkenedColor
                    $darkenedColor = sprintf("#%02x%02x%02x", $mainColorRGB[0] * 0.4, $mainColorRGB[1] * 0.4, $mainColorRGB[2] * 0.4);
                    


                    $response = $this->course_content($course);

                    return view('instructor_course.courseContent', compact('instructor'))->with([
                        'title' => 'Course Content',
                        'scripts' => ['instructor_course_content_syllabus.js'],
                        'lessonCount' => $response['lessonCount'],
                        'activityCount' => $response['activityCount'],
                        'quizCount' => $response['quizCount'],
                        'course' => $response['course'],
                        'syllabus' => $response['syllabus'],
                        'mainBackgroundCol' => $mainBackgroundCol,
                        'darkenedColor' => $darkenedColor,
                        // 'instructor' => $response['instructor'],
                    ]);

                } catch (ValidationException $e) {
                    $errors = $e->validator->errors();
            
                    return response()->json(['errors' => $errors], 422);
                }
            }
        } else {
            return redirect('/instructor');
        }
    }
    public function course_content_json (Course $course) {
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            
        if($instructor['status'] !== 'Approved') {
            session()->flash('message', 'Account is not yet Approved');
            return response()->json(['message' => 'Account is not yet Approved', 'redirect_url' => '/instructor/courses']);
        } else {
            try {
                $response = $this->course_content($course);


                $data = [    
                'title' => 'Course Content',
                'scripts' => ['instructor_course_content_syllabus.js'],
                'lessonCount' => $response['lessonCount'],
                'activityCount' => $response['activityCount'],
                'quizCount' => $response['quizCount'],
                'course' => $response['course'],
                'syllabus' => $response['syllabus'],
                ];

                return response()->json($data);

            } catch (ValidationException $e) {
                $errors = $e->validator->errors();
        
                return response()->json(['errors' => $errors], 422);
            }
        }
    } else {
        return redirect('/instructor');
    }
    }
    public function course_content(Course $course) {
        $instructor = session('instructor');
        if($instructor['status'] !== 'Approved') {
            session()->flash('message', 'Account is not yet Approved');
            return response()->json(['message' => 'Account is not yet Approved', 'redirect_url' => '/instructor/courses']);
        } else {
            try {
                $course = DB::table('course')
                ->select(
                    "course.course_id",
                    "course.course_name",
                    "course.course_code",
                    "course.course_description",
                    "course.course_status",
                    "course.course_difficulty",
                    "course.instructor_id",
                    "instructor.instructor_fname",
                    "instructor.instructor_lname",
                    "instructor.profile_picture",
                )
                ->join('instructor', 'instructor.instructor_id', '=', 'course.instructor_id')
                ->where('course_id', $course->course_id)
                ->first();

                $syllabus = DB::table('syllabus')
                ->select(
                    "syllabus_id",
                    "topic_id",
                    "topic_title",
                    "category"
                )
                ->where('course_id', $course->course_id)
                ->orderBy('topic_id', 'ASC')
                ->get();

                $lessonCount = 0;
                $quizCount = 0;
                $activityCount = 0;

                foreach($syllabus as $topic) {
                    if($topic->category == 'LESSON') {
                        $lessonCount++;
                    } else if($topic->category == 'ACTIVITY') {
                        $activityCount++;
                    } else {
                        $quizCount++;
                    }
                }


                $data = [
                    'course' => $course,
                    'syllabus' => $syllabus,
                    'lessonCount' => $lessonCount,
                    'quizCount' => $quizCount,
                    'activityCount' => $activityCount,
                    'instructor' => $instructor,
                ];

                return $data;

                // return view('instructor_course.courseContent', compact('instructor', 'course', 'syllabus'))->with([
                //     'title' => 'Course Content',
                //     'scripts' => ['instructor_course_content_syllabus.js'],
                //     'lessonCount' => $lessonCount,
                //     'activityCount' => $activityCount,
                //     'quizCount' => $quizCount,
                // ]);
            } catch (ValidationException $e) {
                $errors = $e->validator->errors();
        
                return response()->json(['errors' => $errors], 422);
            }
        }
    }

    public function update_syllabus(Course $course, Request $request) {

        try {

            $syllabusData = $request->validate([
                'topic_id' => ['required'],
                'topic_title' => ['required'],
                'category' => ['required'],
            ]);

            Syllabus::where('syllabus_id', $request->input('syllabus_id'))
                        ->where('course_id', $course->course_id)
                        ->update($syllabusData);

            $syllabus = DB::table('syllabus')
                        ->select(
                            'syllabus_id',
                            'course_id',
                            'topic_id',
                            'topic_title',
                            'category'
                        )
                        ->where('syllabus_id', $request->input('syllabus_id'))
                        ->where('course_id', $course->course_id)
                        ->first();

             if($syllabusData['category'] == 'LESSON') {

            $lessonData = [
                'syllabus_id'=> $syllabus->syllabus_id,
                'course_id' => $syllabus->course_id,
                'topic_id' => $syllabus->topic_id,
                'lesson_title' => $syllabus->topic_title,
            ];

            // $lesson = Lessons::create($lessonData);

            $lesson = Lessons::where('syllabus_id', $request->input('syllabus_id'))
                        ->where('course_id', $course->course_id)
                        ->update($lessonData);

        } else if($syllabusData['category'] == 'ACTIVITY') {
            $activityData = [
                'syllabus_id'=> $syllabus->syllabus_id,
                'course_id' => $syllabus->course_id,
                'topic_id' => $syllabus->topic_id,
                'activity_title' => $syllabus->topic_title,
            ];

            // $activity = Activities::create($activityData);

            $activity = Activities::where('syllabus_id', $request->input('syllabus_id'))
                        ->where('course_id', $course->course_id)
                        ->update($activityData);
        } else {
            $quizData = [
                'syllabus_id'=> $syllabus->syllabus_id,
                'course_id' => $syllabus->course_id,
                'topic_id' => $syllabus->topic_id,
                'quiz_title' => $syllabus->topic_title,
            ];

            // $quiz = Quizzes::create($quizData);

            $quiz = Quizzes::where('syllabus_id', $request->input('syllabus_id'))
                        ->where('course_id', $course->course_id)
                        ->update($quizData);
        }

            session()->flash('message', 'Syllabus updated Successfully');
            return response()->json(['message' => 'Course updated successfully', 'redirect_url' => "/instructor/course/content/$course->course_id"]);
                        
                    
            } catch (ValidationException $e) {
                // dd($e->getMessage());
                $errors = $e->validator->errors();        
                return response()->json(['errors' => $errors], 422);
            }
    }

    public function update_syllabus_add_new(Course $course, Request $request) {
        try {
            $syllabusData = $request->validate([
                'topic_id' => ['required'],
                'topic_title' => ['required'],
                'category' => ['required'],
            ]);
    
            $syllabus = Syllabus::create([
                'topic_id' => $syllabusData['topic_id'],
                'topic_title' => $syllabusData['topic_title'],
                'category' => $syllabusData['category'],
                'course_id' => $course->course_id,
            ]);
    
            if ($syllabusData['category'] == 'LESSON') {
                Lessons::create([
                    'syllabus_id' => $syllabus->syllabus_id,
                    'course_id' => $syllabus->course_id,
                    'topic_id' => $syllabus->topic_id,
                    'lesson_title' => $syllabus->topic_title,
                ]);
            } elseif ($syllabusData['category'] == 'ACTIVITY') {
                Activities::create([
                    'syllabus_id' => $syllabus->syllabus_id,
                    'course_id' => $syllabus->course_id,
                    'topic_id' => $syllabus->topic_id,
                    'activity_title' => $syllabus->topic_title,
                ]);
            } else {
                Quizzes::create([
                    'syllabus_id' => $syllabus->syllabus_id,
                    'course_id' => $syllabus->course_id,
                    'topic_id' => $syllabus->topic_id,
                    'quiz_title' => $syllabus->topic_title,
                ]);
            }
    
            session()->flash('message', 'Syllabus updated Successfully');
            return response()->json(['message' => 'Course updated successfully', 'redirect_url' => "/instructor/course/content/$course->course_id"]);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            return response()->json(['errors' => $errors], 422);
        }
    }

    public function update_syllabus_delete(Course $course, Request $request) {
        try {
            $syllabusId = $request->input('fetch_syllabus_id');
            $syllabus = DB::table('syllabus')
                ->select(
                    'syllabus_id',
                    'course_id',
                    'topic_id',
                    'topic_title',
                    'category'
                )
                ->where('syllabus_id', $syllabusId)
                // ->where('course_id', $course->course_id)
                ->first();
    
            if ($syllabus) {
                if ($syllabus->category == 'LESSON') {
                    DB::table('lessons')
                        ->where('syllabus_id', $syllabusId)
                        ->where('course_id', $course->course_id)
                        ->delete();
                } elseif ($syllabus->category == 'ACTIVITY') {
                    DB::table('activities')
                        ->where('syllabus_id', $syllabusId)
                        ->where('course_id', $course->course_id)
                        ->delete();
                } elseif ($syllabus->category == 'QUIZ') {
                    DB::table('quizzes')
                        ->where('syllabus_id', $syllabusId)
                        ->where('course_id', $course->course_id)
                        ->delete();
                }
    
                DB::table('syllabus')
                    ->where('syllabus_id', $syllabusId)
                    ->where('course_id', $course->course_id)
                    ->delete();
    
                session()->flash('message', 'Topic deleted Successfully');
                return response()->json(['message' => 'Topic Deleted successfully', 'redirect_url' => "/instructor/course/content/$course->course_id"]);
            } else {
                return response()->json(['error' => 'Syllabus not found'], 404);
            }
        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            return response()->json(['errors' => $errors], 422);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    
    public function view_lesson(Course $course, Syllabus $syllabus, $topic_id) {


        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            
            $instructor = session('instructor');
            if($instructor['status'] !== 'Approved') {
                session()->flash('message', 'Account is not yet Approved');
                return response()->json(['message' => 'Account is not yet Approved', 'redirect_url' => '/instructor/courses']);
            } else {
                try {

                    $lessonInfo = DB::table('lessons')
                        ->select(
                            'lesson_id',
                            'course_id',
                            'syllabus_id',
                            'topic_id',
                            'lesson_title',
                            'picture',
                        )
                        ->where('course_id', $course->course_id)
                        ->where('syllabus_id', $syllabus->syllabus_id)
                        ->where('topic_id', $topic_id)
                        ->first();

                    $lessonContent = DB::table('lesson_content')
                            ->select(
                                'lesson_content_id',
                                'lesson_id',
                                'lesson_content_title',
                                'lesson_content',
                                'lesson_content_order',
                                'picture',
                            )
                            ->where('lesson_id', $lessonInfo->lesson_id)
                            ->orderBy('lesson_content_order', 'ASC')
                            ->get();

                                // dd($lessonContent);

                    $response = $this->course_content($course);

                    session(['lesson_data' => [
                        'lessonInfo' => $lessonInfo,
                        'lessonContent' => $lessonContent,
                        'courseData' => $response,
                        'instructor' => $instructor,
                        'title' => 'Course Lesson',
                    ]]);

                    return view('instructor_course.courseLesson', compact('instructor'))->with([
                        'title' => 'Course Lesson',
                        'scripts' => ['instructor_lesson_manage.js'],
                        'lessonCount' => $response['lessonCount'],
                        'activityCount' => $response['activityCount'],
                        'quizCount' => $response['quizCount'],
                        'course' => $response['course'],
                        'syllabus' => $response['syllabus'],
                        'lessonInfo' => $lessonInfo,
                        'lessonContent' => $lessonContent,
                        // 'instructor' => $response['instructor'],
                    ]);

                } catch (ValidationException $e) {
                    $errors = $e->validator->errors();
            
                    return response()->json(['errors' => $errors], 422);
                }
            }
        } else {
            return redirect('/instructor');
        }

        return view('instructor_course.courseLesson')->with('title', 'Course Lesson');
    }

    public function lesson_content_json (Course $course, Syllabus $syllabus, $topic_id) {
        if (auth('instructor')->check()) {
            $instructor = session('instructor');
            
        if($instructor['status'] !== 'Approved') {
            session()->flash('message', 'Account is not yet Approved');
            return response()->json(['message' => 'Account is not yet Approved', 'redirect_url' => '/instructor/courses']);
        } else {
            try {
                $lessonInfo = DB::table('lessons')
                        ->select(
                            'lesson_id',
                            'course_id',
                            'syllabus_id',
                            'topic_id',
                            'lesson_title',
                            'picture',
                        )
                        ->where('course_id', $course->course_id)
                        ->where('syllabus_id', $syllabus->syllabus_id)
                        ->where('topic_id', $topic_id)
                        ->first();

                $lessonContent = DB::table('lesson_content')
                        ->select(
                            'lesson_content_id',
                            'lesson_id',
                            'lesson_content_title',
                            'lesson_content',
                            'lesson_content_order',
                            'picture',
                        )
                        ->where('lesson_id', $lessonInfo->lesson_id)
                        ->get();


                $response = $this->course_content($course);


                $data = [    
                'title' => 'Course Content',
                'scripts' => ['instructor_course_content_syllabus.js'],
                'lessonCount' => $response['lessonCount'],
                'activityCount' => $response['activityCount'],
                'quizCount' => $response['quizCount'],
                'course' => $response['course'],
                'syllabus' => $response['syllabus'],
                'lessonInfo' => $lessonInfo,
                'lessonContent' => $lessonContent,
                ];

                return response()->json($data);

            } catch (ValidationException $e) {
                $errors = $e->validator->errors();
        
                return response()->json(['errors' => $errors], 422);
            }
        }
    } else {
        return redirect('/instructor');
    }
    }

    public function update_lesson_title(Course $course, Syllabus $syllabus, Request $request, $topic_id, $lesson_id) {
        try {

            // Validate the request...
            $updated_values = $request->validate([
                'lesson_title' => ['required'],
            ]);
            $updated_values2 = $request->validate([
                'topic_title' => ['required'],
            ]);


            DB::table('lessons')
                ->where('lesson_id', $lesson_id)
                ->update($updated_values);

            DB::table('syllabus')
                ->where('syllabus_id', $syllabus->syllabus_id)
                ->where('topic_id', $topic_id)
                ->update($updated_values2);

        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
        
            return response()->json(['errors' => $errors], 422);
        }
    }

    public function update_lesson_picture(Course $course, Syllabus $syllabus, Request $request, $topic_id, $lesson_id) {
        try {

            $pictureData = $request->validate([
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);

            $folderName = "{$course->course_id} {$course->course_name}";

            $fileName = time() . ' - '. $course->course_name . ' - ' . $pictureData['picture']->getClientOriginalName();
            $folderPath = "courses/" .$folderName;

            $filePath = $pictureData['picture']->storeAs($folderPath, $fileName, 'public');

            Lessons::where('lesson_id' , $lesson_id)
            ->update(['picture' => $filePath]);

            if(!Storage::exists($folderPath)) { 
            Storage::makeDirectory($folderPath);
        }


        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
        
            return response()->json(['errors' => $errors], 422);
        }
    public function update_lesson_picture(Course $course, Syllabus $syllabus, Request $request, $topic_id, Lessons $lesson) {
        try {

            $lessonData = DB::table('lessons')
            ->select(
                'picture'
            )
            ->where('lesson_id' , $lesson->lesson_id)
            ->first();

            if($lessonData->picture !== null) {
                $relativeFilePath = str_replace('public/', '', $lesson->picture);
                
                if (Storage::disk('public')->exists($relativeFilePath)) {
                    // Storage::disk('public')->delete($relativeFilePath);
                    $specifiedDir = explode('/', $relativeFilePath);
                    array_pop($specifiedDir);

                    $dirPath = implode('/', $specifiedDir);

                    // dd($dirPath);
                    if (Storage::disk('public')->exists($relativeFilePath)) {
                        Storage::disk('public')->delete($relativeFilePath);
                    }
                }
            }
                

            $pictureData = $request->validate([
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);

            $folderName = "{$course->course_id} {$course->course_name}";

            $fileName = time() . ' - '. $course->course_name . ' - ' . $pictureData['picture']->getClientOriginalName();
            $folderPath = "courses/" .$folderName;

            $filePath = $pictureData['picture']->storeAs($folderPath, $fileName, 'public');

            Lessons::where('lesson_id' , $lesson->lesson_id)
            ->update(['picture' => $filePath]);

            if(!Storage::exists($folderPath)) { 
            Storage::makeDirectory($folderPath);
        }


        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
        
            return response()->json(['errors' => $errors], 422);
        }
    }

    public function update_lesson_content(Lessons $lesson, LessonContents $lesson_content, Request $request) {
        try {
            $updated_values = $request->validate([
                'lesson_content_title' => ['required'],
                'lesson_content' => ['required'],
            ]);

            DB::table('lesson_content')
                ->where('lesson_id', $lesson->lesson_id)
                ->where('lesson_content_id', $lesson_content->lesson_content_id)
                ->update($updated_values);

        }catch (ValidationException $e) {
            $errors = $e->validator->errors();
        
            return response()->json(['errors' => $errors], 422);
        }
    } 

    public function delete_lesson_content (Lessons $lesson, LessonContents $lesson_content) {
        try {
            DB::table('lesson_content')
                ->where('lesson_id', $lesson->lesson_id)
                ->where('lesson_content_id', $lesson_content->lesson_content_id)
                ->delete();

        }catch (ValidationException $e) {
            $errors = $e->validator->errors();
        
            return response()->json(['errors' => $errors], 422);
        }
    }

    public function save_lesson_content(Course $course, Syllabus $syllabus, $topic_id, Lessons $lesson, Request $request) {
        try {

            $lessonContentData = $request->validate([
                'lesson_content_id' => ['required'],
                'lesson_content_title' => ['required'],
                'lesson_content' => ['required'],
                'lesson_content_order' => ['required']
            ]);

            LessonContents::where('lesson_id', $lesson->lesson_id)
                        ->where('lesson_content_id', $lessonContentData['lesson_content_id'])
                        ->update($lessonContentData);


            session()->flash('message', 'Lesson Content updated Successfully');
            return response()->json(['message' => 'Lesson Content updated successfully', 'redirect_url' => "/instructor/course/content/$course->course_id/$syllabus->syllabus_id/lesson/$topic_id"]);
                        
                    
            } catch (ValidationException $e) {
                // dd($e->getMessage());
                $errors = $e->validator->errors();        
                return response()->json(['errors' => $errors], 422);
            }
    }

    public function save_add_lesson_content(Course $course, Syllabus $syllabus, $topic_id, Lessons $lesson, Request $request) {

        try{
        $lessonContentData = $request->validate([
            'lesson_content_title' => ['required'],
            'lesson_content' => ['required'],
            'lesson_content_order' => ['required']
        ]);

        $lessonContent = LessonContents::create([
            'lesson_content_title' => $lessonContentData['lesson_content_title'],
            'lesson_content' => $lessonContentData['lesson_content'],
            'lesson_id' => $lesson->lesson_id,
            'lesson_content_order' => $lessonContentData['lesson_content_order']
        ]);


        session()->flash('message', 'Lesson Content updated Successfully');
        return response()->json(['message' => 'Lesson Content updated successfully', 'redirect_url' => "/instructor/course/content/$course->course_id/$syllabus->syllabus_id/lesson/$topic_id"]);
                    
                
        } catch (ValidationException $e) {
            // dd($e->getMessage());
            $errors = $e->validator->errors();        
            return response()->json(['errors' => $errors], 422);
        }
    }

    public function lesson_content_store_file(Course $course, Syllabus $syllabus, $topic_id, Lessons $lesson, LessonContents $lesson_content, Request $request) {
        try {


            $lessonContentData = DB::table('lesson_content')
            ->select(
                'picture'
            )
            ->where('lesson_content_id' , $lesson_content->lesson_content_id)
            ->first();

            if($lessonContentData->picture !== null) {
                $relativeFilePath = str_replace('public/', '', $lesson_content->picture);
                
                if (Storage::disk('public')->exists($relativeFilePath)) {
                    // Storage::disk('public')->delete($relativeFilePath);
                    $specifiedDir = explode('/', $relativeFilePath);
                    array_pop($specifiedDir);

                    $dirPath = implode('/', $specifiedDir);

                    // dd($dirPath);
                    if (Storage::disk('public')->exists($relativeFilePath)) {
                        Storage::disk('public')->delete($relativeFilePath);
                    }
                }

            }

            $pictureData = $request->validate([
                'picture' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);

            $folderName = "{$course->course_id} {$course->course_name}";

            $fileName = time() . ' - '. $course->course_name . ' - ' . $pictureData['picture']->getClientOriginalName();
            $folderPath = "courses/" .$folderName;

            $filePath = $pictureData['picture']->storeAs($folderPath, $fileName, 'public');

            LessonContents::where('lesson_content_id' , $lesson_content['lesson_content_id'])
            ->update(['picture' => $filePath]);

            if(!Storage::exists($folderPath)) { 
            Storage::makeDirectory($folderPath);
        }


        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
        
            return response()->json(['errors' => $errors], 422);
        }
    }

    public function lesson_content_delete_file(Course $course, Syllabus $syllabus, $topic_id, Lessons $lesson, LessonContents $lesson_content) {
        try {

            $relativeFilePath = str_replace('public/', '', $lesson_content->picture);
            if (Storage::disk('public')->exists($relativeFilePath)) {
                // Storage::disk('public')->delete($relativeFilePath);
                $specifiedDir = explode('/', $relativeFilePath);
                array_pop($specifiedDir);

                $dirPath = implode('/', $specifiedDir);

                // dd($dirPath);
                if (Storage::disk('public')->exists($relativeFilePath)) {
                    Storage::disk('public')->delete($relativeFilePath);
                }
            }

            $updatedRow = [
                'picture' => null
            ];
                
            DB::table('lesson_content')
                ->where('lesson_id', $lesson->lesson_id)
                ->where('lesson_content_id', $lesson_content->lesson_content_id)
                ->update($updatedRow);

        }catch (ValidationException $e) {
            $errors = $e->validator->errors();
        
            return response()->json(['errors' => $errors], 422);
        }
    }


    public function lesson_generate_pdf(Course $course, Syllabus $syllabus, $topic_id, Lessons $lesson)
{
    if (auth('instructor')->check()) {
        $instructor = session('instructor');
        
        // Retrieve the data from the session
        $lessonData = session('lesson_data');
    
        if (!$lessonData) {
            // Handle the case where the session data is not found
            return response('Session data not found', 500);
        }
    
        // Extract the data you need from the session
        $lessonInfo = $lessonData['lessonInfo'];
        $lessonContent = $lessonData['lessonContent'];
        $title = 'Course Lesson';
        $scripts = ['instructor_lesson_manage.js'];
        $courseData = $lessonData['courseData'];

        $course = $courseData['course'];
        $syllabus = $courseData['syllabus'];
        $lessonCount = $courseData['lessonCount'];
        $activityCount = $courseData['activityCount'];
        $quizCount = $courseData['quizCount'];

        // You can now use $lessonInfo and $lessonContent to generate your PDF
        // ...

        // Render the view with the Blade template
        $html = view('instructor_course.courseLesson', compact('instructor'))
            ->with([
                'title' => $title,
                'scripts' => $scripts,
                'lessonCount' => $lessonCount,
                'activityCount' => $activityCount,
                'quizCount' => $quizCount,
                'course' => $course,
                'syllabus' => $syllabus,
                'lessonInfo' => $lessonInfo,
                'lessonContent' => $lessonContent,
            ])
            ->render();

        // Find the markers in your HTML
        $startMarker = '<!-- start-generate-pdf -->';
        $endMarker = '<!-- end-generate-pdf -->';
    
        // Find the positions of the markers
        $startPos = strpos($html, $startMarker);
        $endPos = strpos($html, $endMarker);

        $extractedHtml = substr($html, $startPos + strlen($startMarker), $endPos - $startPos - strlen($startMarker));


        // Configure Dompdf
        $dompdf = new Dompdf();
        $dompdf->set_option('isHtml5ParserEnabled', true);
        $dompdf->set_option('isPhpEnabled', true);
        $dompdf->set_option('isCssEnabled', true);

        // Load HTML to Dompdf
        $dompdf->loadHtml($extractedHtml);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF
        $dompdf->render();

        // Generate the PDF
        $pdf = $dompdf->output();







        // Generate a unique filename for the PDF (you can customize this)
        $filename = 'lesson_' . $lessonInfo->lesson_id . '.pdf';

        // Define the folder path based on the course name
        $folderName = Str::slug($course->course_name, '_'); // Converts course name to a URL-friendly format
        $folderPath = 'courses/' . $folderName;

        // Store the PDF in the public directory within the course-specific folder
        Storage::disk('public')->put($folderPath . '/' . $filename, $pdf);

        // Generate the URL to the stored PDF
        $pdfUrl = URL::to('storage/' . $folderPath . '/' . $filename);

        // Provide a download link to the user
        return response()->json(['pdf_url' => $pdfUrl]);
    } else {
        // Handle authentication failure
        return response('Unauthorized', 401);
    }
}

    
    
}
