<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

Route::middleware('guest')->controller(AuthController::class)->group(function() {
    Route::get('/', 'loginForm')->name('login');

    Route::get('/register', 'registerForm');
    
    Route::post('/register', 'register');
    
    Route::post('/', 'login');
});

Route::middleware('auth')->controller(PostController::class)->prefix('posts')->group(function() {
    Route::get('/all', 'index');

    Route::get('/create', 'create');
    Route::post('/store', 'store');

    Route::get('/manage', 'managePosts');
    Route::post('/ssd', 'serverSideData');
    
    Route::get('/edit/{post}', 'edit');
    Route::put('/update/{post}', 'update');

    Route::delete('/delete/{post}', 'destroy');

    Route::get('/upload-using-csv', 'uploadUsingCSV');
    Route::get('/csv-download', 'downloadSampleCSV');
    Route::post('/upload-using-csv', 'storeUsingCSV');

    Route::put('/publish/{post}', 'publish');
});

Route::post('/logout', [AuthController::class, 'logout']);


