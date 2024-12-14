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
{{ $members->links() }}
