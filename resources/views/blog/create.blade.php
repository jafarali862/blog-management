<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog Post</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJv4L+6c3H5h4N9r6z6u8a2pVVN29S7gI2h0V0eJ7F0IhpM+I+N4ub4Dbt/7" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1>Create Blog Post</h1>

        <!-- Form Starts Here -->
        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Title Field -->
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div><br/>

            <!-- Description Field -->
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
            </div>

            <!-- Content Field (TinyMCE) -->
            <div class="mb-3">
                <label for="content" class="form-label">Content:</label>
                <textarea name="content" id="content" class="form-control" required></textarea>
            </div>

            <!-- Image Upload Field -->
            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <!-- Status Field (Checkbox) -->
            <div class="mb-3 form-check">
                <input type="checkbox" name="status" id="status" class="form-check-input" value="1" checked>
                <label for="status" class="form-check-label">Status (Enabled)</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

    <!-- Include TinyMCE Script -->
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
