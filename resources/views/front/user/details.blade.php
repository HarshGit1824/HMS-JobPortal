<!DOCTYPE html>
<html>
<head>
    <title>Job Details</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        .popup-form {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            position: relative;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
            box-sizing: border-box;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
            color: #aaa;
        }

        .close-btn:hover {
            color: #000;
        }

        .form-group {
            margin-bottom: 15px; /* Add spacing between form fields */
        }
    </style>
</head>
<body>
@include('front.layouts.header')

<section id="job-details" class="section-3 py-5">
    <div class="container">
        <h2>Job Details</h2>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        

        <div class="row pt-5">
            <div class="job_details_area">
                <div class="job_details">
                    <h3 class="border-0 fs-5 pb-2 mb-0 job-detail-item">{{ $job->position_name }}</h3>
                    <p class="job-detail-item">{!! $job->description !!}</p>
                    <div class="bg-light p-3 border job-detail-item">
                        <p class="mb-0">
                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                            <span class="ps-1">{{ $job->location }}</span>
                        </p>
                        <p class="mb-0">
                            <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                            <span class="ps-1">{{ $job->job_type ?? 'N/A' }}</span>
                        </p>

                        @if (!is_null($job->start_date) && !is_null($job->end_date))
                            <p class="mb-0 job-detail-item">
                                <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                <span class="ps-1">{{ $job->start_date }} To {{ $job->end_date }}</span>
                            </p>
                        @endif

                        @if (!is_null($job->salary_range_from) && !is_null($job->salary_range_to))
                            <div class="mb-3 job-detail-item">
                                <p class="mb-0">
                                    <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                    <span class="ps-1">{{ $job->salary_range_from }} - {{ $job->salary_range_to }} LPA</span>
                                </p>
                            </div>
                        @endif
                    </div>
                    <div class="d-grid mt-3">
                        <a href="#" class="btn btn-primary btn-lg" id="applyBtn">Apply Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="application-form-popup" class="popup-form">
        <div class="popup-content">
            <span class="close-btn">&times;</span>
            <h2>Application Form</h2>
            <form action="{{ route('submit.application') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="job_post_id" value="{{ $job->id }}">
                <input type="hidden" name="user_id" value="{{ $user->id }}">

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select id="gender" name="gender" class="form-control" required>
                        <option value="">Select Gender</option>
                        <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="contact">Contact No:</label>
                    <input type="text" id="contact" name="contact" class="form-control" value="{{ $user->mobile }}" required>
                </div>
                <div class="form-group">
                    <label for="resume">Upload Resume:</label>
                    <input type="file" id="resume" name="resume" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit Application</button>
                </div>
            </form>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var applyBtn = document.getElementById('applyBtn');
        var popupForm = document.getElementById('application-form-popup');
        var closeBtn = document.querySelector('.close-btn');

        applyBtn.addEventListener('click', function(event) {
            event.preventDefault();
            popupForm.style.display = 'flex'; // Change from 'block' to 'flex' to center the popup
        });

        closeBtn.addEventListener('click', function() {
            popupForm.style.display = 'none';
        });

        window.addEventListener('click', function(event) {
            if (event.target == popupForm) {
                popupForm.style.display = 'none';
            }
        });
    });

    
</script>
</body>
</html>
