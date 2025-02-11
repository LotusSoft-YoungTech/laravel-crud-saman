<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight text-center">
            📝 {{ __('Latest Blog Posts') }}
        </h2>
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
                                <!-- Post Header (User Info) -->
                                <div class="p-5 border-b border-gray-200 flex items-center">
                                    <img src="{{ $post->user->profile_photo_url ?? asset('default-avatar.png') }}" 
                                         alt="User Avatar" 
                                         class="w-12 h-12 rounded-full border">
                                    <div class="ml-4">
                                        <h6 class="text-lg font-bold text-blue-600">{{ $post->user->name }}</h6>
                                        <small class="text-gray-500">{{ $post->created_at->format('F j, Y') }}</small>
                                    </div>
                                </div>

                                <!-- Post Content -->
                                <div class="p-6">
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $post->title }}</h3>
                                    <p class="text-gray-700 mt-3">{{ Str::limit($post->content, 200) }}</p>

                                    <!-- Read More -->
                                    <div class="mt-4">
                                        <a href="{{ route('posts.show', $post->id) }}" 
                                           class="text-blue-500 hover:text-blue-700 font-semibold">
                                            Read More →
                                        </a>
                                    </div>
                                </div>

                                <!-- Like & Comment Section -->
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

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
