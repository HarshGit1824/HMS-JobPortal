<!DOCTYPE html>
<html>
<head>
    <title>Applications</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    @include('front.layouts.Rheader')
    @include('front.layouts.Rsidebar')
    
    <div class="container1">
        <h2>Applications</h2>
        <!-- Search Bar -->
        <div class="mb-3 d-flex align-items-center">
            <label for="position" class="me-2">Search: </label>
            <input id="position" type="text" class="form-control" placeholder="Search by Name..." onkeyup="searchTable()">
        </div>
        
        <!-- Table -->
        <table class="application-table">
            <thead>
                <tr>
                    <th>Sr. No</th>
                    <th>Applicant Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Contact No.</th>
                    <th>Resume</th>
                    <th>Status</th>
                    <th>Candidate Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $key => $application)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $application->name }}</td>
                    <td>{{ $application->email }}</td>
                    <td>{{ $application->gender }}</td>
                    <td>{{ $application->contact }}</td>
                    <td>
                        @if($application->resume)
                            <a href="{{ asset('storage/resumes/' . $application->resume) }}" target="_blank">View Resume</a>
                        @else
                            No Resume
                        @endif
                    </td>
                    <td>{{ $application->status }}</td>
                    <td>{{ $application->round_status }}</td>
                    <td>
                        <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#editModal" data-applicant-id="{{ $application->id }}" data-round-status="{{ $application->round_status }}" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-applicant-id="{{ $application->id }}" title="Delete">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                        <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#messageModal" data-applicant-id="{{ $application->id }}" data-applicant-name="{{ $application->name }}">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
<!-- Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Send Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="messageForm" method="POST" action="{{ route('send.message') }}">
                    @csrf
                    <input type="hidden" name="applicant_id" id="applicantId">
                    <input type="hidden" name="applicant_email" id="applicantEmail"> <!-- New hidden field -->
                    <div class="mb-3">
                        <label for="applicantName" class="form-label">To:</label>
                        <input type="text" class="form-control" id="applicantName" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message:</label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Round Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="{{ route('update.round.status') }}">
                    @csrf
                    <input type="hidden" name="applicant_id" id="editApplicantId">
                    <div class="mb-3">
                        <label for="roundStatus" class="form-label">Round Status:</label>
                        <select id="roundStatus" name="round_status" class="form-control" required>
                            <option value="">Select Round</option>
                            @foreach($rounds as $round)
                                <option value="{{ $round->id }}">{{ $round->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this application?</p>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST" action="{{ route('delete.application') }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="applicant_id" id="deleteApplicantId">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("position");
            filter = input.value.toUpperCase();
            table = document.querySelector(".application-table");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
        var messageModal = document.getElementById('messageModal');
        messageModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var applicantId = button.getAttribute('data-applicant-id');
            var applicantName = button.getAttribute('data-applicant-name');
            var applicantEmail = button.getAttribute('data-applicant-email'); // New line
            
            var modalTitle = messageModal.querySelector('.modal-title');
            var modalBodyInput = messageModal.querySelector('#applicantId');
            var modalBodyEmailInput = messageModal.querySelector('#applicantEmail'); // New line
            var modalBodyNameInput = messageModal.querySelector('#applicantName');

            modalTitle.textContent = 'Send Message to ' + applicantName;
            modalBodyInput.value = applicantId;
            modalBodyEmailInput.value = applicantEmail; // New line
            modalBodyNameInput.value = applicantName;
        });
        var editModal = document.getElementById('editModal');
            editModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var applicantId = button.getAttribute('data-applicant-id');
                var roundStatus = button.getAttribute('data-round-status');

                var modalBodyInput = editModal.querySelector('#editApplicantId');
                var modalBodyRoundStatusInput = editModal.querySelector('#roundStatus');

                modalBodyInput.value = applicantId;
                modalBodyRoundStatusInput.value = roundStatus;
            });

        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var applicantId = button.getAttribute('data-applicant-id');

            var modalBodyInput = deleteModal.querySelector('#deleteApplicantId');
            modalBodyInput.value = applicantId;
        });
    });
    </script>
</body>
</html>
