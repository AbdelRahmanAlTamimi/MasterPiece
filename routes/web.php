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
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/', ForumIndexController::class)->name('home');
Route::get('/discussions/{discussion:slug}', DiscussionShowController::class)->name('discussions.show');

// New routes for additional pages
Route::get('/summary', [SummaryController::class, 'index'])->name('summary');

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/topics', [TopicController::class, 'index'])->name('topics');
Route::get('/topics/create', [TopicController::class, 'create'])->name('topics.create');
Route::post('/topics', [TopicController::class, 'store'])->name('topics.store');
Route::get('/topics/{topic}', [TopicController::class, 'show'])->name('topics.show');
Route::get('/topics/{topic}/edit', [TopicController::class, 'edit'])->name('topics.edit');
Route::put('/topics/{topic}', [TopicController::class, 'update'])->name('topics.update');
Route::delete('/topics/{topic}', [TopicController::class, 'destroy'])->name('topics.destroy');

Route::get('/discussions', [DiscussionController::class, 'index'])->name('discussions');
Route::get('/discussions/create', [DiscussionController::class, 'create'])->name('discussions.create');
Route::post('/discussions', [DiscussionController::class, 'store'])->name('discussions.store');
Route::get('/discussions/{discussion}', [DiscussionController::class, 'show'])->name('discussions.show');
Route::get('/discussions/{discussion}/edit', [DiscussionController::class, 'edit'])->name('discussions.edit');
Route::put('/discussions/{discussion}', [DiscussionController::class, 'update'])->name('discussions.update');
Route::delete('/discussions/{discussion}', [DiscussionController::class, 'destroy'])->name('discussions.destroy');

Route::get('/posts', [PostController::class, 'index'])->name('posts');

Route::post('/markdown', MarkdownController::class)->name('markdown');

Route::middleware('auth')->group(function () {
    Route::post('/discussions', DiscussionStoreController::class)->name('discussions.store');
    Route::post('/discussions/{discussion}/posts', PostStoreController::class)->name('posts.store');
    Route::delete('/discussions/{discussion}', DiscussionDestroyController::class)->name('discussions.destroy');
    Route::patch('/discussions/{discussion}/solution', DiscussionSolutionPatchController::class)->name('discussions.solution.patch');

    Route::patch('/posts/{post}', PostPatchController::class)->name('posts.patch');
    Route::delete('/posts/{post}', PostDestroyController::class)->name('posts.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
