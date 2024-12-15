@extends('layouts.master')

@section('content')

    <h1>Edit Success Story</h1>

    <form action="{{ route('successStories.update', $successStory->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <label for="title">Title:</label>
        <input type="text" name="title" value="{{ old('title', $successStory->title) }}" required><br>

        <label for="story">Story:</label>
        <textarea name="story" required>{{ old('story', $successStory->story) }}</textarea><br>

        <label for="member_name">Member Name:</label>
        <input type="text" name="member_name" value="{{ old('member_name', $successStory->member->name ?? '') }}" required><br>

        <button type="submit">Update Story</button>
    </form>

    <a href="{{ route('successStories.index') }}">Back to Stories</a>

@endsection
