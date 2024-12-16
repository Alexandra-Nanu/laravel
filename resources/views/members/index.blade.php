@extends('layouts.master')
@section('content')

    <h1>Members</h1>

    <!-- Search and Filter Form -->
    <form action="{{ route('members.index') }}" method="GET" style="margin-bottom: 20px;">
        <input type="text" name="search" placeholder="Search by name or email"
               value="{{ request('search') }}" style="padding: 5px; margin-right: 10px;">

        <!-- Profession Filter -->
        <select name="profession" style="padding: 5px; margin-right: 10px;">
            <option value="">-- Select Profession --</option>
            @foreach ($professions as $item)
                <option value="{{ $item }}" {{ request('profession') == $item ? 'selected' : '' }}>
                    {{ $item }}
                </option>
            @endforeach
        </select>

        <!-- Company Filter -->
        <select name="company" style="padding: 5px; margin-right: 10px;">
            <option value="">-- Select Company --</option>
            @foreach ($companies as $item)
                <option value="{{ $item }}" {{ request('company') == $item ? 'selected' : '' }}>
                    {{ $item }}
                </option>
            @endforeach
        </select>

        <!-- Status Filter -->
        <select name="status" style="padding: 5px; margin-right: 10px;">
            <option value="">-- Select Status --</option>
            @foreach ($statuses as $item)
                <option value="{{ $item }}" {{ request('status') == $item ? 'selected' : '' }}>
                    {{ ucfirst($item) }}
                </option>
            @endforeach
        </select>

        <!-- Submit and Clear Buttons -->
        <button type="submit">Filter</button>
        @if(request()->hasAny(['search', 'profession', 'company', 'status']))
            <a href="{{ route('members.index') }}" style="margin-left: 10px;">Clear Filters</a>
        @endif
    </form>


    <!--Members table-->
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Profession</th>
            <th>Company</th>
            <th>LinkedIn</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($members as $member)
            <tr>
                <td>{{ $member->name }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->profession }}</td>
                <td>{{ $member->company }}</td>
                <td>{{ $member->linkedin_url}}</td>
                <td>{{ $member->status }}</td>
                <td>
                    <a href="{{ route('members.edit', $member->id) }}">Edit</a>
                    <form action="{{ route('members.destroy', $member->id) }}"
                          method="POST"
                          style="display: inline-block;"
                          onsubmit="return confirm('Are you sure you want to delete this member?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>



    {{ $members->links() }}

@endsection
