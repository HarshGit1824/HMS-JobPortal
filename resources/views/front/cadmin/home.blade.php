<!DOCTYPE html>
<html>
<head>
    <title>Company Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    @include('front.layouts.caheader')
    @include('front.layouts.casidebar')

    <div class="container1">
        <h2>Welcome to the Company Admin Dashboard!</h2>
        <p>This is your personalized dashboard where you can manage various aspects of your account.</p>

        <div class="row">
            <!-- Total Applications Card -->
            <div class="col-md-6">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Recruiters</h5>
                        <p class="card-text">{{ $totalRecruiters }}</p>
                    </div>
                </div>
            </div>

            <!-- Total Job Posts Card -->
            <div class="col-md-6">
                <div class="card dashboard-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Candidates</h5>
                        <p class="card-text">{{ $totalCandidates }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
