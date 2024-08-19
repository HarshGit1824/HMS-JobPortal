<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
        <div class="container">
            <a class="navbar-brand" href="index.html">EmployeeHUB</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Profile Picture Icon and Dropdown -->
            <div class="dropdown">
                <button class="btn btn-outline-primary me-2 dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::guard('webadmin')->user()->email  }}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{ route('wlogout') }}">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>