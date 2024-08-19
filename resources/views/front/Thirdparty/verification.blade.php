<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Applications</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('front.layouts.Tpheader')
    @include('front.layouts.Tpsidebar')
    <div class="container1">
        <h2>Verification Applications</h2>
        
        <div class="mb-3 d-flex align-items-center">
            <label for="position" class="md-3">Company Name: </label>
            <input id="position" type="text" class="form-control" placeholder="Search...">
        </div>
        <table class="application-table">
            <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Company Name</th>
                    <th>Date</th>
                    <th>List</th>
                    <th>Actions</th> <!-- Add a new column for actions -->
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $key => $application)
                <tr id="application-row-{{ $application->id }}">
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $application->jobpost->recruiter->company->cname ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('application.list', $application->id) }}" class="btn btn-primary">View List</a>
                    </td>
                    <td>
                        <!-- Delete button with onclick event -->
                        <button type="button" class="btn btn-danger" onclick="removeRow({{ $application->id }})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function removeRow(applicationId) {
            // Confirm before removing the row
            if (confirm('Are you sure you want to remove this application from the screen?')) {
                // Find the row by ID and remove it from the table
                var row = document.getElementById('application-row-' + applicationId);
                if (row) {
                    row.remove();
                }
            }
        }
    </script>
</body>
</html>
