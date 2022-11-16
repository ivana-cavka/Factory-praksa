<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/users', [UserController::class, 'getAllUsers']);
Route::get('/teams', [TeamController::class, 'getAllTeams']);
Route::get('/projects', [ProjectController::class, 'getAllProjects']);
Route::get('/inquiries', [InquiryController::class, 'getAllInquiries']);
Route::get('/admin', [AdminController::class, 'getAdminData']);
Route::view('/form_user','create_new_user');
Route::post('/save_new_user', [UserController::class, 'saveUser']);

//php artisan serve
//php artisan route::list