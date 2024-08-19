<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications for Verification</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('front.layouts.Tpheader')
    @include('front.layouts.Tpsidebar')
    <div class="container1">
        <h2>Applications for Verification</h2>
        <table class="application-table">
            <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Applicant Name</th>
                    <th>Status</th>
                    <th>Documents</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applicationsForVerification as $key => $application)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $application->name }}</td>
                    <td>{{ $application->status }}</td>
                    <td>
                        @if($application->photo_id_proof || $application->address_proof || $application->degree_certificate || $application->other_document)
                            <div>
                                @if($application->photo_id_proof)
                                    <a href="{{ asset('storage/documents/' . $application->photo_id_proof) }}" target="_blank">Photo ID Proof</a><br>
                                @else
                                    <span>No Photo ID Proof</span><br>
                                @endif

                                @if($application->address_proof)
                                    <a href="{{ asset('storage/documents/' . $application->address_proof) }}" target="_blank">Address Proof</a><br>
                                @else
                                    <span>No Address Proof</span><br>
                                @endif

                                @if($application->degree_certificate)
                                    <a href="{{ asset('storage/documents/' . $application->degree_certificate) }}" target="_blank">Degree Certificate</a><br>
                                @else
                                    <span>No Degree Certificate</span><br>
                                @endif

                                @if($application->other_document)
                                    <a href="{{ asset('storage/documents/' . $application->other_document) }}" target="_blank">Other Document</a><br>
                                @else
                                    <span>No Other Document</span><br>
                                @endif
                            </div>
                        @else
                            <span>No Documents</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('verifyApplication', $application->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-success">Verified</button>
                        </form>
                        <form action="{{ route('unverifyApplication', $application->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Unverified</button>
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
