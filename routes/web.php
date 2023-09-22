<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\HayaoshiController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\DirectoryController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(QuizController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('index');
    Route::post('/quizzes', 'store')->name('store');
    Route::get('/quizzes/create', 'create')->name('create');
    Route::get('/quizzes/{quiz}', 'show')->name('show');
    Route::put('/quizzes/{quiz}', 'update')->name('update');
    Route::delete('quizzes/{quiz}', 'delete')->name('delete');
    Route::get('/quizzes/{quiz}/edit', 'edit')->name('edit');
});

Route::controller(HayaoshiController::class)->middleware(['auth'])->group(function(){
    Route::get('/hayaoshi', 'hayaoshi_portal')->name('hayaoshi_portal');
    Route::post('hayaoshi/select', 'hayaoshi_select')->name('hayaoshi_select');
    Route::put('/hayaoshi/reset_flag', 'reset_flag')->name('reset_flag');
    Route::get('/hayaoshi/{quiz}', 'hayaoshi')->name('hayaoshi');
    Route::post('/hayaoshi/{quiz}/correct', 'correct')->name('correct');
    Route::post('/hayaoshi/{quiz}/wrong', 'wrong')->name('wrong');
});

Route::controller(TagController::class)->middleware(['auth'])->group(function(){
    Route::get('/tags', 'tag_manager')->name('tag_manager');
    Route::post('/tags', 'store')->name('store_tag');
    Route::delete('/tags/{tag}', 'delete')->name('delete_tag');
    Route::put('/tags/{tag}', 'update')->name('update_tag');
    Route::get('/tags/{tag}/edit', 'edit')->name('edit_tag');
});

Route::controller(DirectoryController::class)->middleware(['auth'])->group(function(){
    Route::get('/directories', 'directory_manager')->name('directory_manager');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
