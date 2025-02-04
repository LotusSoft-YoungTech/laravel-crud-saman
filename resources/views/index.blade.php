<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3>All Posts</h3>

                @if ($posts->isEmpty())
                    <p>No posts available.</p>
                @else
                    <ul class="list-group">
                        @foreach ($posts as $post)
                            <li class="list-group-item">
                                <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
