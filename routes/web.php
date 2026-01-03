<?php

use App\Http\Controllers\Admin\AnswerOptionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ElementController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UnorController;
use App\Http\Controllers\Admin\SkmController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Landing Page (Inertia React)
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

Route::get('/survey', [SurveyController::class, 'index'])->name('survey');
Route::get('/survey/{uuid}/services', [SurveyController::class, 'services'])->name('survey.services');
Route::get('/survey/{uuid}/{serviceId}/form', [SurveyController::class, 'form'])->name('survey.form');
Route::post('/survey/{uuid}/{serviceId}/store', [SurveyController::class, 'store'])->name('survey.store');
Route::get('/survey/{uuid}/{serviceId}/{respondentUuid}/questionnaire', [SurveyController::class, 'questionnaire'])->name('survey.questionnaire');
Route::post('/survey/submit', [SurveyController::class, 'submit'])->name('survey.submit');


Route::get('/tentang', fn() => Inertia::render('about'))->name('about');


// Routing lama
Route::get('/kuesioner/survei/{uuid}', [SurveyController::class, 'servicesv1'])->name('survey.servicesv1');
Route::get('/kuesioner/survei/{uuid}/{serviceId}', [SurveyController::class, 'formv1'])->name('survey.formv1');

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });


Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard.index');

    Route::resource('/element', ElementController::class)->names('admin.element');
    Route::resource('/answer-option', AnswerOptionController::class)->names('admin.answer_option');
    Route::resource('/question', QuestionController::class)->names('admin.question');
    Route::resource('/unor', UnorController::class)->names('admin.unor');

    Route::resource('/skm', SkmController::class)->names('admin.skm');
    Route::match(['get', 'post'], '/skm/{skm}', [SkmController::class, 'show'])
        ->name('admin.skm.show');
    Route::resource('/skm.service', ServiceController::class)->names('admin.service');
});

require __DIR__ . '/auth.php';
