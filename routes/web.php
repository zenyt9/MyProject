<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\CourseSelectionController;

// Welcome page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Resource routes
Route::resource('angi', SchoolClassController::class);
Route::resource('teacher', TeacherController::class);
Route::resource('hicheel', SubjectController::class);
Route::resource('student', StudentController::class);
Route::resource('elselt', EnrollmentController::class);
Route::resource('hicheel_songolt', CourseSelectionController::class);



