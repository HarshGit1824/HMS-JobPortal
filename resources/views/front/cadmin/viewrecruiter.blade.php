<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Details</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    @include('front.layouts.caheader')
    @include('front.layouts.casidebar')
    <div class="container1">
        <h2>View Recruiter</h2>
        <div class="d-flex flex-row-reverse mb-3">
            <button class="btn btn-primary btn-new-post" style="float: right" data-toggle="modal" data-target="#addRecruiterModal">New Recruiter</button>
        </div>
        <table class="application-table">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Contact No</th>
                    <th>Email ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($recruiters->isNotEmpty())
                    @foreach($recruiters as $recruiter)
                        <tr valign="middle">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $recruiter->name }}</td>
                            <td>{{ $recruiter->department }}</td>
                            <td>{{ $recruiter->mobile }}</td>
                            <td>{{ $recruiter->email }}</td>
                            
                            <td>
                                <a href="#" class="edit-icon" data-toggle="modal" data-target="#editRecruiterModal"
                                   data-id="{{ $recruiter->id }}"
                                   data-name="{{ $recruiter->name }}"
                                   data-department="{{ $recruiter->department }}"
                                   data-mobile="{{ $recruiter->mobile }}"
                                   data-email="{{ $recruiter->email }}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                
                                <a href="#" class="delete-icon" data-id="{{ $recruiter->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">Record Not Found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Add Recruiter Modal -->
    <div class="modal" id="addRecruiterModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Recruiter</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post" id="addRecruiter" name="addRecruiter" action="{{ route('recruiter.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                            <p class="invalid-feedback" id="name-error"></p>
                        </div>
                        <div class="form-group">
                            <label for="department">Department:</label>
                            <input type="text" class="form-control" id="department" name="department" placeholder="Enter department">
                            <p class="invalid-feedback" id="department-error"></p>
                        </div>
                        <div class="form-group">
                            <label for="contact_number">Mobile No.:</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter contact number">
                            <p class="invalid-feedback" id="mobile-error"></p>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                            <p class="invalid-feedback" id="email-error"></p>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                            <p class="invalid-feedback" id="password-error"></p>
                        </div>
                        <button class="btn btn-primary mt-2" type="submit">Add Recruiter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Recruiter Modal -->
    <div class="modal" id="editRecruiterModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Recruiter</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="post" id="editRecruiter" name="editRecruiter">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="edit_name">Name:</label>
                            <input type="text" class="form-control" id="edit_name" name="name" placeholder="Enter name">
                            <p class="invalid-feedback" id="edit_name-error"></p>
                        </div>
                        <div class="form-group">
                            <label for="edit_department">Department:</label>
                            <input type="text" class="form-control" id="edit_department" name="department" placeholder="Enter department">
                            <p class="invalid-feedback" id="edit_department-error"></p>
                        </div>
                        <div class="form-group">
                            <label for="edit_mobile">Mobile No.:</label>
                            <input type="text" class="form-control" id="edit_mobile" name="mobile" placeholder="Enter contact number">
                            <p class="invalid-feedback" id="edit_mobile-error"></p>
                        </div>
                        <div class="form-group">
                            <label for="edit_email">Email:</label>
                            <input type="email" class="form-control" id="edit_email" name="email" placeholder="Enter email">
                            <p class="invalid-feedback" id="edit_email-error"></p>
                        </div>
                        <div class="form-group">
                            <label for="edit_password">Password:</label>
                            <input type="password" class="form-control" id="edit_password" name="password" placeholder="Enter password">
                            <p class="invalid-feedback" id="edit_password-error"></p>
                        </div>
                        <button class="btn btn-primary mt-2" type="submit">Edit Recruiter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle add recruiter form submission
            $("#addRecruiter").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('recruiter.store') }}",
                    type: 'post',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status == 'error') {
                            $.each(response.errors, function(key, value) {
                                $("#" + key).addClass('is-invalid');
                                $("#" + key + "-error").text(value[0]);
                            });
                        } else if (response.status == 'success') {
                            alert(response.message);
                            $("#addRecruiter")[0].reset();
                            window.location.href = '{{ route("front.cadmin.viewrecruiter") }}';
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Open edit modal and populate form with recruiter data
            $('.edit-icon').click(function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var department = $(this).data('department');
                var mobile = $(this).data('mobile');
                var email = $(this).data('email');

                // Generate the URL with the correct parameter
                var url = '{{ route("recruiter.update", ":id") }}';
                url = url.replace(':id', id);

                // Set the action attribute of the form
                $('#editRecruiter').attr('action', url);
                
                // Populate form fields with recruiter data
                $('#edit_name').val(name);
                $('#edit_department').val(department);
                $('#edit_mobile').val(mobile);
                $('#edit_email').val(email);
            });

            // Handle edit recruiter form submission
            $("#editRecruiter").submit(function(e) {
                e.preventDefault();
                var url = $(this).attr('action');
                $.ajax({
                    url: url,
                    type: 'post',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status == 'error') {
                            $.each(response.errors, function(key, value) {
                                $("#edit_" + key).addClass('is-invalid');
                                $("#edit_" + key + "-error").text(value[0]);
                            });
                        } else if (response.status == 'success') {
                            alert(response.message);
                            $("#editRecruiter")[0].reset();
                            window.location.href = '{{ route("front.cadmin.viewrecruiter") }}';
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Handle delete recruiter
            $('.delete-icon').click(function() {
                if (!confirm('Are you sure you want to delete this recruiter?')) {
                    return;
                }
                
                var id = $(this).data('id');
                var url = '{{ route("recruiter.destroy", ":id") }}';
                url = url.replace(':id', id);

                $.ajax({
                    url: url,
                    type: 'delete',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            alert(response.message);
                            window.location.href = '{{ route("front.cadmin.viewrecruiter") }}';
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>
