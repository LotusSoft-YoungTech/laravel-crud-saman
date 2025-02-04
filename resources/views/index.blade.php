<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('📢 Latest Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if ($posts->isEmpty())
                    <div class="alert alert-warning text-center" role="alert">
                        No posts available.
                    </div>
                @else
                    <div class="d-flex flex-column gap-4">
                        @foreach ($posts as $post)
                            <div class="card shadow-sm p-3">
                                <div class="card-body">
                                    <!-- Post Header (User Info) -->
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="{{ $post->user->profile_photo_url ?? asset('default-avatar.png') }}" 
                                             alt="User Avatar" 
                                             class="rounded-circle border p-1" 
                                             width="50" height="50">
                                        <div class="ms-3">
                                            <h6 class="fw-bold mb-0 text-primary">{{ $post->user->name }}</h6>
                                            <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>

                                    <!-- Post Content -->
                                    <h5 class="card-title text-dark fw-bold">{{ $post->title }}</h5>
                                    <p class="card-text">{{ Str::limit($post->content, 150) }}</p>

                                    <!-- Like & Comment Buttons -->
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <form method="POST" action="{{ route('posts.like', $post->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary btn-sm">
                                                👍 Like ({{ $post->likes->count() }})
                                            </button>
                                        </form>
                                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-outline-secondary btn-sm">
                                            💬 Comment ({{ $post->comments->count() }})
                                        </a>
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
