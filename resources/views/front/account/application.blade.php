<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/verify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('front.layouts.Rheader')
    @include('front.layouts.Rsidebar')
    <div class="container1">
        <h2>Applications</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>SR. No.</th>
                    <th>Job Name</th>
                    <th>Date</th>
                    <th>Round Status</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $key => $application)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $application->jobpost->job_name }}</td>
                        <td>{{ $application->created_at->format('Y-m-d') }}</td>
                        <td>{{ $application->round_status }}</td>
                        <td>{{ $application->status }}</td>
                        <td>
                            @if($application->status === 'Hired')
                                <form action="{{ route('uploadDocuments', $application->id) }}" method="GET" style="display: inline;">
                                    <button type="submit" class="btn btn-primary">Upload Documents</button>
                                </form>
                            @else
                                <button type="button" class="btn btn-primary" disabled>Upload Documents</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
