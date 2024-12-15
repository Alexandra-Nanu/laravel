@extends('layouts.master')
@section('content')


<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Date</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($events as $event)
        <tr>
            <td>{{ $event->name }}</td>
            <td>{{ $event->event_date }}</td>
            <td>{{ $event->description }}</td>
            <td>
                <a href="{{ route('events.edit', $event->id) }}">Edit</a>
                <form action="{{ route('events.destroy', $event->id) }}"
                      method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $events->links() }}

@endsection
