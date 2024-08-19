{{-- resources/views/applyedjobs.blade.php --}}

<!DOCTYPE html>
<html>
<head>
    <title>Applied Jobs</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="pinterest" content="nopin" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <style>
       .popup-form {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            z-index: 9999;
        }
    </style>
</head>
<body>
    @include('front.layouts.header')
<div class="container mt-5">
    <h2>Applied Jobs</h2>
    <table class="application-table mt-4">
        <thead>
            <tr>
                <th>Sr.No</th>
                <th>Job Name</th>
                <th>Date</th>
                <th>Round Status</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($applications as $index => $application)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $application->jobpost->position_name }}</td>
                    <td>{{ $application->created_at }}</td>
                    <td>{{ $application->round_status }}</td>
                    <td>{{ $application->status }}</td>
                    <td>
                        @if ($application->round_status == 'Hired')
                            <button class="btn btn-primary" onclick="showUploadForm({{ $application->id }})">Upload Documents</button>
                        @else
                            <button class="btn btn-secondary" disabled>Upload Documents</button>
                        @endif
                    </td>
                </tr>

                <!-- Popup form for each application -->
                <div id="popup-form-{{ $application->id }}" class="popup-form">
                    <h3>Upload Documents</h3>
                    <form action="{{ route('upload.documents') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="job_post_id" value="{{ $application->jobpost->id }}">
                        <input type="hidden" name="application_id" value="{{ $application->id }}">
                        
                        <div class="form-group">
                            <label for="photo_id_proof">Photo ID Proof (PDF)</label>
                            <input type="file" class="form-control" name="photo_id_proof" id="photo_id_proof" accept=".pdf" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="address_proof">Address Proof (PDF)</label>
                            <input type="file" class="form-control" name="address_proof" id="address_proof" accept=".pdf" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="degree_certificate">Degree Certificate (PDF)</label>
                            <input type="file" class="form-control" name="degree_certificate" id="degree_certificate" accept=".pdf" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="other_document">Other Document (PDF, optional)</label>
                            <input type="file" class="form-control" name="other_document" id="other_document" accept=".pdf">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    
                    <button onclick="hideUploadForm({{ $application->id }})" class="btn btn-secondary">Cancel</button>
                </div>

            @endforeach
        </tbody>
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function showUploadForm(applicationId) {
        document.getElementById('popup-form-' + applicationId).style.display = 'block';
    }
    
    function hideUploadForm(applicationId) {
        document.getElementById('popup-form-' + applicationId).style.display = 'none';
    }
</script>
</body>
</html>
