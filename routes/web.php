<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

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

Route::get('/index', function () {
    return view('frontend.index');
});

Route::get('/index', [QuestionController::class, 'home'])->name('index');
Route::post('/submit', [QuestionController::class, 'indexQuiz'])->middleware(ProtectAgainstSpam::class)->name('submit');

// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [QuestionController::class, 'show'])->name('dashboard');
    Route::get('/question', [QuestionController::class, 'index'])->name('question.index');
    Route::get('/question-add', [QuestionController::class, 'create'])->name('question.add');
    Route::post('/question-store', [QuestionController::class, 'store'])->name('question.store');
    Route::get('/question-edit/{id}', [QuestionController::class, 'edit'])->name('question.edit');
    Route::put('/question-update', [QuestionController::class, 'update'])->name('question.update');
    Route::delete('/question-delete/{id}', [QuestionController::class, 'destroy'])->name('question.delete');

    Route::get('/gift', [GiftController::class, 'index'])->name('gift.index');
    Route::get('/gift-add', [GiftController::class, 'create'])->name('gift.add');
    Route::post('/gift-store', [GiftController::class, 'store'])->name('gift.store');
    Route::get('/gift-edit/{id}', [GiftController::class, 'edit'])->name('gift.edit');
    Route::put('/gift-update', [GiftController::class, 'update'])->name('gift.update');
    Route::delete('/gift-delete/{id}', [GiftController::class, 'destroy'])->name('gift.delete');

    Route::put('/gift-pick/{id}', [QuestionController::class, 'giftPick'])->name('gift.pick');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
