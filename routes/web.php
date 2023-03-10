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
    Route::controller(MasterController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');

        Route::get('/employer_list', 'employer_list')->name('employer_list');
        Route::get('/employer_profile_view/{id}', 'employer_profile_view')->name('employer_profile_view');
        Route::post('/block_employer', 'block_employer');
        Route::post('/GetEmployerData', 'GetEmployerData');
        Route::post('/edit_employer', 'edit_employer');
        Route::post('/deleteEmployer', 'deleteEmployer');
        
        Route::get('/employee_list', 'employee_list')->name('employee_list');
        Route::get('/employee_profile_view/{id}', 'employee_profile_view')->name('employee_profile_view');
        Route::post('/block_employee', 'block_employee');
        Route::post('/GetEmployeeData', 'GetEmployeeData');
        Route::post('/edit_employee', 'edit_employee');
        Route::post('/deleteEmployee', 'deleteEmployee');

        Route::get('/job_type', 'job_type')->name('job_type');
        Route::post('/add_job', 'add_job');
        Route::post('/GetJobData', 'GetJobData');
        Route::post('/deleteJob', 'deleteJob');
        Route::post('/get_type_of_job', 'get_type_of_job');

        Route::get('/skill_set', 'skill_set')->name('skill_set');
        Route::post('/add_skill', 'add_skill');
        Route::post('/GetSkillData', 'GetSkillData');
        Route::post('/deleteSkill', 'deleteSkill');
        Route::post('/get_skill_set', 'get_skill_set');

        Route::get('/work_experience', 'work_experience')->name('work_experience');
        Route::post('/add_experience', 'add_experience');
        Route::post('/GetExperienceData', 'GetExperienceData');
        Route::post('/deleteExperience', 'deleteExperience');
        Route::post('/get_work_experiences', 'get_work_experiences');

        Route::get('/expected_salary_range', 'expected_salary_range')->name('expected_salary_range');
        Route::post('/add_salary_range', 'add_salary_range');
        Route::post('/GetSelaryRangeData', 'GetSelaryRangeData');
        Route::post('/deleteSelaryRange', 'deleteSelaryRange');
        Route::post('/get_expected_salary_range', 'get_expected_salary_range');
    });
});
