<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Inertia\Inertia;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        // Fetch all topics
        $topics = Topic::all();

        // Pass topics to the Inertia view
        return Inertia::render('Forum/Topics', [
            'topics' => $topics,
        ]);
    }

    public function show(Topic $topic)
    {
        return Inertia::render('Forum/TopicDetails', [
            'topic' => $topic,
        ]);
    }

    public function edit(Topic $topic)
    {
        return Inertia::render('Forum/EditTopic', [
            'topic' => $topic,
        ]);
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->route('topics')->with('success', 'Topic deleted successfully.');
    }
}
