<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function store(Request $request)
    {
        //store method to handle adding a new member
        $request->validate([
            'name' => 'required|string|max:255|regex:/^[\pL\s\-\'\.]+$/u', //name: required, string, max length 255, and allows letters, spaces, and common symbols
            'email' => 'required|email|unique:members,email|max:255', //email: required, valid email format, and unique in the 'members' table
            'profession' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',    //profession: required, string, max length 255
            'linkedin_url' => 'nullable|url|max:255', //linkedIn URL: optional, must be a valid URL
        ]);
        Member::create($request->all());
        return redirect()->route('members.index')->with('success', 'Member added successfully!');
    }

    public function create()
    {
        return view('members.create');
    }
    public function index(Request $request)
    {
        //get search and filter parameters
        $search = $request->input('search'); //search by name or email
        $profession = $request->input('profession'); //filter by profession
        $company = $request->input('company'); //filter by company
        $status = $request->input('status'); //filter by status

        //build query with search and filters
        $members = Member::when($search, function ($query, $search) { //initialization
            //when: laravel query builder method that conditionally applies logic
            //search: if search is not null, the provided closure (function) will be executed
            //query: query builder instance for the Member model (allows modification of the query)
            //search: passed into the closure and contains the search term
            return $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
        })
            ->when($profession, function ($query, $profession) { //searches where profession matches the provided value
                return $query->where('profession', $profession);
            })
            ->when($company, function ($query, $company) {
                return $query->where('company', $company);
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->paginate(10);

        //fetch unique filter options
        $professions = Member::distinct()->pluck('profession'); //returns a single column's value
        $companies = Member::distinct()->pluck('company');
        $statuses = ['active', 'inactive'];

        return view('members.index', compact('members', 'professions', 'companies', 'statuses'));
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $id, // Ignoră email-ul curent la verificare
            'profession' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|url',
            'status' => 'required|in:active,inactive', // Status trebuie să fie 'active' sau 'inactive'
        ]);

        $member = Member::findOrFail($id);
        $member->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'profession' => $request->input('profession'),
            'company' => $request->input('company'),
            'linkedin_url' => $request->input('linkedin_url'),
            'status' => $request->input('status'),
        ]);
        return redirect()->route('members.index')->with('success', 'Member updated successfully!');
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully!');
    }
}
