<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('members.index') }}" class="btn btn-secondary">View Members</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('members.create') }}" class="btn btn-primary">Add Member</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('events.index') }}" class="btn btn-secondary">View Events</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('events.create') }}" class="btn btn-primary">Add Event</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('successStories.index') }}" class="btn btn-secondary">View Success Stories</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('successStories.create') }}" class="btn btn-primary">Add Success Story</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
