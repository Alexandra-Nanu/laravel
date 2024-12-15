@extends('layouts.master')

@section('content')

    <h1>Edit Member</h1>

    <form action="{{ route('members.update', $member->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ old('name', $member->name) }}" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ old('email', $member->email) }}" required><br>

        <label for="profession">Profession:</label>
        <input type="text" name="profession" value="{{ old('profession', $member->profession) }}" required><br>

        <label for="company">Company:</label>
        <input type="text" name="company" value="{{ old('company', $member->company) }}" required><br>

        <label for="linkedin_url">LinkedIn URL:</label>
        <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $member->linkedin_url) }}" required><br>

        <label for="status">Status:</label>
        <input type="text" name="status" value="{{ old('status', $member->status) }}" required><br>

        <button type="submit">Update Member</button>
    </form>

    <a href="{{ route('members.index') }}">Back to Members</a>

@endsection
