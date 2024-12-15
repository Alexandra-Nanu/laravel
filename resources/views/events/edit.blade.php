@extends('layouts.master')

@section('content')

    <h1>Edit Event</h1>

    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ old('name', $event->name) }}" required><br>

        <label for="event_date">Event Date:</label>
        <input type="date" name="event_date" value="{{ old('event_date', $event->event_date) }}" required><br>

        <label for="description">Description:</label>
        <textarea name="description" required>{{ old('description', $event->description) }}</textarea><br>

        <button type="submit">Update Event</button>
    </form>

    <a href="{{ route('events.index') }}">Back to Events</a>

@endsection
