<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('📖 Blog Post') }}
        </h2>
    </x-slot>

    {{-- Laravel Notify CSS & JS --}}
    @notifyJs
    <x-notify::notify />

    <div class="py-12 flex justify-center">
        <div class="max-w-3xl w-full bg-white shadow-lg rounded-lg p-6">
            <!-- User Info -->
            <div class="flex items-center mb-6">
                <img src="{{ $post->user->profile_photo_url ?? asset('default-avatar.png') }}" 
                     class="rounded-full border p-1 mr-4" width="60" height="60" alt="User">
                <div>
                    <h5 class="font-semibold text-blue-600">{{ $post->user->name }}</h5>
                    <p class="text-gray-500 text-sm">{{ $post->created_at->format('F j, Y') }} • {{ $post->created_at->diffForHumans() }}</p>
                </div>
            </div>

            <!-- Post Title -->
            <h1 class="text-2xl font-bold text-gray-900 leading-tight">{{ $post->title }}</h1>

            <!-- Featured Image (If Exists) -->
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="w-full my-4 rounded-lg shadow-md" alt="Post Image">
            @endif

            <!-- Post Content -->
            <div class="text-gray-800 leading-relaxed mt-4">
                {!! nl2br(e($post->content)) !!}
            </div>

            <!-- Like Button -->
            <div class="mt-6">
                <form method="POST" action="{{ route('posts.like', $post->id) }}">
                    @csrf
                    <button type="submit" class="flex items-center text-blue-600 hover:text-blue-800">
                    👍 Like ({{ $post->likes->count() }})
                    </button>
                </form>
            </div>

            <!-- Comments Section -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold">💬 Comments ({{ $post->comments->count() }})</h3>

                <!-- List of Comments -->
                <div class="mt-4 space-y-4">
                    @foreach ($post->comments as $comment)
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <div class="flex items-center mb-2">
                                <img src="{{ $comment->user->profile_photo_url ?? asset('default-avatar.png') }}" 
                                     class="rounded-full border p-1 mr-3" width="40" height="40" alt="User">
                                <div>
                                    <h6 class="font-semibold text-gray-700">{{ $comment->user->name }}</h6>
                                    <small class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <p class="text-gray-800">{{ $comment->comment }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Add Comment Form -->
                <form method="POST" action="{{ route('posts.comment', $post->id) }}" class="mt-6">
                    @csrf
                    <div class="mb-3">
                        <textarea name="comment" class="form-control w-full p-3 border rounded-lg" placeholder="Write a comment..." required></textarea>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                        Post Comment
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
