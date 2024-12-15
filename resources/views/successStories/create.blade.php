@extends('layouts.master')

@section('content')
    <form action="{{ route('successStories.store') }}" method="POST">
        @csrf

        <label for="title">Title:</label>
        <input type="text" name="title" value="{{ old('title') }}" required><br>

        <label for="story">Story:</label>
        <textarea name="story" required>{{ old('story') }}</textarea><br>

        <label for="member_name">Member Name:</label>
        <select name="member_name" id="member_name" required>
            <option value="">-- Select a Member --</option>
            @foreach ($members as $member)
                <option value="{{ $member }}">{{ $member }}</option>
            @endforeach
        </select><br>

        <button type="submit">Add Story</button>
    </form>
@endsection
