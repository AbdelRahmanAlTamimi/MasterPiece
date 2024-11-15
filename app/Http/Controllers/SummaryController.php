<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topic;
use App\Models\Discussion;
use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SummaryController extends Controller
{
    public function index()
    {
        // Get discussion solution stats
        $discussionStats = [
            'solved' => Discussion::whereNotNull('solution_post_id')->count(),
            'unsolved' => Discussion::whereNull('solution_post_id')->count(),
        ];

        // Get topics with discussion counts
        $topicDiscussions = Topic::select('topics.title', DB::raw('COUNT(discussions.id) as discussion_count'))
            ->leftJoin('discussions', 'topics.id', '=', 'discussions.topic_id')
            ->groupBy('topics.id', 'topics.title')
            ->orderBy('discussion_count', 'desc')
            ->limit(5)
            ->get();

        return Inertia::render('Forum/Summary', [
            'stats' => [
                'totalUsers' => User::count(),
                'totalTopics' => Topic::count(),
                'totalDiscussions' => Discussion::count(),
                'totalPosts' => Post::count(),
                'discussionStats' => $discussionStats,
                'topicDiscussions' => $topicDiscussions,
            ]
        ]);
    }
}
