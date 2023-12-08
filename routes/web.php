<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\LearnerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });


Route::controller(UserController::class)->group(function() {
    Route::get('/', 'index');
    // Route::get('/home', 'home');
});


Route::controller(LearnerController::class)->group(function() {
    Route::get('/learner', 'index');
    Route::post('/learner/login', 'login_process');
    Route::get('/learner/authenticate', 'login_authentication');
    Route::post('/learner/authenticate', 'authenticate_learner');
    Route::post('/learner/logout', 'logout');
    Route::get('/learner/register', 'register');
    Route::post('/learner/register', 'register_process');
    Route::get('/learner/dashboard', 'dashboard');
    Route::get('/learner/settings', 'settings');

    Route::get('/learner/register1', 'register1');

    Route::put('/learner/settings', 'update_info');
    Route::put('/learner/update_profile', 'update_profile');

});

Route::controller(InstructorController::class)->group(function() {
    Route::get('/instructor', 'index');
    Route::post('/instructor/login', 'login_process');
    Route::get('/instructor/authenticate', 'login_authentication');
    Route::post('/instructor/authenticate', 'authenticate_instructor');
    Route::post('/instructor/logout', 'logout');
    Route::get('/instructor/register', 'register');
    Route::get('/instructor/dashboard', 'dashboard');
    Route::get('/instructor/register', 'register1');
    Route::post('/instructor/register', 'register_process');
    Route::get('/instructor/settings', 'settings');
    Route::put('/instructor/settings', 'update_info');
    Route::put('/instructor/update_profile', 'update_profile');

    // Route::get('/instructor/activities', 'activity');
    Route::get('/instructor/quiz', 'quiz');
});



Route::controller(AdminController::class)->group(function() {
    // Route::get('/admin', 'index')->name('login')->middleware('web', 'guest:admin');
    Route::get('/admin', 'index');
    Route::post('/admin/login', 'login_process');
    Route::post('/admin/logout', 'logout');
    // Route::get('/admin/dashboard', 'dashboard')->middleware('auth:admin');
    Route::get('/admin/dashboard', 'dashboard');
    // learner area---------------
    Route::get('/admin/learners', 'learners');
    Route::get('/admin/add_learner', 'add_learner');
    Route::post('/admin/add_learner' ,'store_new_learner');
    Route::get('/admin/view_learner/{learner}', 'view_learner');
    Route::put('/admin/approve_learner/{learner}', 'approveLearner');
    Route::put('/admin/reject_learner/{learner}', 'rejectLearner');
    Route::put('/admin/pending_learner/{learner}', 'pendingLearner');
    Route::put('/admin/view_learner/{learner}' , 'update_learner');
    Route::post('/admin/delete_learner/{learner}', 'destroy_learner');
    // instructor area -------------------
    Route::get('/admin/instructors' , 'instructors');
    Route::get('/admin/add_instructor' , 'add_instructor');
    Route::post('/admin/add_instructor', 'store_new_instructor');
    Route::get('/admin/view_instructor/{instructor}' , 'view_instructor');
    Route::put('/admin/approve_instructor/{instructor}', 'approveInstructor');
    Route::put('/admin/reject_instructor/{instructor}', 'rejectInstructor');
    Route::put('/admin/pending_instructor/{instructor}', 'pendingInstructor');
    Route::put('/admin/view_instructor/{instructor}' , 'update_instructor');
    Route::post('/admin/delete_instructor/{instructor}', 'destroy_instructor');
    // courses area ----------------------
    Route::get('/admin/courses' , 'courses');
    Route::get('/admin/add_course', 'add_course');
    Route::post('/admin/add_course', 'store_new_course');
    Route::get('/admin/view_course/{course}', 'view_course');
    Route::post('/admin/view_course/{course}', 'update_course');
    Route::post('/admin/delete_course/{course}', 'delete_course');
    Route::put('/admin/approve_course/{course}', 'approveCourse');
    Route::put('/admin/reject_course/{course}', 'rejectCourse');
    Route::put('/admin/pending_course/{course}', 'pendingCourse');
    Route::get('/admin/manage_course/course_overview/{course}' , 'manage_course');
    Route::get('/admin/manage_course/enrollees/{course}' , 'course_enrollees');
    Route::put('/admin/manage_course/enrollee/approve/{learner_course}', 'approve_learner_course');
    Route::put('/admin/manage_course/enrollee/pending/{learner_course}', 'pending_learner_course');
    Route::put('/admin/manage_course/enrollee/reject/{learner_course}', 'reject_learner_course');
});

