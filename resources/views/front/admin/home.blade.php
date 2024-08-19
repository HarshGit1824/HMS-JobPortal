<!DOCTYPE html>
<html>
<head>
    <title>Webadmin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('front.layouts.Adheader')
    @include('front.layouts.Adsidebar')

    <div class="container1">
        <h2>Welcome to the Admin Dashboard!</h2>
        <p>This is your personalized dashboard where you can manage various aspects of your account.</p>

        <div class="row mb-3"> <!-- First row containing two cards -->
            <!-- Total Companies Card -->
            <div class="col-md-6">
                <a href="{{ route('front.admin.viewdetails') }}" class="text-decoration-none">
                    <div class="card dashboard-card">
                        <div class="card-body">
                            <h5 class="card-title">Total Companies</h5>
                            <p class="card-text">{{ $totalCompanies }}</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Total Recruiters Card -->
            <div class="col-md-6">
                <a href="{{ route('front.admin.viewdetails') }}" class="text-decoration-none">
                    <div class="card dashboard-card">
                        <div class="card-body">
                            <h5 class="card-title">Total Recruiters</h5>
                            <p class="card-text">{{ $totalRecruiters }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row"> <!-- Second row containing one card -->
            <!-- Total Candidates Card -->
            <div class="col-md-6">
                <a href="{{ route('front.admin.viewcandidates') }}" class="text-decoration-none">
                    <div class="card dashboard-card">
                        <div class="card-body">
                            <h5 class="card-title">Total Candidates</h5>
                            <p class="card-text">{{ $totalCandidates }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
