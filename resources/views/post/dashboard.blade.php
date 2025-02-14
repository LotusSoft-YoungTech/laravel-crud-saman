<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Blogs') }}
            </h2>

            <!-- Notification Bell -->
            <div class="relative">
                <button id="notificationButton" class="relative flex items-center p-2 bg-gray-100 rounded-full hover:bg-gray-200 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.5V11a6 6 0 10-12 0v3.5c0 .414-.168.79-.445 1.095L4 17h5m6 0a3 3 0 11-6 0" />
                    </svg>
                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <span id="notificationCount" class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold rounded-full px-2">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                    @endif
                </button>

                <!-- Notification Dropdown -->
                <div id="notificationDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white shadow-lg rounded-lg border border-gray-200">
                    <div class="p-3 border-b text-gray-700 font-semibold flex items-center">
                        <i class="fas fa-bell text-blue-500"></i> Notifications
                    </div>

                    <ul id="notificationList" class="max-h-64 overflow-y-auto divide-y divide-gray-200">
                        @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                            <li class="p-3 hover:bg-gray-100 transition duration-200 flex items-start gap-3">
                                <div>
                                    <p class="text-sm text-gray-800">{{ $notification->data['message'] }}</p>
                                    <small class="text-gray-500">{{ $notification->created_at->diffForHumans() }}</small>
                                </div>
                            </li>
                        @empty
                            <li class="p-3 text-gray-500 text-center">No new notifications</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($posts->isEmpty())
                    <div class="alert alert-warning text-center text-gray-600">
                        📭 No blog posts available.
                    </div>
                @else
                    <div class="space-y-8">
                        @foreach ($posts as $post)
                            <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
                                <div class="p-5 border-b border-gray-200 flex items-center">
                                    <img src="{{ $post->user->profile_photo_url ?? asset('default-avatar.png') }}" 
                                         alt="User Avatar" 
                                         class="w-12 h-12 rounded-full border">
                                    <div class="ml-4">
                                        <h6 class="text-lg font-bold text-blue-600">{{ $post->user->name }}</h6>
                                        <small class="text-gray-500">{{ $post->created_at->format('F j, Y') }}</small>
                                    </div>
                                </div>

                                <div class="p-6">
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $post->title }}</h3>
                                    <p class="text-gray-700 mt-3">{{ Str::limit($post->content, 200) }}</p>

                                    <div class="mt-4">
                                        <a href="{{ route('posts.show', $post->id) }}" 
                                           class="text-blue-500 hover:text-blue-700 font-semibold">
                                            Read More →
                                        </a>
                                    </div>
                                </div>

                                <div class="p-4 border-t border-gray-200 flex justify-between items-center bg-gray-50">
                                    <form method="POST" action="{{ route('posts.like', $post->id) }}">
                                        @csrf
                                        <button type="submit" class="flex items-center text-blue-600 hover:text-blue-800">
                                            👍 Like <span class="ml-1 text-gray-700">({{ $post->likes->count() }})</span>
                                        </button>
                                    </form>
                                    <a href="{{ route('posts.show', $post->id) }}" class="flex items-center text-gray-600 hover:text-gray-800">
                                        💬 Comment <span class="ml-1">({{ $post->comments->count() }})</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.getElementById("notificationButton").addEventListener("click", function() {
            document.getElementById("notificationDropdown").classList.toggle("hidden");
        });
    </script>
</x-app-layout>
