<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
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
                

                <!-- Create Post Form -->
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
                
                <div class="d-flex justify-content-between align-items-center mb-4" style="padding: 5px; ">   
             <a href="{{ route('manage') }}" class="btn btn-primary">Manage your posts</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
