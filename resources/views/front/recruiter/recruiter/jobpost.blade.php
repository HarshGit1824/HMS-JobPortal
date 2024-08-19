<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jobpost.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/newpost.css') }}">
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Job Posts</title>
</head>
<body>
    @include('front.layouts.Rheader')
    @include('front.layouts.Rsidebar')

    <div class="container1">
        <h2>Job Posts</h2>
        <button class="btn btn-primary btn-new-post" style="float: right" data-bs-toggle="modal" data-bs-target="#myModal">+ New Job Post</button>
        <table>
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>Position</th>
                    <th>Category</th>
                    <th>Job Nature</th>
                    <th>Vacancy</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Salary</th>
                    <th>Experience</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            {{-- <tbody>
                @foreach($jobPosts as $key => $jobPost)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $jobPost->position_name }}</td>
                        <td>{{ $jobPost->category }}</td>
                        <td>{{ $jobPost->job_type }}</td>
                        <td>{{ $jobPost->vacancy }}</td>
                        <td>{{ $jobPost->start_date }}</td>
                        <td>{{ $jobPost->end_date }}</td>
                        <td>{{ $jobPost->salary_range_from }} - {{ $jobPost->salary_range_to }}</td>
                        <td>{{ $jobPost->experience }}</td>
                        <td>{{ $jobPost->location }}</td>
                        <td>{{ $jobPost->description }}</td>
                        <td class="actions">
                            <span class="edit-icon">&#9998;</span>
                            <span class="delete-icon">&#128465;</span>
                        </td>
                    </tr>
                @endforeach
            </tbody> --}}
            <tbody>
                @foreach($jobPosts as $key => $jobPost)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $jobPost->position_name }}</td>
                        <td>{{ $jobPost->category }}</td>
                        <td>{{ ucfirst($jobPost->job_type) }}</td>
                        <td>{{ $jobPost->vacancy }}</td>
                        <td>{{ $jobPost->start_date }}</td>
                        <td>{{ $jobPost->end_date }}</td>
                        <td>{{ $jobPost->salary_range_from }} - {{ $jobPost->salary_range_to }}</td>
                        <td>{{ $jobPost->experience }}</td>
                        <td>{{ $jobPost->location }}</td>
                        <td>{{ $jobPost->description }}</td>
                        <td class="actions">
                            <button class="btn btn-sm btn-primary edit-btn" data-id="{{ $jobPost->id }}">Edit</button>
                            <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $jobPost->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add a modal popup structure -->
    {{-- <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Job Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="jobpostform" name="jobpostform" action="{{ route('jobpost.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="position_name">Position Name<span class="req">*</span></label>
                            <input type="text" id="position_name" name="position_name" class="form-control">
                            <p></p>
                        </div>
                        <div class="form-group">
                            <label for="category">Category<span class="req">*</span></label>
                            <select id="category" name="category" class="form-control" required>
                                <option value="">Select Category</option>

                                @if($categories->isNotEmpty())
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="job_type">Job Nature<span class="req">*</span></label>
                            <div class="dropdown">
                                <select id="job_type" name="job_type" class="form-control" required>
                                    <option value="">Select Job Nature</option>
                                    @if($jobTypes->isNotEmpty())
                                        @foreach($jobTypes as $jobType)
                                        <option value="{{ $jobType->id }}">{{ $jobType->name }}</option>
                                        @endforeach
                                    @endif

                                </select>
                                <span class="dropdown-arrow"></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="vacancy">Vacancy<span class="req">*</span></label>
                            <input type="number" id="vacancy" name="vacancy" class="form-control">
                            <p></p>
                        </div>
                        <div class="mb-3">
                            <label for="start_date">Start Date<span class="req">*</span></label>
                            <input type="date" id="start_date" name="start_date" class="form-control">
                            <p></p>
                        </div>
                        <div class="mb-3">
                            <label for="end_date">End Date<span class="req">*</span></label>
                            <input type="date" id="end_date" name="end_date" class="form-control">
                            <p></p>
                        </div>
                        
                        <div class="mb-3">
                            <label for="salary_range_from">Salary Range <span class="req">*</span></label>
                            <div class="d-flex align-items-center">
                                <input type="text" id="salary_range_from" name="salary_range_from" class="form-control" style="width: 45%; margin-right: 5px;" placeholder="Ex: 5">
                                <span>-</span>
                                <input type="text" id="salary_range_to" name="salary_range_to" class="form-control" style="width: 45%; margin-left: 5px;" placeholder="Ex: 6">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb=2">Experience<span class="req">*</span></label>
                            <select name="experience" id="experience" class="form_control">
                                <option value="1">1 Year</option>
                                <option value="2">2 Years</option>
                                <option value="3">3 Years</option>
                                <option value="4">4 Years</option>
                                <option value="5">5 Years</option>
                                <option value="6">6 Years</option>
                                <option value="7">7 Years</option>
                                <option value="8">8 Years</option>
                                <option value="9">9 Years</option>
                                <option value="10">10 Years</option>
                                <option value="10_plus">10+ Years</option>
                            </select>

                        </div>
                        <div class="mb-3">
                            <label for="location">Location</label>
                            <input type="text" id="location" name="location" class="form-control">
                            <p></p>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="mb-2">Description<span class="req">*</span></label>
                            <textarea name="description" id="description" placeholder="Description" class="form-control" rows="5"></textarea>
                            <p></p>
                        </div>
                        <div class="btn-group">
                            <button type="submit" class="btn-save">Save</button>
                            <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Add/Edit Modal -->
<div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Job Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="jobpostform" name="jobpostform" action="{{ route('jobpost.store') }}">
                    @csrf
                    <input type="hidden" id="jobpost_id" name="jobpost_id">
                    @csrf
                    <div class="mb-3">
                        <label for="position_name">Position Name<span class="req">*</span></label>
                        <input type="text" id="position_name" name="position_name" class="form-control">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <label for="category">Category<span class="req">*</span></label>
                        <select id="category" name="category" class="form-control" required>
                            <option value="">Select Category</option>

                            @if($categories->isNotEmpty())
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            @endif

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="job_type">Job Nature<span class="req">*</span></label>
                        <div class="dropdown">
                            <select id="job_type" name="job_type" class="form-control" required>
                                <option value="">Select Job Nature</option>
                                <option value="Freelancer">Freelancer</option>
                                <option value="Part Time">Part Time</option>
                                <option value="Full Time">Full Time</option>
                                <option value="Contract">Contract</option>
                                <option value="Remote">Remote</option>
                                

                            </select>
                            <span class="dropdown-arrow"></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="vacancy">Vacancy<span class="req">*</span></label>
                        <input type="number" id="vacancy" name="vacancy" class="form-control">
                        <p></p>
                    </div>
                    <div class="mb-3">
                        <label for="start_date">Start Date<span class="req">*</span></label>
                        <input type="date" id="start_date" name="start_date" class="form-control">
                        <p></p>
                    </div>
                    <div class="mb-3">
                        <label for="end_date">End Date<span class="req">*</span></label>
                        <input type="date" id="end_date" name="end_date" class="form-control">
                        <p></p>
                    </div>
                    
                    <div class="mb-3">
                        <label for="salary_range_from">Salary Range <span class="req">*</span></label>
                        <div class="d-flex align-items-center">
                            <input type="text" id="salary_range_from" name="salary_range_from" class="form-control" style="width: 45%; margin-right: 5px;" placeholder="Ex: 5">
                            <span>-</span>
                            <input type="text" id="salary_range_to" name="salary_range_to" class="form-control" style="width: 45%; margin-left: 5px;" placeholder="Ex: 6">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="" class="mb=2">Experience<span class="req">*</span></label>
                        <select name="experience" id="experience" class="form_control">
                            <option value="1">1 Year</option>
                            <option value="2">2 Years</option>
                            <option value="3">3 Years</option>
                            <option value="4">4 Years</option>
                            <option value="5">5 Years</option>
                            <option value="6">6 Years</option>
                            <option value="7">7 Years</option>
                            <option value="8">8 Years</option>
                            <option value="9">9 Years</option>
                            <option value="10">10 Years</option>
                            <option value="10_plus">10+ Years</option>
                        </select>

                    </div>
                    <div class="mb-3">
                        <label for="location">Location</label>
                        <input type="text" id="location" name="location" class="form-control">
                        <p></p>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="mb-2">Description<span class="req">*</span></label>
                        <textarea name="description" id="description" placeholder="Description" class="form-control" rows="5"></textarea>
                        <p></p>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn-save">Save</button>
                        <button type="button" class="btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // $(document).ready(function () {
        //     $("#jobpostform").submit(function(e) {
        //         e.preventDefault();

        //         // Clear any previous error messages
        //         $(".form-control").removeClass("is-invalid");
        //         $(".invalid-feedback").html("");

        //         // Validate form fields
        //         var isValid = true;
        //         var errors = {};

        //         if ($("#position_name").val() == "") {
        //             $("#position_name").addClass("is-invalid");
        //             errors.position_name = ["Position name is required"];
        //             isValid = false;
        //         }

        //         if ($("#category").val() == "") {
        //             $("#category").addClass("is-invalid");
        //             errors.category = ["category is required"];
        //             isValid = false;
        //         }

        //         if ($("#job_type").val() == "") {
        //             $("#job_type").addClass("is-invalid");
        //             errors.job_type = ["job_type is required"];
        //             isValid = false;
        //         }

        //         if ($("#vacancy").val() == "" || isNaN($("#vacancy").val()) || parseInt($("#vacancy").val()) < 1) {
        //             $("#vacancy").addClass("is-invalid");
        //             errors.vacancy = ["Valid vacancy is required"];
        //             isValid = false;
        //         }

        //         if ($("#start_date").val() == "") {
        //             $("#start_date").addClass("is-invalid");
        //             errors.start_date = ["Start date is required"];
        //             isValid = false;
        //         }

        //         if ($("#end_date").val() == "") {
        //             $("#end_date").addClass("is-invalid");
        //             errors.end_date = ["End date is required"];
        //             isValid = false;
        //         }

        //         if ($("#salary_range_from").val() == "" || isNaN($("#salary_range_from").val()) || parseInt($("#salary_range_from").val()) < 1) {
        //             $("#salary_range_from").addClass("is-invalid");
        //             errors.salary_range = ["Valid salary range is required"];
        //             isValid = false;
        //         }
        //         if ($("#salary_range_to").val() == "" || isNaN($("#salary_range_to").val()) || parseInt($("#salary_range_to").val()) < 1) {
        //             $("#salary_range_to").addClass("is-invalid");
        //             errors.salary_range = ["Valid salary range is required"];
        //             isValid = false;
        //         }

        //         if ($("#location").val() == "") {
        //             $("#location").addClass("is-invalid");
        //             errors.location = ["Location is required"];
        //             isValid = false;
        //         }

        //         // If form is not valid, display error messages
        //         if (!isValid) {
        //             for (var key in errors) {
        //                 var p = $("#" + key).siblings("p");
        //                 p.html(errors[key][0]);
        //                 p.addClass("invalid-feedback");
        //             }
        //             return;
        //         }

        //         // If form is valid, submit the form using AJAX
        //         $.ajax({
        //             url: $("#jobpostform").attr('action'),
        //             type: 'post',
        //             data: $("#jobpostform").serialize(),
        //             dataType: 'json',
        //             success: function(response) {
        //                 if (response.status == 'error') {
        //                     var errors = response.errors;
        //                     for (var key in errors) {
        //                         $("#" + key)
        //                             .addClass('is-invalid')
        //                             .siblings('p')
        //                             .addClass('invalid-feedback')
        //                             .html(errors[key][0]);
        //                     }
        //                 } else if (response.status == 'success') {
        //                     alert(response.message);
        //                     $("#jobpostform")[0].reset();
        //                     window.location.href = '{{ route("front.recruiter.jobpost") }}';
        //                 }
        //             }
        //         });
        //     });
        // });
        $(document).ready(function () {
    // Handle Edit Button Click
    $('.edit-btn').click(function () {
        var id = $(this).data('id');
        $.ajax({
            url: '/jobpost/' + id + '/edit',
            type: 'GET',
            success: function (response) {
                // Populate modal with data
                $('#jobpost_id').val(response.id);
                $('#position_name').val(response.position_name);
                $('#category').val(response.category);
                $('#job_type').val(response.job_type);
                $('#vacancy').val(response.vacancy);
                $('#start_date').val(response.start_date);
                $('#end_date').val(response.end_date);
                $('#salary_range_from').val(response.salary_range_from);
                $('#salary_range_to').val(response.salary_range_to);
                $('#experience').val(response.experience);
                $('#location').val(response.location);
                $('#description').val(response.description);

                // Show the modal
                $('#myModal').modal('show');
            }
        });
    });

    // Handle Delete Button Click
    $('.delete-btn').click(function () {
        var id = $(this).data('id');
        if (confirm('Are you sure you want to delete this job post?')) {
            $.ajax({
                url: '/jobpost/' + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        window.location.reload();
                    } else {
                        alert('Failed to delete the job post');
                    }
                }
            });
        }
    });

    // Handle form submission for create/update
    $("#jobpostform").submit(function (e) {
        e.preventDefault();
        var id = $('#jobpost_id').val();
        var url = id ? '/jobpost/' + id : '{{ route('jobpost.store') }}';
        var method = id ? 'PUT' : 'POST';

        $.ajax({
            url: url,
            type: method,
            data: $(this).serialize(),
            success: function (response) {
                if (response.status === 'success') {
                    alert(response.message);
                    $('#myModal').modal('hide');
                    window.location.reload();
                } else {
                    alert('Failed to save the job post');
                }
            }
        });
    });
});

    </script>
</body>
</html>