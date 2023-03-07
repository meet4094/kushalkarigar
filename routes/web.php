<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\MasterController;
use App\Http\Middleware\Authenticate;

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

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'login');
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'login_data');
    Route::get('/change_password_form', 'change_password_form')->name('change_password_form');
    Route::post('change_password', 'change_password');
    Route::get('/logout', 'logout');
});
// Auth::routes();
Route::middleware([Authenticate::class])->group(function () {
    Route::view('/dashboard', 'Admin/dashboard', ['title' => 'dashboard']);
    Route::controller(MasterController::class)->group(function () {

        Route::get('/employer_list', 'employer_list')->name('employer_list');
        Route::post('/block_employer', 'block_employer');
        Route::post('/GetEmployerData', 'GetEmployerData');
        Route::post('/edit_employer', 'edit_employer');
        Route::post('/deleteEmployer', 'deleteEmployer');

        Route::get('/employee_list', 'employee_list')->name('employee_list');
        Route::post('/block_employee', 'block_employee');
        Route::post('/GetEmployeeData', 'GetEmployeeData');
        Route::post('/edit_employee', 'edit_employee');
        Route::post('/deleteEmployee', 'deleteEmployee');

        Route::get('/job_type', 'job_type')->name('job_type');
        Route::post('/add_job', 'add_job');
        Route::post('/GetJobData', 'GetJobData');
        Route::post('/deleteJob', 'deleteJob');

        Route::get('/skill_set', 'skill_set')->name('skill_set');
        Route::post('/add_skill', 'add_skill');
        Route::post('/GetSkillData', 'GetSkillData');
        Route::post('/deleteSkill', 'deleteSkill');

        Route::get('/work_experience', 'work_experience')->name('work_experience');
        Route::post('/add_experience', 'add_experience');
        Route::post('/GetExperienceData', 'GetExperienceData');
        Route::post('/deleteExperience', 'deleteExperience');
    });
});
