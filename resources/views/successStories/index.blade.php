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
            <td>{{ $successStory->member_id }}</td>
            <td>
                <a href="{{ route('successStories.edit', $successStory->id) }}">Edit</a>
                <form action="{{ route('successStories.destroy', $successStory->id) }}"
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
{{ $successStories->links() }}
