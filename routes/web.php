<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [\App\Http\Controllers\FrontendController::class, 'index'])->name('front.index');
Route::get('quiz', [\App\Http\Controllers\FrontendController::class, 'quiz_page'])->name('front.quiz');
Route::get('result', [\App\Http\Controllers\FrontendController::class, 'result_page'])->name('front.result');
Route::get('print/result', [\App\Http\Controllers\FrontendController::class, 'print_result'])->name('front.print.result');
Route::post('user/register', [\App\Http\Controllers\FrontendController::class, 'user_register'])->name('front.user.register');
Route::post('quiz/store', [\App\Http\Controllers\FrontendController::class, 'quiz_store'])->name('front.quiz.store');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [\App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::resource('questions', \App\Http\Controllers\QuestionController::class);
   Route::get('quiz/result', [\App\Http\Controllers\HomeController::class, 'quiz_results'])->name('quiz.result');
});


Route::get('print', function (){
    return view('print_result');
});
