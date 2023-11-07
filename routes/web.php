<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\HayaoshiController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\ImportController;

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
    Route::post('hayaoshi/start', 'start_button_pressed')->name('hayaoshi_start');
    Route::put('/hayaoshi/reset_flag', 'reset_flag')->name('reset_flag');
    Route::get('/hayaoshi/all_used', 'all_used')->name('all_used');
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
    Route::post('/directories/create', 'create')->name('directory_create');
    Route::get('/directories/{directory}', 'show')->name('directory_show');
    Route::put('/directories/{directory}', 'update')->name('directory_update');
    Route::delete('/directories/{directory}', 'delete')->name('directory_delete');
    Route::get('/directories/{directory}/edit', 'edit')->name('directory_edit');
});

Route::controller(ImportController::class)->middleware(['auth'])->group(function(){
    Route::post('/import', 'store')->name('import_store');
    Route::get('/import/prepare', 'prepare')->name('prepare');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/preferences', [ProfileController::class, 'preferences'])->name('profile.preferences');
    Route::post('profile/preferences', [ProfileController::class, 'update_preferences'])->name('profile.update_preferences');
    Route::put('/profile/reset_all_flags', [ProfileController::class, 'reset_all_flags'])->name('profile.reset_all_flags');
});

require __DIR__.'/auth.php';
