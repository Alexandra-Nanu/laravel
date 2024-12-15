@extends('layouts.master')

@section('content')

    <h1>Edit Success Story</h1>

    <form action="{{ route('successStories.update', $successStory->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <!-- Title Field -->
        <label for="title">Title:</label>
        <input type="text" name="title" value="{{ old('title', $successStory->title) }}" required><br>

        <!-- Story Field -->
        <label for="story">Story:</label>
        <textarea name="story" required>{{ old('story', $successStory->story) }}</textarea><br>

        <!-- Dropdown for Member Name -->
        <label for="member_name">Member Name:</label>
        <select name="member_name" id="member_name" required>
            <option value="">-- Select a Member --</option>
            @foreach ($members as $member)
                <option value="{{ $member }}"
                    {{ old('member_name', $successStory->member->name ?? '') == $member ? 'selected' : '' }}>
                    {{ $member }}
                </option>
            @endforeach
        </select><br>

        <!-- Submit Button -->
        <button type="submit">Update Story</button>
    </form>

    <a href="{{ route('successStories.index') }}">Back to Stories</a>

@endsection
