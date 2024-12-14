<form action="{{ route('members.store') }}" method="POST">
    @csrf
    <label for="name">Name:</label>
    <input type="text" name="name" required><br>
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>
    <label for="profession">Profession:</label>
    <input type="text" name="profession" required><br>
    <label for="company">Company:</label>
    <input type="text" name="company"><br>
    <label for="linkedin_url">LinkedIn:</label>
    <input type="url" name="linkedin_url"><br>
    <label for="status">Status:</label>
    <select name="status">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select><br>
    <button type="submit">Add Member</button>
</form>
