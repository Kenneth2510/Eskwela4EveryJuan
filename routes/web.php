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
    Route::get('/home', 'home');
});


Route::controller(LearnerController::class)->group(function() {
    Route::get('/learner/login', 'index');
    Route::get('/learner/register', 'register');
});

Route::controller(InstructorController::class)->group(function() {
    Route::get('/instructor/login', 'index');
    Route::get('/instructor/register', 'register');
});

Route::controller(AdminController::class)->group(function() {
    Route::get('/admin', 'index');
    Route::get('/admin/dashboard', 'dashboard');
    Route::get('/admin/learners', 'learners');
    Route::get('/admin/add_learner', 'add_learner');
    Route::post('/admin/add_learner' ,'store_new_learner');
    Route::get('/admin/view_learner/{learner}', 'view_learner');
    Route::put('/admin/approve-learner/{learner}', 'approveLearner');
    Route::put('/admin/reject-learner/{learner}', 'rejectLearner');
    Route::put('/admin/view_learner/{learner}' , 'update_learner');
    Route::delete('/admin/view_learner/{learner}', 'destroy_learner');
    Route::get('/admin/instructors' , 'instructors');
    Route::get('/admin/add_instructor' , 'add_instructor');
    Route::get('/admin/view_instructor' , 'view_instructor'); //to add param later
});