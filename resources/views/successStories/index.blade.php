@extends('layouts.master')
@section('content')

    <!-- Filtering Section -->
    <form action="{{ route('successStories.index') }}" method="GET" style="margin-bottom: 20px;">
        <!-- Member Name Filter -->
        <select name="member_name" style="padding: 5px; margin-right: 10px;">
            <option value="">-- Filter by Member Name --</option>
            @foreach ($memberNames as $name)
                <option value="{{ $name }}" {{ request('member_name') == $name ? 'selected' : '' }}>
                    {{ $name }}
                </option>
            @endforeach
        </select>

        <!-- Submit and Clear Buttons -->
        <button type="submit">Filter</button>
        @if(request('member_name'))
            <a href="{{ route('successStories.index') }}" style="margin-left: 10px;">Clear Filter</a>
        @endif
    </form>

    <table>
        <thead>
        <tr>
            <th>Title</th>
            <th>Story</th>
            <th>Member Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($successStories as $successStory)
            <tr>
                <td>{{ $successStory->title }}</td>
                <td>{{ $successStory->story }}</td>
                <td>{{ $successStory->member->name ?? 'Unknown' }}</td> <!-- Display Member Name -->
                <td>
                    <a href="{{ route('successStories.edit', $successStory->id) }}">Edit</a>
                    <form action="{{ route('successStories.destroy', $successStory->id) }}"
                          method="POST"
                          style="display: inline-block;"
                          onsubmit="return confirm('Are you sure you want to delete this story?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $successStories->links() }}

@endsection
