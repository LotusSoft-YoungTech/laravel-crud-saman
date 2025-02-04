<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="mb-4">All Posts</h3>

                @if ($posts->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        No posts available.
                    </div>
                @else
                    <div class="row">
                        @foreach ($posts as $post)
                            <div class="col-md-4 mb-4">
                                <!-- Post Block -->
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ route('posts.show', $post->id) }}" class="text-dark">
                                                {{ $post->title }}
                                            </a>
                                        </h5>
                                        <p class="card-text">
                                            {{ Str::limit($post->content, 100) }} <!-- Displaying truncated content -->
                                        </p>
                                    </div>
                                    <div class="card-footer text-muted">
                                        <small>Posted on {{ $post->created_at->format('M d, Y') }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
