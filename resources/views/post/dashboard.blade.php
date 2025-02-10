<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>

            <!-- Notification Bell -->
            <div class="relative">
                <button id="notificationButton" class="relative flex items-center p-2 bg-gray-100 rounded-full hover:bg-gray-200 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.5V11a6 6 0 10-12 0v3.5c0 .414-.168.79-.445 1.095L4 17h5m6 0a3 3 0 11-6 0" />
                    </svg>
                    @if($notifications->count() > 0)
                        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold rounded-full px-2">
                            {{ $notifications->count() }}
                        </span>
                    @endif
                </button>

                <!-- Dropdown for notifications -->
                <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white shadow-lg rounded-lg border border-gray-200">
                    <div class="p-3 border-b text-gray-700 font-semibold flex items-center gap-2">
                        <i class="fas fa-bell text-blue-500"></i>
                        Notifications
                    </div>
                    <ul class="max-h-64 overflow-y-auto divide-y divide-gray-200">
                        @forelse($notifications->take(5) as $notification)
                            <li class="p-3 hover:bg-gray-100 transition duration-200 flex items-start gap-3">
                                <div>
                                    <p class="text-sm text-gray-800">{{ $notification->data['message'] }}</p>
                                    <small class="text-gray-500">{{ $notification->created_at->diffForHumans() }}</small>
                                </div>
                            </li>
                        @empty
                            <li class="p-3 text-gray-500 text-center">
                                No new notifications
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>Create a New Post</h3>
                    
                    <a href="{{ route('posts.view') }}" class="btn btn-success">View All Posts</a>
                </div>
                
                <div>
                    <form method="POST" action="{{ route('post.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Post Title</label>
                            <input type="text" id="title" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Post Content</label>
                            <textarea id="content" name="content" class="form-control" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Post</button>
                    </form>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-4" style="padding: 5px;">   
                    <a href="{{ route('manage') }}" class="btn btn-primary">Manage your posts</a>
                </div>

            </div>
        </div>
    </div>

    <!-- Toggle dropdown script -->
    <script>
        document.getElementById('notificationButton').addEventListener('click', function() {
            document.getElementById('notificationDropdown').classList.toggle('hidden');
        });
    </script>

</x-app-layout>
