<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function create()
    {
        return Inertia::render('Forum/CreateTopic');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:topics',
        ]);

        Topic::create($validated);

        return redirect()->route('topics.index')->with('success', 'Topic created successfully');
    }





    public function edit(Topic $topic)
    {
        return Inertia::render('Forum/EditTopic', [
            'topic' => $topic
        ]);
    }

    public function update(Request $request, Topic $topic)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('topics')->ignore($topic->id),
            ],
        ]);

        $topic->update($validated);

        return redirect()->route('topics.index')->with('success', 'Topic updated successfully');
    }


    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->route('topics.index')->with('success', 'Topic deleted successfully.');
    }
}
