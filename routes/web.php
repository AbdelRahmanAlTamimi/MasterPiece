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
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| Home Route
|--------------------------------------------------------------------------
*/
Route::get('/', ForumIndexController::class)->name('home');

/*
|--------------------------------------------------------------------------
| Summary Routes
|--------------------------------------------------------------------------
*/
Route::get('/summary', [SummaryController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('summary');

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
    Route::get('/users', [UserController::class, 'index'])->middleware(['auth', 'admin'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->middleware(['auth', 'admin'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->middleware(['auth', 'admin'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->middleware(['auth', 'admin'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->middleware(['auth', 'admin'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware(['auth', 'admin'])->name('users.destroy');


/*
|--------------------------------------------------------------------------
| Topic Routes
|--------------------------------------------------------------------------
*/
    Route::get('/topics', [TopicController::class, 'index'])->middleware(['auth', 'admin'])->name('topics.index');
    Route::get('/topics/create', [TopicController::class, 'create'])->middleware(['auth', 'admin'])->name('topics.create');
    Route::post('/topics', [TopicController::class, 'store'])->middleware(['auth', 'admin'])->name('topics.store');
    Route::get('/topics/{topic}', [TopicController::class, 'show'])->middleware(['auth', 'admin'])->name('topics.show');
    Route::get('/topics/{topic}/edit', [TopicController::class, 'edit'])->middleware(['auth', 'admin'])->name('topics.edit');
    Route::put('/topics/{topic}', [TopicController::class, 'update'])->middleware(['auth', 'admin'])->name('topics.update');
    Route::delete('/topics/{topic}', [TopicController::class, 'destroy'])->middleware(['auth', 'admin'])->name('topics.destroy');


/*
|--------------------------------------------------------------------------
| Discussion Routes
|--------------------------------------------------------------------------
*/
    Route::get('/discussions', [DiscussionController::class, 'index'])->middleware(['auth', 'admin'])->name('discussions.index');
    Route::get('/discussions/create', [DiscussionController::class, 'create'])->middleware(['auth', 'admin'])->name('discussions.create');
    Route::get('/discussions/{discussion:slug}/edit', [DiscussionController::class, 'edit'])->middleware(['auth', 'admin'])->name('discussions.edit');
    Route::put('/discussions/{discussion}', [DiscussionController::class, 'update'])->middleware(['auth', 'admin'])->name('discussions.update');



    Route::post('/discussions', DiscussionStoreController::class)->name('discussions.store');
    Route::post('/discussions/{discussion}/posts', PostStoreController::class)->name('posts.store');
    Route::delete('/discussions/{discussion}', DiscussionDestroyController::class)->name('discussions.destroy');
    Route::patch('/discussions/{discussion}/solution', DiscussionSolutionPatchController::class)->name('discussions.solution.patch');



    Route::get('/discussions/{discussion:slug}', DiscussionShowController::class)->name('discussions.show');



/*
|--------------------------------------------------------------------------
| Post Routes
|--------------------------------------------------------------------------
*/
    Route::get('/posts', [PostController::class, 'index'])->middleware(['auth', 'admin'])->name('posts.index');
    Route::get('/posts/{post}', [PostController::class, 'show'])->middleware(['auth', 'admin'])->name('posts.show');
    Route::delete('/posts/delete/{post}', [PostController::class, 'destroy'])->middleware(['auth', 'admin']);


Route::middleware('auth')->group(function () {
    Route::patch('/posts/{post}', PostPatchController::class)->name('posts.patch');
    Route::delete('/posts/{post}', PostDestroyController::class)->name('posts.destroy');
});

/*
|--------------------------------------------------------------------------
| Markdown Routes
|--------------------------------------------------------------------------
*/
Route::post('/markdown', MarkdownController::class)->name('markdown');

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/
    Route::get('/profile', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->middleware('auth')->name('profile.destroy');



