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

    /*public function index()
    {
        // Fetch all success stories with related member info
        $successStories = SuccessStory::with('member')->paginate(10);
        return view('successStories.index', compact('successStories'));
    }*/

    public function index(Request $request)
    {
        // Get the search query for member name
        $memberName = $request->input('member_name');

        // Query success stories with member name filter
        $successStories = SuccessStory::with('member')
            ->when($memberName, function ($query, $memberName) {
                return $query->whereHas('member', function ($query) use ($memberName) {
                    $query->where('name', 'LIKE', "%{$memberName}%");
                });
            })
            ->paginate(10);

        // Get distinct member names for filtering options
        $memberNames = Member::pluck('name');

        return view('successStories.index', compact('successStories', 'memberName', 'memberNames'));
    }


    public function edit($id)
    {
        $successStory = SuccessStory::findOrFail($id);
        $members = Member::pluck('name'); // Fetch all member names

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

    public function destroy($id)
    {
        // Find the success story by ID
        $successStory = SuccessStory::findOrFail($id);

        // Delete the success story
        $successStory->delete();

        // Redirect back to the success stories index with a success message
        return redirect()->route('successStories.index')->with('success', 'Success story deleted successfully!');
    }

}
