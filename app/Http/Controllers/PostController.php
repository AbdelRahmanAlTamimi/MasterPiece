<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::with('user', 'discussion')
            ->select('posts.id','users.name as username', 'discussions.title as discussion_title')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->join('discussions', 'posts.discussion_id', '=', 'discussions.id')
            ->get();

        return Inertia::render('Forum/Posts', [
            'posts' => $posts,
        ]);
    }

    public function show(Post $post)
    {

        $post->load('user', 'discussion');

        return Inertia::render('Forum/PostDetails', [
            'post' => [
                'id' => $post->id,
                'body' => $post->body,
                'createdAt' => $post->created_at->format('M d, Y'),
                'username' => $post->user->name,
                'discussionTitle' => $post->discussion->title,
            ],
            'flash' => [
                'success' => session('success'),
                'error' => session('error'),
            ],
        ]);
    }

    public function destroy(Post $post)
    {


        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
