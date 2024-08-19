<!-- create-documents.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Document Fields</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/verify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function addDocumentField() {
            const container = document.getElementById('document-fields');
            const index = container.children.length;
            const field = `
                <div class="mb-3">
                    <label for="documents[${index}][name]" class="form-label">Document Name</label>
                    <input type="text" class="form-control" name="documents[${index}][name]" required>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', field);
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Create Document Fields for {{ $application->name }}</h2>
        <form action="{{ route('storeDocumentFields', $application->id) }}" method="POST">
            @csrf
            <div id="document-fields">
                <div class="mb-3">
                    <label for="documents[0][name]" class="form-label">Document Name</label>
                    <input type="text" class="form-control" name="documents[0][name]" required>
                </div>
            </div>
            <button type="button" class="btn btn-secondary" onclick="addDocumentField()">Add More Fields</button>
            <button type="submit" class="btn btn-primary">Save Document Fields</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
