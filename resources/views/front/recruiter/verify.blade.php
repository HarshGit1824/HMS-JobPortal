<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Applications</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/verify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    @include('front.layouts.Rheader')
    @include('front.layouts.Rsidebar')
    <div class="container1">
        <h2>Verified Candidates</h2>
        <table class="application-table">
            <thead>
                <tr>
                    <th>SR. No.</th>
                    <th>Application Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $key => $application)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $application->name }}</td>
                        <td>{{ $application->status }}</td>
                        <td class="actions">
                            <form action="{{ route('sendForVerification', $application->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-primary">Send for Verification</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
