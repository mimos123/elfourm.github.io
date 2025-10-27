<?php

use App\Models\Jpo;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JpoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RespController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyRegisterController;

Route::get('/', function () {
    $recentEvents = Jpo::with('tags')  // Eager load the tags along with events
                          ->orderBy('created_at', 'desc')
                          ->take(2)
                          ->get();

    return view('welcome', ['recentEvents' => $recentEvents]);
});
Route::get('/companyregister', [CompanyRegisterController::class, 'showRegistrationForm'])->name('companyregister');
Route::post('/companyregister', [CompanyRegisterController::class, 'register']);



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/managers', [RespController::class, 'index'])->name('managers.index');
Route::get('/addmanagers', [RespController::class, 'add'])->name('managers.add');
Route::post('/addmanagers', [RespController::class, 'store'])->name('managers.store');
Route::get('/editmanager/{id}', [RespController::class, 'edit'])->name('edit.manager');
Route::put('/updatemanager/{id}', [RespController::class, 'update'])->name('update.manager');
Route::delete('/deletemanager/{id}', [RespController::class, 'destroy'])->name('delete.manager');


Route::post('/events/{event}/attend', [JpoController::class ,'attend'])->name('events.attend');

Route::get('/events', [JpoController::class, 'index'])->name('event.index');
Route::get('/events/create', [JpoController::class, 'create'])->name('event.create');
Route::post('/events', [JpoController::class, 'store'])->name('events.store');
Route::get('/events/{event}/edit', [JpoController::class, 'edit'])->name('events.edit');
Route::put('/events/{event}', [JpoController::class, 'update'])->name('events.update');
Route::delete('/events/{event}', [JpoController::class , 'destroy'])->name('events.destroy');





Route::get('/companies',[RespController::class, 'companyList'])->name('company.list');
Route::get('/attendance/{userId}', [RespController::class, 'acceptCompany'])->name('attendance.update');
  //リスト表示用


Route::get('/post/apply/{post}', [PostController::class, 'apply'])->name('post.apply');
Route::post('/post/apply/{post}', [PostController::class, 'submitApplication'])->name('post.apply.submit');
Route::get('/events/{event}/feed', [PostController::class, 'showFeed'])->name('events.feed');
Route::get('/events/{event}/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('/events/{event}/post', [PostController::class, 'store'])->name('post.store');


Route::get('/company/add', [CompanyRegisterController::class, 'showAddCompanyForm'])->name('company.add');
Route::post('/company/add', [CompanyRegisterController::class, 'addCompany'])->name('company.add.submit');



Route::get('/user/applications', [PostController::class, 'userApplications'])->name('user.applications');

Route::post('/profile/update-picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.updatePicture');
Route::resource('post', PostController::class);


Route::middleware('auth')->group(function () {
    Route::get('company-attendances', [JpoController::class, 'pendingAttendances'])->name('jpo.pending-attendances');
    Route::post('event/{event}/update-attendance/{user}', [JpoController::class, 'updateAttendanceStatus'])->name('jpo.update-attendance');
    Route::post('event/{event}/attend', [JpoController::class, 'attend'])->name('jpo.attend');
});

Route::middleware('auth')->group(function () {

Route::get('/my-posts', [PostController::class, 'showMyPosts'])->name('posts.index');
Route::get('/applications', [PostController::class, 'showMyPostApplications'])->name('applications.index');
Route::get('/applications/{application}/download', [PostController::class, 'downloadCv'])->name('application.downloadCv');
Route::post('/application/{id}/accept', [PostController::class, 'accept'])->name('application.accept');
Route::post('/application/{id}/reject', [PostController::class, 'reject'])->name('application.reject');
});





require __DIR__.'/auth.php';
