<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// MijnStudent landingspage, no login necessary
Route::view('/', 'landing');

// All other routes are only accessable if a user is logged-in
Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/groups_students', [DashboardController::class, 'groups_students'])->name('dash.groups_students');

    Route::post('/groups/favorite', [GroupController::class, 'favorite']);
    Route::resource('groups', GroupController::class);

    Route::resource('comment', CommentsController::class);

    Route::get('students/import', [StudentController::class, 'import_start']);
    Route::post('students/import', [StudentController::class, 'import_process']);

    Route::resource('students', StudentController::class);


});


require __DIR__.'/auth.php';
