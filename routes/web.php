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
| Welcome Route
|--------------------------------------------------------------------------
*/
//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

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
Route::prefix('users')->middleware(['auth', 'admin'])->name('users.')->group(function () {
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
Route::prefix('topics')->middleware(['auth', 'admin'])->name('topics.')->group(function () {
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
Route::prefix('discussions')->middleware(['auth', 'admin'])->name('discussions.')->group(function () {
    Route::get('/', [DiscussionController::class, 'index'])->name('index');
    Route::get('/create', [DiscussionController::class, 'create'])->name('create');
    Route::get('/{discussion:slug}/edit', [DiscussionController::class, 'edit'])->name('edit');
    Route::put('/{discussion}', [DiscussionController::class, 'update'])->name('update');

});

Route::middleware('auth')->group(function () {
    Route::post('/discussions', DiscussionStoreController::class)->name('discussions.store');
    Route::post('/discussions/{discussion}/posts', PostStoreController::class)->name('posts.store');
    Route::delete('/discussions/{discussion}', DiscussionDestroyController::class)->name('discussions.destroy');
    Route::patch('/discussions/{discussion}/solution', DiscussionSolutionPatchController::class)->name('discussions.solution.patch');
});


Route::get('/discussions/{discussion:slug}', DiscussionShowController::class)->name('discussions.show');



/*
|--------------------------------------------------------------------------
| Post Routes
|--------------------------------------------------------------------------
*/
Route::prefix('posts')->middleware(['auth', 'admin'])->name('posts.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/{post}', [PostController::class, 'show'])->name('show');
    Route::delete('/{post}', [PostController::class, 'destroy'])->name('delete');
});

Route::middleware('auth')->group(function () {
    Route::patch('/posts/{post}', PostPatchController::class)->name('posts.patch');
    Route::delete('/posts/{post}', PostDestroyController::class)->name('posts.destroy');
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




//use App\Http\Controllers\{
//    DiscussionDestroyController,
//    DiscussionShowController,
//    DiscussionSolutionPatchController,
//    DiscussionStoreController,
//    ForumIndexController,
//    MarkdownController,
//    PostDestroyController,
//    PostController,
//    PostPatchController,
//    PostStoreController,
//    ProfileController,
//    SummaryController,
//    UserController,
//    TopicController,
//    DiscussionController
//};
//use Illuminate\Foundation\Application;
//use Illuminate\Support\Facades\Route;
//use Inertia\Inertia;
//
///*
//|--------------------------------------------------------------------------
//| Web Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register web routes for your application. These
//| routes are loaded by the RouteServiceProvider within a group which
//| contains the "web" middleware group. Now create something great!
//|
//*/
//
//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});
//
//Route::get('/', ForumIndexController::class)->name('home');
//Route::get('/discussions/{discussion:slug}', DiscussionShowController::class)->name('discussions.show');
//
//// New routes for additional pages
//Route::get('/summary', [SummaryController::class, 'index'])->name('summary');
//
//Route::prefix('users')->name('users.')->group(function () {
//    Route::get('/', [UserController::class, 'index'])->name('index');
//    Route::get('/create', [UserController::class, 'create'])->name('create');
//    Route::post('/', [UserController::class, 'store'])->name('store');
//    Route::get('/{user}', [UserController::class, 'show'])->name('show');
//    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
//    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
//});
//
//Route::prefix('topics')->name('topics.')->group(function () {
//    Route::get('/', [TopicController::class, 'index'])->name('index');
//    Route::get('/create', [TopicController::class, 'create'])->name('create');
//    Route::post('/', [TopicController::class, 'store'])->name('store');
//    Route::get('/{topic}', [TopicController::class, 'show'])->name('show');
//    Route::get('/{topic}/edit', [TopicController::class, 'edit'])->name('edit');
//    Route::put('/{topic}', [TopicController::class, 'update'])->name('update');
//    Route::delete('/{topic}', [TopicController::class, 'destroy'])->name('destroy');
//});
//
//Route::prefix('discussions')->name('discussions.')->group(function () {
//    Route::get('/', [DiscussionController::class, 'index'])->name('index');
//    Route::get('/create', [DiscussionController::class, 'create'])->name('create');
//    Route::post('/', [DiscussionController::class, 'store'])->name('store');
//    Route::get('/{discussion}/edit', [DiscussionController::class, 'edit'])->name('edit');
//    Route::put('/{discussion}', [DiscussionController::class, 'update'])->name('update');
//    Route::delete('/{discussion}', [DiscussionController::class, 'destroy'])->name('destroy');
//});
//
//Route::get('/posts', [PostController::class, 'index'])->name('posts');
//Route::post('/markdown', MarkdownController::class)->name('markdown');
//
//Route::middleware('auth')->group(function () {
//    Route::post('/discussions', DiscussionStoreController::class)->name('discussions.store');
//    Route::post('/discussions/{discussion}/posts', PostStoreController::class)->name('posts.store');
//    Route::delete('/discussions/{discussion}', DiscussionDestroyController::class)->name('discussions.destroy');
//    Route::patch('/discussions/{discussion}/solution', DiscussionSolutionPatchController::class)->name('discussions.solution.patch');
//    Route::patch('/posts/{post}', PostPatchController::class)->name('posts.patch');
//    Route::delete('/posts/{post}', PostDestroyController::class)->name('posts.destroy');
//
//    Route::prefix('profile')->name('profile.')->group(function () {
//        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
//        Route::patch('/', [ProfileController::class, 'update'])->name('update');
//        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
//    });
//});
//
//require __DIR__ . '/auth.php';
