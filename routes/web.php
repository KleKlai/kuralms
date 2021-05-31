<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\ManagementController;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Str;
use App\Models\Classroom;
use App\Models\User;

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::get('/set/role/{role}', [RoleController::class, 'setRole'])->name('set.role');

Route::resource('/classroom', ClassroomController::class);
Route::post('/classroom/join', [ClassroomController::class, 'join'])->name('classroom.join');
Route::get('/classroom/unenroll/{user}/{classroom}', [ClassroomController::class, 'unenroll'])->name('classroom.unenroll');
Route::get('/classroom/archive/{classroom}', [ClassroomController::class, 'archive'])->name('classroom.archive');
Route::get('/archive/index', [ClassroomController::class, 'indexArchive'])->name('classroom.archive.index');
Route::get('/classDelete/restore/{classroom}', function($classroom) {
    // dd('test success');

    Classroom::withTrashed()->find($classroom)->restore();

    return redirect()->back();
})->name('restore');

Route::get('/post/create/{classroom}/{type}', [PostController::class, 'create'])->name('post.create.view');
Route::get('/post/show/{post}/{classroom}', [PostController::class, 'show'])->name('post.show');
Route::post('/post/create/{classroom}', [PostController::class, 'store'])->name('post.create');
Route::get('/F9vk3-Fvds/materials/{classroom}', [PostController::class, 'indexMaterial'])->name('view.material');
Route::get('/F3oFk-vlKf/post/edit/{post}/{classroom}', [PostController::class, 'edit'])->name('post.edit');
Route::patch('/F3oFk-vlKf/post/edit/{post}', [PostController::class, 'update'])->name('post.update');
Route::delete('/F3oFk-vlKf/post/delete/{post}', [PostController::class, 'destroy'])->name('post.delete');
Route::get('/F3f1k2G/post/activity/{classroom}', [PostController::class, 'indexActivity'])->name('post.activity.index');
Route::get('/F30kFc/post/activity/{classroom}', [PostController::class, 'createActivity'])->name('post.activity.view');
Route::post('/F30kFc/post/activity/{classroom}', [PostController::class, 'storeActivity'])->name('post.activity.store');

Route::get('/download/{mediaItem}', function (Media $mediaItem) {
    return response()->download($mediaItem->getPath(), $mediaItem->file_name);
})->name('download.file');

Str::random();
Route::get('/{token}/management/index/{classroom}', [ManagementController::class, 'index'])->name('management.index');
Route::get('/management/removeStudent/{classroom}/{user}', [ManagementController::class, 'removeStudent'])->name('management.removeStudent');

Route::resource('/grade', GradeController::class);
Route::post('/submission/{post}', [SubmissionController::class, 'store'])->name('submission.store');
Route::get('/submission/Post-Submission/{post}', [SubmissionController::class, 'postSubmission'])->name('submission.post.index');
Route::get('/submission/show-student-submission/{submission}', [SubmissionController::class, 'show'])->name('submission.show-specific');
Route::delete('/submission/delete-student-submission/{submission}', [SubmissionController::class, 'destroy'])->name('submission.delete');
Route::patch('/submission/update-details/{submission}', [SubmissionController::class, 'update'])->name('submission.update-detail');
Route::get('/management/submission-list/{classroom}/{user}', [ManagementController::class, 'showStudentSubmissions'])->name('management.studentSubmissions');



Route::get('/markAllRead', function(){

	auth()->user()->unreadNotifications->markAsRead();
	return redirect()->back();

})->name('markAllAsRead');


