<!DOCTYPE html>
<html>
<head>
    <title>Recruiter Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    @include('front.layouts.caheader')
    @include('front.layouts.casidebar')
<div class="container1">
    <h2>Candidates</h2>
                    <table class="application-table">
                        <thead>
                            <tr>
                                <th>SR.No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Round Status</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $application)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $application->name }}</td>
                                    <td>{{ $application->email }}</td>
                                    <td>{{ $application->round_status }}</td>
                                    <td>{{ $application->status }}</td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
              
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</html>