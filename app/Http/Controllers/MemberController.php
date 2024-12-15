<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            // Name: Required, string, max length 255, and allows letters, spaces, and common symbols
            'name' => 'required|string|max:255|regex:/^[\pL\s\-\'\.]+$/u',

            // Email: Required, valid email format, and unique in the 'members' table
            'email' => 'required|email|unique:members,email|max:255',

            // Profession: Required, string, max length 255
            'profession' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',

            // LinkedIn URL: Optional, must be a valid URL
            'linkedin_url' => 'nullable|url|max:255',
        ]);
        Member::create($request->all());
        return redirect()->route('members.index')->with('success', 'Member added successfully!');
    }

    public function create()
    {
        return view('members.create');
    }

    /*public function index()
    {
        $members = Member::paginate(10); // Paginare
        return view('members.index', compact('members'));
    }*/

    /*public function index(Request $request)
    {
        // Check if there is a search query
        $search = $request->input('search');

        // Fetch members with or without search filter
        $members = Member::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
        })->paginate(10);

        return view('members.index', compact('members', 'search'));
    }*/

    public function index(Request $request)
    {
        // Fetch input values for search and filters
        $search = $request->input('search');
        $profession = $request->input('profession');
        $company = $request->input('company');
        $status = $request->input('status');

        // Query members with search and filters
        $members = Member::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
        })
            ->when($profession, function ($query, $profession) {
                return $query->where('profession', $profession);
            })
            ->when($company, function ($query, $company) {
                return $query->where('company', $company);
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->paginate(10);

        // Fetch distinct values for filters
        $professions = Member::distinct()->pluck('profession');
        $companies = Member::distinct()->pluck('company');
        $statuses = ['active', 'inactive'];

        return view('members.index', compact('members', 'search', 'professions', 'companies', 'statuses', 'profession', 'company', 'status'));
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