// Route::controller(InstructorCourseController::class)->group(function() {
//     Route::get('/instructor/courses', 'courses');
//     Route::get('/instructor/courses/create', 'courseCreate');
// });

// Route::get('/instructor/courses', 'App\Http\Controllers\InstructorCourseController@courses');
// Route::get('/instructor/courses/create', 'App\Http\Controllers\InstructorCourseController@courseCreate');

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/instructor/courses', 'InstructorCourseController@courses');
    Route::get('/instructor/courses/create', 'InstructorCourseController@courseCreate');
    Route::post('/instructor/courses/create', 'InstructorCourseController@courseCreate_process');
    Route::get('/instructor/course/{course}', 'InstructorCourseController@overview');
    Route::get('/instructor/course/manage/{course}', 'InstructorCourseController@manage_course');
    Route::post('/instructor/course/manage/{course}', 'InstructorCourseController@update_course');
    Route::post('/instructor/course/delete/{course}', 'InstructorCourseController@delete_course');
    Route::post('/instructor/course/create/syllabus/{course}', 'InstructorCourseController@create_syllabus');

    Route::get('/instructor/course/content/{course}', 'InstructorCourseController@display_course_syllabus_view');
    Route::get('/instructor/course/content/{course}/json', 'InstructorCourseController@course_content_json');

    Route::post('/instructor/course/content/syllabus/{course}/manage', 'InstructorCourseController@update_syllabus');
    Route::post('/instructor/course/content/syllabus/{course}/manage_add', 'InstructorCourseController@update_syllabus_add_new');
    Route::post('/instructor/course/content/syllabus/{course}/manage_delete', 'InstructorCourseController@update_syllabus_delete');

    // lesson management
    Route::get('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}', 'InstructorCourseController@view_lesson');
    Route::get('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}/json', 'InstructorCourseController@lesson_content_json');

    Route::post('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}/title/{lesson_id}', 'InstructorCourseController@update_lesson_title');
    Route::post('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}/title/{lesson}/picture', 'InstructorCourseController@update_lesson_picture');
    Route::post('/instructor/course/content/lesson/{lesson}/title/{lesson_content}', 'InstructorCourseController@update_lesson_content');
    Route::post('/instructor/course/content/lesson/{lesson}/title/{lesson_content}/delete', 'InstructorCourseController@delete_lesson_content');

    Route::post('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}/title/{lesson}/save', 'InstructorCourseController@save_lesson_content');
    Route::post('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}/title/{lesson}/save_add', 'InstructorCourseController@save_add_lesson_content');
    Route::post('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}/title/{lesson}/store_file/{lesson_content}', 'InstructorCourseController@lesson_content_store_file');
    Route::post('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}/title/{lesson}/delete_file/{lesson_content}', 'InstructorCourseController@lesson_content_delete_file');
    Route::get('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}/title/{lesson}/generate_pdf', 'InstructorCourseController@lesson_generate_pdf');
    
    // activity management
    Route::get('/instructor/course/content/{course}/{syllabus}/activity/{topic_id}', 'InstructorCourseController@view_activity');
    Route::get('/instructor/course/content/{course}/{syllabus}/activity/{topic_id}/json', 'InstructorCourseController@activity_content_json');
    Route::post('/instructor/course/content/{course}/{syllabus}/activity/{topic_id}/title/{activity}/{activity_content}/instructions', 'InstructorCourseController@update_activity_instructions');
    Route::post('/instructor/course/content/{course}/{syllabus}/activity/{topic_id}/title/{activity}/{activity_content}/score', 'InstructorCourseController@update_activity_score');
    Route::post('/instructor/course/content/{course}/{syllabus}/activity/{topic_id}/title/{activity}/{activity_content}/criteria', 'InstructorCourseController@update_activity_criteria');
    Route::post('/instructor/course/content/{course}/{syllabus}/activity/{topic_id}/title/{activity}/{activity_content}/criteria_add', 'InstructorCourseController@add_activity_criteria');

    Route::get('/instructor/course/content/{course}/{syllabus}/activity/{topic_id}/{learner_course}', 'InstructorCourseController@view_learner_activity_response');
    Route::post('/instructor/course/content/activity/{learner_activity_output}/{learner_course}/{activities}/{activity_content}', 'InstructorCourseController@learnerResponse_overallScore');
    Route::post('/instructor/course/content/activity/{learner_activity_output}/{learner_course}/{activities}/{activity_content}/criteria', 'InstructorCourseController@learnerResponse_criteriaScore');

    // quiz management
    Route::get('/instructor/course/content/{course}/{syllabus}/quiz/{topic_id}', 'InstructorCourseController@view_quiz');
    Route::get('/instructor/course/content/{course}/{syllabus}/quiz/{topic_id}/json', 'InstructorCourseController@quiz_info_json');
    Route::get('/instructor/course/content/{course}/{syllabus}/quiz/{topic_id}/view_learner_output/{learner_quiz_progress}', 'InstructorCourseController@view_learner_output');
    Route::get('/instructor/course/content/{course}/{syllabus}/quiz/{topic_id}/view_learner_output/{learner_quiz_progress}/json', 'InstructorCourseController@view_learner_output_json');
    
    Route::post('/instructor/course/content/{course}/{syllabus}/quiz/{topic_id}/{quiz}/add', 'InstructorCourseController@manage_add_reference');
    Route::post('/instructor/course/content/{course}/{syllabus}/quiz/{topic_id}/{quiz}/update', 'InstructorCourseController@manage_update_reference');
    Route::post('/instructor/course/content/{course}/{syllabus}/quiz/{topic_id}/{quiz}/duration', 'InstructorCourseController@manage_update_duration');

    Route::get('/instructor/course/content/{course}/{syllabus}/quiz/{topic_id}/{quiz_id}/content', 'InstructorCourseController@quiz_content');
    Route::get('/instructor/course/content/{course}/{syllabus}/quiz/{topic_id}/{quiz_id}/content/json', 'InstructorCourseController@quiz_content_json');
    Route::post('/instructor/course/content/{course}/{syllabus}/quiz/{topic_id}/{quiz_id}/content/add', 'InstructorCourseController@add_quiz_question');
    Route::post('/instructor/course/content/{course}/{syllabus}/quiz/{topic_id}/{quiz_id}/content/update', 'InstructorCourseController@update_quiz_question');
    Route::post('/instructor/course/content/{course}/{syllabus}/quiz/{topic_id}/{quiz_id}/content/empty', 'InstructorCourseController@empty_quiz_question');
    


    // // })->middleware('web');
});

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/learner/courses', 'LearnerCourseController@courses');
    Route::get('/learner/course/{course}', 'LearnerCourseController@overview');
    Route::post('/learner/course/enroll/{course}', 'LearnerCourseController@enroll_course');
    Route::post('/learner/course/unEnroll/{learnerCourse}', 'LearnerCourseController@unEnroll_course');
    Route::get('/learner/course/manage/{course}', 'LearnerCourseController@manage_course');
    Route::get('/learner/course/manage/{course}/overview', 'LearnerCourseController@course_overview');
    Route::get('/learner/course/manage/{course}/view_syllabus', 'LearnerCourseController@view_syllabus');

    Route::get('/learner/course/content/{course}/{learner_course}/lesson/{syllabus}', 'LearnerCourseController@view_lesson');
    Route::post('/learner/course/content/{course}/{learner_course}/lesson/{syllabus}/finish', 'LearnerCourseController@finish_lesson');

    Route::get('/learner/course/content/{course}/{learner_course}/activity/{syllabus}', 'LearnerCourseController@view_activity');
    Route::get('/learner/course/content/{course}/{learner_course}/activity/{syllabus}/answer', 'LearnerCourseController@answer_activity');
    Route::post('/learner/course/content/{course}/{learner_course}/activity/{syllabus}/answer/{activity}/{activity_content}', 'LearnerCourseController@submit_answer');




    Route::get('/learner/course/content/{course}/{learner_course}/quiz/{syllabus}', 'LearnerCourseController@view_quiz');
    Route::get('/learner/course/content/{course}/{learner_course}/quiz/{syllabus}/answer', 'LearnerCourseController@answer_quiz');
    Route::get('/learner/course/content/{course}/{learner_course}/quiz/{syllabus}/answer/json', 'LearnerCourseController@answer_quiz_json');
    Route::post('/learner/course/content/{course}/{learner_course}/quiz/{syllabus}/answer/submit', 'LearnerCourseController@submit_quiz');
    Route::post('/learner/course/content/{course}/{learner_course}/quiz/{syllabus}/answer/score', 'LearnerCourseController@compute_score');

    
    Route::get('/learner/course/content/{course}/{learner_course}/quiz/{syllabus}/view_output/{attempt}', 'LearnerCourseController@view_output');
    Route::get('/learner/course/content/{course}/{learner_course}/quiz/{syllabus}/view_output/{attempt}/json', 'LearnerCourseController@view_output_json');
    
    // // })->middleware('web');
});