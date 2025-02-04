
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>Create a New Post</h3>

        <!-- Show success message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('post.store') }}">
            @csrf
            <div class="mb-4">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>

            <div class="mb-4">
                <label for="content" class="form-label">Post Content</label>
                <textarea id="content" name="content" class="form-control" rows="6" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>
</body>
</html>
