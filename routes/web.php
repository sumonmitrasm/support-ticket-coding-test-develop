<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Front\IndexsController;
use App\Http\Controllers\Front\UserController;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
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
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

Route::namespace('App\Http\Controllers\Admin')->prefix('/admin')->group(function(){
    Route::match(['get','post'],'login','AdminController@login');
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>Middleware Create<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    Route::group(['middleware'=>['admin']],function(){
        Route::get('dashboard','AdminController@dashboard');
        Route::get('logout','AdminController@logout');
        Route::match(['get','post'],'update-admin-password','AdminController@updateAdminPassword');
        Route::match(['get','post'],'update-admin-details','AdminController@updateAdmindetails');
        Route::post('check-current-password','AdminController@checkCurrentPassword');
        Route::get('admins/{type?}','AdminController@admins');  //..........admin/subadmin/vendor url..........v21
        Route::post('update-admin-status','AdminController@updateAdminStatus');  //.........admin_status.......v22
        Route::match(['get','post'],'add-edit-staff/{id?}','AdminController@addEditStuff');

        //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>Post Details<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
        Route::get('/post', [PostController::class, 'post'])->name('post');
        Route::any('/add-edit-post/{id?}', [PostController::class, 'addEditPost'])->name('add-edit-post');
        Route::any('/update-post-status', [PostController::class, 'updatePostStatus'])->name('update-post-status');
        Route::any('/delete-post/{id}', [PostController::class, 'deletePost'])->name('delete-post');
        Route::any('/see-ticket-issue', [PostController::class, 'seeTicketIssue'])->name('see-ticket-issue');
    });
});


//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>Front Customer<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Route::namespace('App\Http\Controllers\Front')->group(function(){
    Route::get('/', [IndexsController::class, 'index'])->name('index');
    Route::get('about','AboutController@about');
    Route::get('/about-details/{id}','AboutController@aboutDetail');
    //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>Front Authantication<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    Route::any('login-customer', [UserController::class, 'logincustpmer'])->name('login-customer');
    Route::any('register-customer', [UserController::class, 'registercustpmer'])->name('register-customer');
    Route::any('check-login-form', [UserController::class, 'checkLoginForm'])->name('check-login-form');
    Route::any('save-register-user', [UserController::class, 'saveRegisterUser'])->name('save-register-user');
    Route::match(['GET','POST'],'/confirm/{code}', 'UserController@confirmAccount');
    
    Route::group(['middleware'=>['auth']],function(){
       Route::any('customer-logout', [UserController::class, 'customerLogout'])->name('customer-logout');
       Route::any('send-message/{id?}', [IndexsController::class, 'sendmessage'])->name('send-message');
       //>>>>>>>>>>>>>>>>>>>>>>>>>>>>>Customer Issue Submit<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
       Route::any('issue-submit', [IndexsController::class, 'issueSubmit'])->name('issue-submit');
    });
});