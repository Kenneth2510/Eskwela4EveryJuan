<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\LearnerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;


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
    Route::get('/learner/forgot', 'forgot_password');
    Route::post('/learner/reset', 'reset');
    Route::get('/learner/reset_password', 'reset_password');
    Route::post('/learner/reset_password_process/{token}', 'reset_password_process');
    Route::get('/learner/authenticate', 'login_authentication');
    Route::post('/learner/authenticate', 'authenticate_learner');
    Route::post('/learner/logout', 'logout');
    Route::get('/learner/register', 'register');
    Route::post('/learner/register', 'register_process');
    Route::get('/learner/wait', 'wait');
    Route::get('/learner/dashboard', 'dashboard');
    Route::get('/learner/dashboard/overviewNum', 'overviewNum');
    Route::get('/learner/dashboard/sessionData', 'sessionData');
    Route::get('/learner/settings', 'settings');

    Route::get('/learner/register1', 'register1');

    Route::put('/learner/settings', 'update_info');
    Route::put('/learner/update_profile', 'update_profile');

});

Route::controller(InstructorController::class)->group(function() {
    Route::get('/instructor', 'index');
    Route::post('/instructor/login', 'login_process');
    Route::get('/instructor/forgot', 'forgot_password');
    Route::post('/instructor/reset', 'reset');
    Route::get('/instructor/reset_password', 'reset_password');
    Route::post('/instructor/reset_password_process/{token}', 'reset_password_process');
    Route::get('/instructor/authenticate', 'login_authentication');
    Route::post('/instructor/authenticate', 'authenticate_instructor');
    Route::post('/instructor/logout', 'logout');
    Route::get('/instructor/register', 'register');
    Route::get('/instructor/wait', 'wait');
    Route::get('/instructor/dashboard', 'dashboard');
    Route::get('/instructor/dashboard/overviewNum', 'overviewNum');
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
Route::get('storage/{folder}/{filename}', function ($folder, $filename) {
    $path = storage_path("app/public/{$folder}/{$filename}");

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->where('filename', '.*'); 

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/instructor/courses', 'InstructorCourseController@courses');
    Route::get('/instructor/courses/searchCourse', 'InstructorCourseController@searchCourse');
    Route::get('/instructor/courses/create', 'InstructorCourseController@courseCreate');
    Route::post('/instructor/courses/create', 'InstructorCourseController@courseCreate_process');
    Route::post('/instructor/course/upload/files/{course}', 'InstructorCourseController@courseCreateUploadFiles');


    Route::get('/instructor/course/{course}', 'InstructorCourseController@overview');
    Route::get('/instructor/course/{course}/overviewNum', 'InstructorCourseController@overviewNum');
    Route::post('/instructor/course/{course}/editCourseDetails', 'InstructorCourseController@editCourseDetails');
    Route::post('/instructor/course/{course}/generate_pdf', 'InstructorCourseController@generate_pdf');
    Route::post('/instructor/course/{course}/add_file', 'InstructorCourseController@add_file');
    Route::get('/instructor/course/{course}/delete_file/{fileName}', 'InstructorCourseController@delete_file');

    // Route::get('/instructor/course/manage/{course}', 'InstructorCourseController@manage_course');
    // Route::post('/instructor/course/manage/{course}', 'InstructorCourseController@update_course');
    Route::post('/instructor/course/{course}/delete', 'InstructorCourseController@delete_course');

    Route::post('/instructor/course/create/syllabus/{course}', 'InstructorCourseController@create_syllabus');

    Route::get('/instructor/course/content/{course}', 'InstructorCourseController@display_course_syllabus_view');
    Route::get('/instructor/course/content/{course}/json', 'InstructorCourseController@course_content_json');

    Route::post('/instructor/course/content/syllabus/{course}/manage', 'InstructorCourseController@update_syllabus');
    Route::post('/instructor/course/content/syllabus/{course}/manage_add', 'InstructorCourseController@update_syllabus_add_new');
    Route::post('/instructor/course/content/syllabus/{course}/manage_delete', 'InstructorCourseController@update_syllabus_delete');

    // lesson management
    Route::get('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}', 'InstructorCourseController@view_lesson');
    Route::get('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}/json', 'InstructorCourseController@lesson_content_json');
    Route::post('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}/addCompletionTime', 'InstructorCourseController@addCompletionTime');

    Route::post('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}/title/{lesson_id}', 'InstructorCourseController@update_lesson_title');
    Route::post('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}/title/{lesson}/picture', 'InstructorCourseController@update_lesson_picture');
    Route::post('/instructor/course/content/lesson/{lesson}/title/{lesson_content}', 'InstructorCourseController@update_lesson_content');
    Route::post('/instructor/course/content/lesson/{lesson}/title/{lesson_content}/delete', 'InstructorCourseController@delete_lesson_content');

    

    Route::post('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}/title/{lesson}/save', 'InstructorCourseController@save_lesson_content');
    Route::post('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}/title/{lesson}/save_add', 'InstructorCourseController@save_add_lesson_content');
    Route::post('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}/title/{lesson}/store_file/{lesson_content}', 'InstructorCourseController@lesson_content_store_file');
    Route::post('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}/title/{lesson}/delete_file/{lesson_content}', 'InstructorCourseController@lesson_content_delete_file');
    Route::get('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}/pdf_view', 'InstructorCourseController@view_lesson_pdf');
    Route::get('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}/title/{lesson}/generate_pdf', 'InstructorCourseController@lesson_generate_pdf');
    Route::post('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}/title/{lesson}/store_video_url/{lesson_content}', 'InstructorCourseController@lesson_content_embed_url');
    Route::post('/instructor/course/content/{course}/{syllabus}/lesson/{topic_id}/title/{lesson}/delete_url/{lesson_content}', 'InstructorCourseController@lesson_content_delete_url');
    
    // activity management
    Route::get('/instructor/course/content/{course}/{syllabus}/activity/{topic_id}', 'InstructorCourseController@view_activity');
    Route::get('/instructor/course/content/{course}/{syllabus}/activity/{topic_id}/json', 'InstructorCourseController@activity_content_json');
    Route::post('/instructor/course/content/{course}/{syllabus}/activity/{topic_id}/title/{activity}/{activity_content}/instructions', 'InstructorCourseController@update_activity_instructions');
    Route::post('/instructor/course/content/{course}/{syllabus}/activity/{topic_id}/title/{activity}/{activity_content}/score', 'InstructorCourseController@update_activity_score');
    Route::post('/instructor/course/content/{course}/{syllabus}/activity/{topic_id}/title/{activity}/{activity_content}/criteria', 'InstructorCourseController@update_activity_criteria');
    Route::post('/instructor/course/content/{course}/{syllabus}/activity/{topic_id}/title/{activity}/{activity_content}/criteria_add', 'InstructorCourseController@add_activity_criteria');

    Route::get('/instructor/course/content/{course}/{syllabus}/activity/{topic_id}/{learner_course}/{attempt}', 'InstructorCourseController@view_learner_activity_response');
    Route::post('/instructor/course/content/activity/{learner_activity_output}/{learner_course}/{activities}/{activity_content}/{attempt}', 'InstructorCourseController@learnerResponse_overallScore');
    Route::post('/instructor/course/content/activity/{learner_activity_output}/{learner_course}/{activities}/{activity_content}/{attempt}/criteria_score', 'InstructorCourseController@learnerResponse_criteriaScore');
    Route::get('/instructor/course/content/activity/{learner_activity_output}/{learner_course}/{activities}/{activity_content}/{attempt}/reattempt', 'InstructorCourseController@reattempt_activity');

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
    Route::get('/learner/courses/searchCourse', 'LearnerCourseController@searchCourse');
    Route::get('/learner/course/{course}', 'LearnerCourseController@overview');
    Route::post('/learner/course/enroll/{course}', 'LearnerCourseController@enroll_course');
    Route::post('/learner/course/unEnroll/{learnerCourse}', 'LearnerCourseController@unEnroll_course');
    Route::get('/learner/course/manage/{course}', 'LearnerCourseController@manage_course');
    Route::get('/learner/course/manage/{course}/overview', 'LearnerCourseController@course_overview');
    Route::get('/learner/course/manage/{course}/view_syllabus', 'LearnerCourseController@view_syllabus');

    Route::get('/learner/course/content/{course}/{learner_course}/pre_assessment', 'LearnerCourseController@pre_assessment');
    Route::get('/learner/course/content/{course}/{learner_course}/pre_assessment/answer', 'LearnerCourseController@answer_pre_assessment');
    Route::get('/learner/course/content/{course}/{learner_course}/pre_assessment/answer/json', 'LearnerCourseController@answer_pre_assessment_json');
    Route::post('/learner/course/content/{course}/{learner_course}/pre_assessment/answer/submit', 'LearnerCourseController@submit_pre_assessment');
    Route::post('/learner/course/content/{course}/{learner_course}/pre_assessment/answer/score', 'LearnerCourseController@score_pre_assessment');
    Route::get('/learner/course/content/{course}/{learner_course}/pre_assessment/view_output', 'LearnerCourseController@view_output_pre_assessment');
    Route::get('/learner/course/content/{course}/{learner_course}/pre_assessment/view_output/json', 'LearnerCourseController@view_output_pre_assessment_json');
    

    Route::get('/learner/course/content/{course}/{learner_course}/lesson/{syllabus}', 'LearnerCourseController@view_lesson');
    Route::post('/learner/course/content/{course}/{learner_course}/lesson/{syllabus}/finish', 'LearnerCourseController@finish_lesson');

    Route::get('/learner/course/content/{course}/{learner_course}/activity/{syllabus}', 'LearnerCourseController@view_activity');
    Route::get('/learner/course/content/{course}/{learner_course}/activity/{syllabus}/answer/{attempt}', 'LearnerCourseController@answer_activity');
    Route::post('/learner/course/content/{course}/{learner_course}/activity/{syllabus}/answer/{attempt}/{activity}/{activity_content}', 'LearnerCourseController@submit_answer');

    Route::get('/learner/course/content/{course}/{learner_course}/quiz/{syllabus}', 'LearnerCourseController@view_quiz');
    Route::get('/learner/course/content/{course}/{learner_course}/quiz/{syllabus}/answer/{attempt}', 'LearnerCourseController@answer_quiz');
    Route::get('/learner/course/content/{course}/{learner_course}/quiz/{syllabus}/answer/{attempt}/json', 'LearnerCourseController@answer_quiz_json');
    Route::post('/learner/course/content/{course}/{learner_course}/quiz/{syllabus}/answer/{attempt}/submit', 'LearnerCourseController@submit_quiz');
    Route::post('/learner/course/content/{course}/{learner_course}/quiz/{syllabus}/answer/{attempt}/score', 'LearnerCourseController@compute_score');

    Route::get('/learner/course/content/{course}/{learner_course}/quiz/{syllabus}/view_output/{attempt}', 'LearnerCourseController@view_output');
    Route::get('/learner/course/content/{course}/{learner_course}/quiz/{syllabus}/view_output/{attempt}/json', 'LearnerCourseController@view_output_json');
    Route::get('/learner/course/content/{course}/{learner_course}/quiz/{syllabus}/reattempt', 'LearnerCourseController@reattempt_answer_quiz');
    

    
    Route::get('/learner/course/content/{course}/{learner_course}/post_assessment', 'LearnerCourseController@post_assessment');
    // // })->middleware('web');
});


Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/instructor/performances', 'InstructorPerformanceController@performances');
    Route::get('/instructor/performances/sessionData', 'InstructorPerformanceController@sessionData');
    Route::get('/instructor/performances/totalCourseNum', 'InstructorPerformanceController@totalCourseNum');
    Route::get('/instructor/performances/courseChartData', 'InstructorPerformanceController@courseChartData');
    Route::get('/instructor/performances/course/{course}', 'InstructorPerformanceController@coursePerformance');
    Route::get('/instructor/performances/course/{course}/performanceData', 'InstructorPerformanceController@selectedCoursePerformance');
    Route::get('/instructor/performances/course/{course}/learnerCourseData', 'InstructorPerformanceController@learnerCourseData');
    Route::get('/instructor/performances/course/{course}/learnerSyllabusData', 'InstructorPerformanceController@learnerSyllabusData');
    Route::get('/instructor/performances/course/{course}/syllabus/{syllabus}', 'InstructorPerformanceController@courseSyllabusPerformance');
    Route::get('/instructor/performances/course/{course}/syllabus/{syllabus}/lessonData', 'InstructorPerformanceController@courseSyllabusLessonPerformance');
    Route::get('/instructor/performances/course/{course}/syllabus/{syllabus}/activityData', 'InstructorPerformanceController@courseSyllabusActivityPerformance');
    Route::get('/instructor/performances/course/{course}/syllabus/{syllabus}/activityData/outputs', 'InstructorPerformanceController@courseSyllabusActivityScoresPerformance');
    Route::get('/instructor/performances/course/{course}/syllabus/{syllabus}/quizData', 'InstructorPerformanceController@courseSyllabusQuizPerformance');
    Route::get('/instructor/performances/course/{course}/syllabus/{syllabus}/quizData/outputs', 'InstructorPerformanceController@courseSyllabusQuizScoresPerformance');
    Route::get('/instructor/performances/course/{course}/syllabus/{syllabus}/quizData/contentOutputs', 'InstructorPerformanceController@courseSyllabusQuizContentOutputPerformance');
    Route::get('/instructor/performances/course/{course}/learner/{learner_course}', 'InstructorPerformanceController@learnerCoursePerformance');
    Route::get('/instructor/performances/course/{course}/learner/{learner_course}/coursePerformance', 'InstructorPerformanceController@learnerCourseOverallPerformance');
    Route::get('/instructor/performances/course/{course}/learner/{learner_course}/syllabusPerformance', 'InstructorPerformanceController@learnerCourseSyllabusPerformance');
});


Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/learner/performances', 'LearnerPerformanceController@performances');
    Route::get('/learner/performances/sessionData', 'LearnerPerformanceController@sessionData');
    Route::get('/learner/performances/totalEnrolledCourses', 'LearnerPerformanceController@enrolledCoursesPerformances');
    Route::get('/learner/performances/enrolledCoursesData', 'LearnerPerformanceController@enrolledCoursesPerformancesData');
    Route::get('/learner/performances/course/{course}', 'LearnerPerformanceController@coursePerformance');
    Route::get('/learner/performances/course/{course}/coursePerformance', 'LearnerPerformanceController@coursePerformanceData');
    Route::get('/learner/performances/course/{course}/syllabusPerformance', 'LearnerPerformanceController@syllabusPerformanceData');
});


Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/instructor/discussions', 'InstructorDiscussionController@discussions');
    Route::get('/instructor/discussions/threads', 'InstructorDiscussionController@threadData');
    Route::get('/instructor/discussions/create', 'InstructorDiscussionController@createDiscussion');

    Route::post('/instructor/discussions/create/post', 'InstructorDiscussionController@postDiscussion');
    Route::post('/instructor/discussions/create/post-photo', 'InstructorDiscussionController@postPhotoDiscussion');

    Route::get('/instructor/discussions/thread/{thread}', 'InstructorDiscussionController@viewThread');
    Route::get('/instructor/discussions/thread/{thread}/comments', 'InstructorDiscussionController@viewThreadComments');

    Route::post('/instructor/discussions/thread/{thread}/comment', 'InstructorDiscussionController@postComment');
    Route::post('/instructor/discussions/thread/{thread}/commentReply', 'InstructorDiscussionController@postCommentReply');
    Route::post('/instructor/discussions/thread/{thread}/replyReply', 'InstructorDiscussionController@postReplyReply');

    Route::post('/instructor/discussions/thread/{thread}/upvote', 'InstructorDiscussionController@upvoteThread');
    Route::post('/instructor/discussions/thread/{thread}/downvote', 'InstructorDiscussionController@downvoteThread');
    Route::post('/instructor/discussions/thread/{thread}/comment/{thread_comment}/upvote', 'InstructorDiscussionController@upvoteThreadComment');
    Route::post('/instructor/discussions/thread/{thread}/comment/{thread_comment}/downvote', 'InstructorDiscussionController@downvoteThreadComment');
    Route::post('/instructor/discussions/thread/{thread}/comment/{thread_comment}/reply/{thread_comment_reply}/upvote', 'InstructorDiscussionController@upvoteThreadCommentReply');
    Route::post('/instructor/discussions/thread/{thread}/comment/{thread_comment}/reply/{thread_comment_reply}/downvote', 'InstructorDiscussionController@downvoteThreadCommentReply');
    Route::post('/instructor/discussions/thread/{thread}/comment/{thread_comment}/reply/{thread_comment_reply}/reply/{thread_reply_reply}/upvote', 'InstructorDiscussionController@upvoteThreadReplyReply');
    Route::post('/instructor/discussions/thread/{thread}/comment/{thread_comment}/reply/{thread_comment_reply}/reply/{thread_reply_reply}/downvote', 'InstructorDiscussionController@downvoteThreadReplyReply');
});



Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/learner/discussions', 'LearnerDiscussionController@discussions');
    Route::get('/learner/discussions/threads', 'LearnerDiscussionController@threadData');

    Route::get('/learner/discussions/create', 'LearnerDiscussionController@createDiscussion');
    Route::post('/learner/discussions/create/post', 'LearnerDiscussionController@postDiscussion');
    Route::post('/learner/discussions/create/post-photo', 'LearnerDiscussionController@postPhotoDiscussion');

    Route::get('/learner/discussions/thread/{thread}', 'LearnerDiscussionController@viewThread');
    Route::get('/learner/discussions/thread/{thread}/comments', 'LearnerDiscussionController@viewThreadComments');

    Route::post('/learner/discussions/thread/{thread}/comment', 'LearnerDiscussionController@postComment');
    Route::post('/learner/discussions/thread/{thread}/commentReply', 'LearnerDiscussionController@postCommentReply');
    Route::post('/learner/discussions/thread/{thread}/replyReply', 'LearnerDiscussionController@postReplyReply');

    Route::post('/learner/discussions/thread/{thread}/upvote', 'LearnerDiscussionController@upvoteThread');
    Route::post('/learner/discussions/thread/{thread}/downvote', 'LearnerDiscussionController@downvoteThread');
    Route::post('/learner/discussions/thread/{thread}/comment/{thread_comment}/upvote', 'LearnerDiscussionController@upvoteThreadComment');
    Route::post('/learner/discussions/thread/{thread}/comment/{thread_comment}/downvote', 'LearnerDiscussionController@downvoteThreadComment');
    Route::post('/learner/discussions/thread/{thread}/comment/{thread_comment}/reply/{thread_comment_reply}/upvote', 'LearnerDiscussionController@upvoteThreadCommentReply');
    Route::post('/learner/discussions/thread/{thread}/comment/{thread_comment}/reply/{thread_comment_reply}/downvote', 'LearnerDiscussionController@downvoteThreadCommentReply');
    Route::post('/learner/discussions/thread/{thread}/comment/{thread_comment}/reply/{thread_comment_reply}/reply/{thread_reply_reply}/upvote', 'LearnerDiscussionController@upvoteThreadReplyReply');
    Route::post('/learner/discussions/thread/{thread}/comment/{thread_comment}/reply/{thread_comment_reply}/reply/{thread_reply_reply}/downvote', 'LearnerDiscussionController@downvoteThreadReplyReply');
});


Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/send', 'MailController@index');
});
