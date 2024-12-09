<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Management</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJv4L+6c3H5h4N9r6z6u8a2pVVN29S7gI2h0V0eJ7F0IhpM+I+N4ub4Dbt/7" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Blog Management</h1>
        <a href="{{ route('blog.create') }}" class="btn btn-primary mb-4">Create New Blog Post</a>

        <!-- Start of Blog Post Grid -->
        <div class="row">
            @foreach($posts as $post)
                <!-- Each post inside a col-md-6 -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="h5">{{ $post->title }}</h2>
                            <p>{{ $post->description }}</p>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('blog.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('blog.destroy', $post->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- End of Blog Post Grid -->

    </div>

    <!-- Include Bootstrap JS (Optional, for interactive components like modals, tooltips) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
