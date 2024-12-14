<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:members',
            'profession' => 'required',
            'linkedin_url' => 'nullable|url',
        ]);
        Member::create($request->all());
        return redirect()->route('members.index')->with('success', 'Member added successfully!');
    }

    public function create()
    {
        return view('members.create');
    }

    public function index()
    {
        $members = Member::paginate(10); // Paginare
        return view('members.index', compact('members'));
    }

    public function edit($id)
    {
        // Caută membrul în baza de date după ID
        $member = Member::findOrFail($id);

        // Returnează vederea 'members.edit' cu membrul găsit
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        // Validează datele primite din formular
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $id, // Ignoră email-ul curent la verificare
            'profession' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|url',
            'status' => 'required|in:active,inactive', // Status trebuie să fie 'active' sau 'inactive'
        ]);

        // Găsește membrul în baza de date
        $member = Member::findOrFail($id);

        // Actualizează datele membrului cu cele din request
        $member->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'profession' => $request->input('profession'),
            'company' => $request->input('company'),
            'linkedin_url' => $request->input('linkedin_url'),
            'status' => $request->input('status'),
        ]);

        // Redirecționează către lista membrilor cu un mesaj de succes
        return redirect()->route('members.index')->with('success', 'Member updated successfully!');
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully!');
    }
}
