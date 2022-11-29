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
Route::get('/user/{id}', [UserController::class, 'getUserData']);
Route::get('/inquiry/{id}', [InquiryController::class, 'getInquiry']);
Route::post('/update_inquiry', [InquiryController::class, 'updateInquiry']);
Route::view('/form_user','create_new_user');
Route::post('/save_new_user', [UserController::class, 'saveUser']);
Route::view('/form_team','create_new_team');
Route::post('/save_new_team', [TeamController::class, 'saveTeam']);
Route::view('/form_project','create_new_project');
Route::post('/save_new_project', [ProjectController::class, 'saveProject']);
Route::view('/form_inquiry/{id}','create_new_inquiry');
Route::post('/save_new_inquiry/{id}', [InquiryController::class, 'saveInquiry']);
//php artisan serve
//php artisan route::list