<?php

namespace App\Http\Controllers;


use App\Models\Discussion;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

use Inertia\Inertia;

class DiscussionController extends Controller
{
    public function index()
    {
        $discussions = Discussion::with('user', 'topic')->get()->map(function ($discussion) {
            return [
                'id' => $discussion->id,
                'title' => $discussion->title,
                'username' => $discussion->user ? $discussion->user->name : 'Deleted User',
                'topic' => $discussion->topic->title,
            ];
        });

        return Inertia::render('Forum/Discussions', [
            'discussions' => $discussions,
        ]);
    }



    public function show(Discussion $discussion)
    {
        return Inertia::render('Forum/DiscussionDetails', [
            'discussion' => [
                'id' => $discussion->id,
                'title' => $discussion->title,
                'username' => $discussion->user?->name ?? 'N/A',
                'topic' => $discussion->topic->title,
                'slug' => $discussion->slug,
            ],
            'flash' => [
                'success' => session('success'),
                'error' => session('error'),
            ],
        ]);
    }


    public function edit(Discussion $discussion)
    {

        $topics = Topic::all();
        $users = User::all();
        return Inertia::render('Forum/EditDiscussion', [
            'discussion' => $discussion,
            'topics' => Topic::all(),
            'users' => User::all(),
        ]);
    }

    public function update(Request $request, Discussion $discussion)
    {


        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'topic_id' => 'required|exists:topics,id',
            'user_id' => 'required|exists:users,id'
        ]);


        $discussion->update([
            'title' => $validated['title']
        ]);


        $discussion->topic()->associate($validated['topic_id']);
        $discussion->user()->associate($validated['user_id']);
        $discussion->save();

        return redirect()
            ->route('discussions.show', $discussion)
            ->with('success', 'Discussion updated successfully.');
    }

    public function destroy(Discussion $discussion)
    {

         $discussion->posts()->delete();
         $discussion->delete();

        return redirect()
            ->route('discussions.index')
            ->with('success', 'Discussion deleted successfully.');
    }
}
