<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h4>Admin Dashboard</h4>
                <p>{{ __("You're logged in!") }}</p>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success mt-4">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Search Form -->
                <form method="GET" action="{{ route('admin.dashboard') }}" class="mt-4">
                    <div class="flex">
                        <input type="text" name="search" placeholder="Search by user name" class="form-control mr-2" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>

                <!-- Post Management Table -->
                <div class="mt-6">
                    @if ($posts->isEmpty())
                        <div class="alert alert-warning">No posts available.</div>
                    @else
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>User</th>
                                    <th>Title</th>
                                    <th>Created At</th>
                                    <th>Public</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->user->name }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->created_at->diffForHumans() }}</td>
                                        <td>{{ $post->is_public ? 'Yes' : 'No' }}</td>
                                        <td>
                                        <form action="{{ route('admin.posts.restrict', $post->id) }}" method="POST" class="d-inline">
                                         @csrf
                                <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Are you sure?')">
                                    {{ $post->is_public ? 'Restrict' : 'Make Public' }}
                                </button>
                            </form>

                                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this post?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        {{ $posts->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
