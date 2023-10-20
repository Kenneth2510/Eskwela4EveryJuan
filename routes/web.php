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
    Route::get('learner/dashboard', 'dashboard');
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
    Route::get('/instructor/register1', 'register1');
    Route::post('/instructor/register1', 'register_process');
    Route::get('/instructor/settings', 'settings');
    Route::put('/instructor/settings', 'update_info');
    Route::put('/instructor/update_profile', 'update_profile');
});



Route::controller(AdminController::class)->group(function() {
    Route::get('/admin', 'index')->name('login')->middleware('web', 'guest:admin');
    Route::post('/admin/login', 'login_process');
    Route::post('/admin/logout', 'logout');
    Route::get('/admin/dashboard', 'dashboard')->middleware('auth:admin');
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
    Route::get('/instructor/mycourse/content', 'InstructorCourseController@content');
    Route::get('/instructor/mycourse/syllabus', 'InstructorCourseController@syllabus');
    Route::get('/instructor/mycourse/lesson1', 'InstructorCourseController@lesson');
// // })->middleware('web');
});

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/learner/courses', 'LearnerCourseController@courses');
    Route::get('/learner/course/{course}', 'LearnerCourseController@overview');
    Route::post('/learner/course/enroll/{course}', 'LearnerCourseController@enroll_course');
    Route::post('/learner/course/unEnroll/{learnerCourse}', 'LearnerCourseController@unEnroll_course');
// // })->middleware('web');
});