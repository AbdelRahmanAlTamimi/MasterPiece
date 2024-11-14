<?php

use App\Http\Controllers\DiscussionDestroyController;
use App\Http\Controllers\DiscussionShowController;
use App\Http\Controllers\DiscussionSolutionPatchController;
use App\Http\Controllers\DiscussionStoreController;
use App\Http\Controllers\ForumIndexController;
use App\Http\Controllers\MarkdownController;
use App\Http\Controllers\PostDestroyController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostPatchController;
use App\Http\Controllers\PostStoreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\DiscussionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Welcome Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

/*
|--------------------------------------------------------------------------
| Home Route
|--------------------------------------------------------------------------
*/
Route::get('/', ForumIndexController::class)->name('forum.index');

/*
|--------------------------------------------------------------------------
| Summary Routes
|--------------------------------------------------------------------------
*/
Route::get('/summary', [SummaryController::class, 'index'])->name('summary.index');

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{user}', [UserController::class, 'show'])->name('show');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Topic Routes
|--------------------------------------------------------------------------
*/
Route::prefix('topics')->name('topics.')->group(function () {
    Route::get('/', [TopicController::class, 'index'])->name('index');
    Route::get('/create', [TopicController::class, 'create'])->name('create');
    Route::post('/', [TopicController::class, 'store'])->name('store');
    Route::get('/{topic}', [TopicController::class, 'show'])->name('show');
    Route::get('/{topic}/edit', [TopicController::class, 'edit'])->name('edit');
    Route::put('/{topic}', [TopicController::class, 'update'])->name('update');
    Route::delete('/{topic}', [TopicController::class, 'destroy'])->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Discussion Routes
|--------------------------------------------------------------------------
*/
Route::prefix('discussions')->name('discussions.')->group(function () {
    Route::get('/', [DiscussionController::class, 'index'])->name('index');
    Route::get('/create', [DiscussionController::class, 'create'])->name('create');
    Route::post('/', DiscussionStoreController::class)->name('store');
    Route::get('/{discussion:slug}', DiscussionShowController::class)->name('show');
    Route::get('/{discussion}/edit', [DiscussionController::class, 'edit'])->name('edit');
    Route::put('/{discussion}', [DiscussionController::class, 'update'])->name('update');
    Route::delete('/{discussion}', DiscussionDestroyController::class)->name('destroy');
    Route::patch('/{discussion}/solution', DiscussionSolutionPatchController::class)->name('solution.update');
    Route::post('/{discussion}/posts', PostStoreController::class)->name('posts.store');
});

/*
|--------------------------------------------------------------------------
| Post Routes
|--------------------------------------------------------------------------
*/
Route::prefix('posts')->name('posts.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::patch('/{post}', PostPatchController::class)->name('update');
    Route::delete('/{post}', PostDestroyController::class)->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Markdown Routes
|--------------------------------------------------------------------------
*/
Route::post('/markdown', MarkdownController::class)->name('markdown.parse');

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
