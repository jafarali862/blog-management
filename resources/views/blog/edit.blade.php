<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog Post</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJv4L+6c3H5h4N9r6z6u8a2pVVN29S7gI2h0V0eJ7F0IhpM+I+N4ub4Dbt/7" crossorigin="anonymous">
</head>
<body>
    <h1>Edit Blog Post</h1>
    <form action="{{ route('blog.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ $post->title }}" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required>{{ $post->description }}</textarea><br><br>

        <label for="content">Content:</label>
        <textarea name="content" id="content" required>{{ $post->content }}</textarea><br><br>

        <label for="image">Image:</label>
        <input type="file" name="image" id="image"><br><br>

        <label for="status">Status:</label>
        <input type="checkbox" name="status" id="status" value="1" {{ $post->status ? 'checked' : '' }}><br><br>

        <button type="submit">Update</button>
    </form>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.2/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea#content',  // Target the 'content' textarea
            height: 300,  // Adjust the height if needed
            setup: function(editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();  // Ensure the content is saved to the textarea
                });
            }
        });
    </script>

    <!-- Include Bootstrap JS (Optional, for interactive components like modals, tooltips) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
