<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Authorization Route

Route::group(['middleware' => ['guest']], function () {
    //login
    Route::get('/', [AuthController::class, 'showLogin'])->name('user#login');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('user#login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/auth/forget_password', [PasswordResetController::class, 'showForgetPwd'])->name('user#forgetPwd');
    //Route::post('/forgetPwd', [PasswordResetController::class, 'generatePwd'])->name('user#generatePwd');
    Route::post('/store_resets', [PasswordResetController::class, 'storeResets'])->name('user#storeResets');
    Route::get('/reset/{token}', [PasswordResetController::class, 'reset'])->name('user#reset');
    Route::post('/reset_update', [PasswordResetController::class, 'resetUpdate'])->name('user#resetUpdate');

});

Route::group(['middleware' => ['auth']], function () {
    //logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('user#logout');

    //user route
    Route::get('/home', [UserController::class, 'homeCount'])->name('home');
    Route::get('/user_edit/{id}', [UserController::class, 'userEdit'])->name('user#edit');
    Route::post('/user/user_edit_confirm/{id}/{profile}', [UserController::class, 'userEditConfirm'])->name('user#editConfirm');
    Route::post('/user_update/{id}', [UserController::class, 'userUpdate'])->name('user#update');
    Route::get('/user/user_profile/{id}', [UserController::class, 'userProfile'])->name('user#profile');
    Route::post('/user/password_change', [UserController::class, 'passwordChange'])->name('user#pwChange');
    Route::get('/user/password_change', function () {
        return view('user.password_change');
    })->name('user#pwChange');

    //post route
    Route::get('/post/post_list', [PostController::class, 'postList'])->name('post#postList');
    Route::get('/post_delete/{id}', [PostController::class, 'postDelete'])->name('post#delete');
    Route::get('/post/post_create', function () {
        return view('post.post_create');
    })->name('post#create');
    Route::post('/post/post_create_confirm', [PostController::class, 'postCreateConfirm'])->name('post#createConfirm');
    Route::post('/post_store', [PostController::class, 'postStore'])->name('post#store');
    Route::get('/post_edit/{id}', [PostController::class, 'postEdit'])->name('post#edit');
    Route::post('/post/post_edit_confirm/{id}', [PostController::class, 'postEditConfirm'])->name('post#editConfirm');
    Route::post('/post_update/{id}', [PostController::class, 'postUpdate'])->name('post#update');
    Route::get('/csv_export', [PostController::class, 'exportCSV'])->name('post#export');
    Route::get('/post/csv_upload', [PostController::class, 'showImportCSV'])->name('post#csv');
    Route::post('/csv_import', [PostController::class, 'importCSV'])->name('post#import');
});

Route::group(['middleware' => ['isAdmin']], function () {
    Route::get('/user/user_create', function () {
        return view('user.user_create');
    })->name('user#create');
    Route::post('/user/user_create_confirm', [UserController::class, 'userCreateConfirm'])->name('user#createConfirm');
    Route::post('/user_store', [UserController::class, 'userStore'])->name('user#store');
    Route::get('/user/user_list', [UserController::class, 'userList'])->name('user#userList');
    Route::get('/user_search', [UserController::class, 'userSearch'])->name('user#search');
    Route::post('/user_delete', [UserController::class, 'userDelete'])->name('user#delete');
});
