<?php

namespace App\Http\Controllers;

use App\Models\SuccessStory;
use App\Models\Member; // Import Member model
use Illuminate\Http\Request;

class SuccessStoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'story' => 'required',
            'member_name' => 'required|exists:members,name',
        ]);

        $member = Member::where('name', $request->input('member_name'))->firstOrFail();

        SuccessStory::create([
            'title' => $request->input('title'),
            'story' => $request->input('story'),
            'member_id' => $member->id,
        ]);

        return redirect()->route('successStories.index')->with('success', 'Story added successfully!');
    }

    public function create()
    {
        $members = Member::pluck('name');
        return view('successStories.create', compact('members'));
    }

    public function index(Request $request)
    {
        $memberName = $request->input('member_name');

        //filter success stories by members
        $successStories = SuccessStory::with('member')
            ->when($memberName, function ($query, $memberName) {
                return $query->whereHas('member', function ($query) use ($memberName) {
                    $query->where('name', 'LIKE', "%{$memberName}%");
                });
            })
            ->paginate(10);
        $memberNames = Member::pluck('name'); //get distinct member names for filtering options
        return view('successStories.index', compact('successStories', 'memberName', 'memberNames'));
    }

    public function edit($id)
    {
        $successStory = SuccessStory::findOrFail($id);
        $members = Member::pluck('name'); //fetch all member names

        return view('successStories.edit', compact('successStory', 'members'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'story' => 'required',
            'member_name' => 'required|exists:members,name',
        ]);

        $member = Member::where('name', $request->input('member_name'))->firstOrFail();

        //find the success story and update it
        $successStory = SuccessStory::findOrFail($id);
        $successStory->update([
            'title' => $request->input('title'),
            'story' => $request->input('story'),
            'member_id' => $member->id,
        ]);

        return redirect()->route('successStories.index')->with('success', 'Story updated successfully!');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function destroy($id)
    {
        //find the success story by ID
        $successStory = SuccessStory::findOrFail($id);

        //felete the success story
        $successStory->delete();

        //redirect back to the success stories index with a success message
        return redirect()->route('successStories.index')->with('success', 'Success story deleted successfully!');
    }

}
