<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\MarksController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\TimetablesController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/attendance',[AttendanceController::class,'show_attendance'])->name('attendance');
Route::post('/reports/send_attendance', [AttendanceController::class,'send_attendance'])->name('send_attendance');
Route::get('/reports/export_excel_attendance', [AttendanceController::class,'exportIntoExcel'])->name('export_excel_attendance');
Route::get('/marks',[MarksController::class,'show_marks'])->name('marks');
Route::get('/marks/students',[MarksController::class,'show_marks'])->name('marks_students');
Route::post('/marks/students_submit',[MarksController::class,'show_marks_submit'])->name('marks_students_submit');

Route::get('/results/import_excel', 'ImportResultsExcelController@index');
Route::post('/results/import_excel/import', [App\Http\Controllers\ImportResultsExcelController::class , 'import'])->name('import_result');
Route::get('/reports/export_excel_results', [MarksController::class,'exportIntoExcel'])->name('export_excel_results');

Route::get('/management', function () {
    return view('management');
})->name('management');

Route::get('/management/classes',[ClassesController::class,'show_classes'])->name('mgclasses');
Route::get('/management/classes/add_classes',[ClassesController::class,'show_add_classes'])->name('add_mgclasses');
Route::post('/management/classes/add_classes/submit',[ClassesController::class,'add_classes'])->name('add_mgclasses_submit');
Route::post('/management/classes/edit_classes/submit',[ClassesController::class,'edit_classes_submit'])->name('edit_mgclasses_submit');
Route::get('/management/classes/edit_classes',[ClassesController::class,'edit_classes'])->name('edit_mgclasses');
Route::get('/management/classes/edit_classes/submit',[ClassesController::class,'edit_classes_submit'])->name('edit_mgclasses_submit');
Route::get('/management/classes/delete_classes',[ClassesController::class,'delete_classes'])->name('delete_mgclasses');


Route::get('/management/classes/students',[ClassesController::class,'show_classes_students'])->name('mgclasses_students');

Route::get('/management/teachers',[TeachersController::class,'show_teachers'])->name('mgteachers');
Route::get('/management/teachers/add_teachers',[TeachersController::class,'show_add_teachers'])->name('add_mgteachers');
Route::post('/management/teachers/add_teachers/submit',[TeachersController::class,'add_teachers'])->name('add_mgteachers_submit');
Route::post('/management/teachers/edit_teachers/submit',[TeachersController::class,'edit_teachers_submit'])->name('edit_mgteachers_submit');
Route::get('/management/teachers/edit_teachers',[TeachersController::class,'edit_teachers'])->name('edit_mgteachers');
Route::get('/management/teachers/edit_teachers/submit',[TeachersController::class,'edit_teachers_submit'])->name('edit_mgteachers_submit');
Route::get('/management/teachers/delete_teachers',[TeachersController::class,'delete_teachers'])->name('delete_mgteachers');

Route::get('/management/students',[StudentsController::class,'show_students'])->name('mgstudents');
Route::get('/management/students/add_students',[StudentsController::class,'show_add_students'])->name('add_mgstudents');
Route::post('/management/students/add_students/submit',[StudentsController::class,'add_students'])->name('add_mgstudents_submit');
Route::get('/management/students/edit_students',[StudentsController::class,'edit_students'])->name('edit_mgstudents');
Route::post('/management/students/edit_students/submit',[StudentsController::class,'edit_students_submit'])->name('edit_mgstudents_submit');
Route::get('/management/students/delete_students',[StudentsController::class,'delete_students'])->name('delete_mgstudents');


Route::get('/students/import_excel', 'ImportStudentsExcelController@index');
Route::post('/students/import_excel/import', [App\Http\Controllers\ImportStudentsExcelController::class , 'import'])->name('import_student');

Route::get('/management/subjects',[SubjectsController::class,'show_subjects'])->name('mgsubjects');Route::get('/management/subjects/add_subjects',[SubjectsController::class,'show_add_subjects'])->name('add_mgsubjects');
Route::post('/management/subjects/add_subjects/submit',[SubjectsController::class,'add_subjects'])->name('add_mgsubjects_submit');
Route::post('/management/subjects/edit_subjects/submit',[SubjectsController::class,'edit_subjects_submit'])->name('edit_mgsubjects_submit');
Route::get('/management/subjects/edit_subjects',[SubjectsController::class,'edit_subjects'])->name('edit_mgsubjects');
Route::get('/management/subjects/edit_subjects/submit',[SubjectsController::class,'edit_subjects_submit'])->name('edit_mgsubjects_submit');
Route::get('/management/subjects/delete_subjects',[SubjectsController::class,'delete_subjects'])->name('delete_mgsubjects');

Route::get('/results', [MarksController::class,'show_results'])->name('results');

Route::get('/reports', [MarksController::class,'show_reports'])->name('reports');
Route::post('/reports/send_reports', [MarksController::class,'send_reports'])->name('send_reports');

Route::get('/timetable', [TimetablesController::class,'show_timetables'])->name('timetable');
Route::get('/timetable/add_timetable', [TimetablesController::class,'show_add_timetable'])->name('add_timetable');
Route::post('/timetable/add_timetable_submit', [TimetablesController::class,'show_add_timetable'])->name('add_timetable_submit');
Route::get('/timetable/edit_timetable', [TimetablesController::class,'show_edit_timetable'])->name('edit_timetable');
Route::post('/timetable/edit_timetable_submit', [TimetablesController::class,'show_edit_timetable'])->name('edit_timetable_submit');
Route::get('/timetable/delete_timetable', [TimetablesController::class,'delete_timetable'])->name('delete_timetable');


Route::get('/profile', function () {
    return view('profile');
});

Route::get('/settings/passwordchange',[SettingsController::class,'show_passwordchange'])->name('show_passwordchange');

Route::post('/changePassword',[SettingsController::class,'passwordchange'])->name('passwordchange');

Route::post('/logout','Auth\LoginController@logout')->name('logout');

Route::get('/dashboard',[DashboardController::class,'show_dashboard'])->name('dashboard');

require __DIR__.'/auth.php';
