<?php

namespace App\Http\Controllers;

use App\Models\SuccessStory;
use App\Models\Member; // Import Member model
use Illuminate\Http\Request;

class SuccessStoryController extends Controller
{
    public function store(Request $request)
    {
        // Validate input, ensuring the member's name exists in the database
        $request->validate([
            'title' => 'required',
            'story' => 'required',
            'member_name' => 'required|exists:members,name',
        ]);

        // Find the member's ID based on the provided name
        $member = Member::where('name', $request->input('member_name'))->firstOrFail();

        // Create the success story using the member's ID
        SuccessStory::create([
            'title' => $request->input('title'),
            'story' => $request->input('story'),
            'member_id' => $member->id,
        ]);

        return redirect()->route('successStories.index')->with('success', 'Story added successfully!');
    }

    public function create()
    {
        // Fetch all member names for the dropdown
        $members = Member::pluck('name');
        return view('successStories.create', compact('members'));
    }

    public function index()
    {
        // Fetch all success stories with related member info
        $successStories = SuccessStory::with('member')->paginate(10);
        return view('successStories.index', compact('successStories'));
    }

    public function edit($id)
    {
        $successStory = SuccessStory::findOrFail($id);
        $members = Member::pluck('name');
        return view('successStories.edit', compact('successStory', 'members'));
    }

    public function update(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'title' => 'required',
            'story' => 'required',
            'member_name' => 'required|exists:members,name',
        ]);

        // Find the member's ID based on the provided name
        $member = Member::where('name', $request->input('member_name'))->firstOrFail();

        // Find the success story and update it
        $successStory = SuccessStory::findOrFail($id);
        $successStory->update([
            'title' => $request->input('title'),
            'story' => $request->input('story'),
            'member_id' => $member->id,
        ]);

        return redirect()->route('successStories.index')->with('success', 'Story updated successfully!');
    }

    // app/Models/SuccessStory.php

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }


}
