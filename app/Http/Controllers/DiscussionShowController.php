<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiscussionResource;
use App\Http\Resources\PostResource;
use App\Models\Discussion;
use App\Models\Post;
use Illuminate\Http\Request;

class DiscussionShowController extends Controller
{
    protected const POSTS_PER_PAGE = 2;

    public function __invoke(Request $request, Discussion $discussion)
    {
        if ($postId = $request->get('post')) {
            return redirect()->route('discussions.show', [
                'discussion' => $discussion,
                'page' => $this->getPageForPost($discussion, $postId),
                'postId' => $postId
            ]);
        }

        $discussion->load(['topic', 'posts.discussion']);
        $discussion->loadCount('replies');

        return inertia()->render('Forum/Show', [
            'query' => $request->query(),
            'discussion' => DiscussionResource::make($discussion),
            'posts' => PostResource::collection(
                Post::whereBelongsTo($discussion)
                    ->with(['user', 'discussion'])
                    ->oldest()
                    ->paginate(self::POSTS_PER_PAGE)
            ),
        ]);
    }

    protected function getPageForPost(Discussion $discussion, $postId)
    {
        $index = $discussion->posts->search(fn ($post) => $post->id == $postId);
        $page = (int) ceil(($index + 1) / self::POSTS_PER_PAGE);

        return $page;
    }
}