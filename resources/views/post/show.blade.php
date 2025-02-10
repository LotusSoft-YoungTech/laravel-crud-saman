<x-app-layout>
    <x-slot name="header">
         
    </x-slot>

    {{-- Laravel Notify CSS & JS --}}
    @notifyJs
    <x-notify::notify />

    <div class="py-12 flex justify-center">
        <div class="max-w-2xl w-full bg-white shadow-md rounded-lg p-6">
            <!-- User Info -->
            <div class="flex items-center mb-4">
                
                <img src="https://via.placeholder.com/50" class="rounded-full mr-3" alt="User">
                <div>
                    <h6 class="font-semibold">{{ $post->user->name }}</h6>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
                    <p class="text-gray-500 text-sm">{{ $post->created_at->diffForHumans() }}</p>
                </div>
            </div>

            <!-- Post Content -->
            <p class="text-gray-800 mb-4">{{ $post->content }}</p>

            <!-- Like Button -->
            <form method="POST" action="{{ route('posts.like', $post->id) }}">
                @csrf
                <button type="submit" class="flex items-center text-lg text-red-500">
                    ❤️ Like ({{ $post->likes->count() }})
                </button>
            </form>

            <!-- Comments Section -->
            <h4 class="mt-4">Comments</h4>
            <ul class="list-group mb-4">
                @foreach ($post->comments as $comment)
                    <li class="list-group-item">
                        <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}
                        <br><small class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>
                    </li>
                @endforeach
            </ul>

            <!-- Add Comment Form -->
            <form method="POST" action="{{ route('posts.comment', $post->id) }}">
                @csrf
                <div class="mb-3">
                    <textarea name="comment" class="form-control" placeholder="Add a comment..." required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Post Comment</button>
            </form>
        </div>
    </div>
</x-app-layout>
