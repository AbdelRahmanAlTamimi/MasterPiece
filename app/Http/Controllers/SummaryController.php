<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topic;
use App\Models\Discussion;
use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function index()
    {
        // Retrieve the counts
        $userCount = User::count();
        $topicCount = Topic::count();
        $discussionCount = Discussion::count();
        $postCount = Post::count();

        // Pass the counts to the Inertia view
        return Inertia::render('Forum/Summary', [
            'userCount' => $userCount,
            'topicCount' => $topicCount,
            'discussionCount' => $discussionCount,
            'postCount' => $postCount,
        ]);
    }
}
