@extends('front.layouts.app')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                {{-- <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                    </ol>
                </nav> --}}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('front.account.Usidebar')
            </div>
            <div class="col-lg-9">
                @include('front.message')
                <div class="card border-0 shadow mb-4">
                    <form class="" method="post" id="userForm" name="userForm">
                    <div class="card-body  p-4">
                        <h2 class="fs-4 mb-1">My Profile</h2>
                        <hr>
                        <div class="mb-4">
                            <label for="" class="mb-2">Name*</label>
                            <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control"
                            value="{{ $user->name }}">
                            <p></p>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Email*</label>
                            <input type="text" name="email" id="email" placeholder="Enter Email" class="form-control"
                            value="{{ $user->email }}">
                            <p></p>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Designation</label>
                            <input type="text" name="designation" id="designation" placeholder="Designation" class="form-control"
                            value="{{ $user->designation }}">
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Mobile</label>
                            <input type="text" name="mobile" id="mobile" placeholder="Mobile" class="form-control"
                            value="{{ $user->mobile }}">
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Address</label>
                            <textarea name="address" id="address" placeholder="This optional section can help you stand out to recruiters. If this section is empty, it will not appear on your resume." class="form-control" rows="5">{{ $user->address }}</textarea>                            
                        </div>
                    </div>
                    <hr>
                    <div class="card-body p-4">
                        <h2 class="fs-4 mb-1">Summary</h2>
                        <hr>
                        <div class="mb-4">
                            <label for="summary" class="mb-2"></label>
                            <textarea name="summary" id="summary" placeholder="This optional section can help you stand out to recruiters. If this section is empty, it will not appear on your resume." class="form-control" rows="5">{{ $user->summary }}</textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body p-4">
                        <h2 class="fs-4 mb-1">Skills</h2>
                        <hr>
                        <div class="mb-4">
                            <label for="skills" class="mb-2"></label>
                            <input type="text" name="skills" id="skills" placeholder="This optional section can help you stand out to recruiters. If this section is empty, it will not appear on your resume." class="form-control" value="{{ $user->skills }}" >
                            <p></p>
                        </div>
                    </div>

                    <div class="card-footer  p-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>


                {{-- <div class="card border-0 shadow mb-4">
                    <form class="update-form" method="post" action="{{ route('update.experience') }}">
                        @csrf
                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-1">Experience</h3>
                            <div class="mb-4">
                                <label for="experience" class="mb-2"></label>
                                <input type="text" name="experience" id="experience" placeholder="This optional section can help you stand out to recruiters. If this section is empty, it will not appear on your resume." class="form-control" >
                                <p></p>
                            </div>
                        </div>
                        <div class="card-footer p-4">
                            <button type="submit" class="btn btn-primary">ADD</button>
                        </div>
                    </form>
                </div> --}}

                <!-- Experience Information Card -->
                <div class="card border-0 shadow mb-4">
                    <div class="card-body p-4">
                        <h2 class="fs-4 mb-1">Experience</h2>
                        <hr>
                        @if($experiences->isNotEmpty())
                            @foreach($experiences as $experience)
                            <div class="mb-4">
                                <h6>Role : {{ $experience->role }}</h6>
                                <p><b>Company : </b>{{ $experience->company }}</p>
                                <p><b>Employment Type : </b>{{ $experience->emp_type }}</p>
                                <p><b>Location : </b>{{ $experience->location }}</p>
                                <p><b>Location Type : </b>{{ $experience->location_type }}</p>
                                <p><b>Duration : </b>{{ $experience->start_date }} <b>-</b> {{ $experience->end_date }}</p>
                                <p><b>Description : </b>{{ $experience->description }}</p>
                            </div>
                            <hr>
                            @endforeach
                        @else
                            <p>No experience information added yet.</p>
                        @endif
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#experienceModal">
                            Add Experience
                        </button>
                    </div>
                </div>
                


                <!-- Experience Modal -->
                <div class="modal fade" id="experienceModal" tabindex="-1" aria-labelledby="experienceModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form class="update-form" method="post" action="{{ route('update.experience') }}">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="experienceModalLabel">Add Experience</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-4">
                                        <label for="role" class="mb-2">Title/Role :</label>
                                        <input type="text" name="role" id="role" placeholder="Enter Title/Role" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label for="emp_type" class="mb-2">Employement Type :</label>
                                        <input type="text" name="emp_type" id="emp_type" placeholder="Enter Employement Type" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label for="company" class="mb-2">Company :</label>
                                        <input type="text" name="company" id="company" placeholder="Enter Company Name" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label for="location" class="mb-2">Location :</label>
                                        <input type="text" name="location" id="location" placeholder="Enter location" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label for="location_type" class="mb-2">Location Type :</label>
                                        <input type="text" name="location_type" id="location_type" placeholder="Enter location Type" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label for="start_date" class="mb-2">Start Date :</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label for="end_date" class="mb-2">End Date :</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label for="description" class="mb-2">Description :</label>
                                        <textarea name="description" id="description" placeholder="This discription" class="form-control" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Experience</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                                <!-- Education Section -->
                <div class="card border-0 shadow mb-4">
                    <div class="card-body p-4">
                        <h2 class="fs-4 mb-1">Education</h2>
                        <hr>
                        @if($education->isNotEmpty())
                            @foreach($education as $edu)
                            <div class="mb-4">
                                <h6>Degree : {{ $edu->degree }}</h6>
                                <p><b>Institution Name : </b>{{ $edu->institution }}</p>
                                <p><b>Field of study : </b>{{ $edu->field_of_study }}</p>
                                <p><b>Duration : </b>{{ $edu->start_date }} <b>-</b> {{ $edu->end_date }}</p>
                                <p><b>Grade/Percentage/CGPA : </b>{{ $edu->gradepercentage }}</p>
                            </div>
                            <hr>
                            @endforeach
                        @else
                            <p>No education information added yet.</p>
                        @endif
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#educationModal">
                            Add Education
                        </button>
                    </div>
                </div>


                <!-- Education Modal -->
                <div class="modal fade" id="educationModal" tabindex="-1" aria-labelledby="educationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form class="update-form" method="post" action="{{ route('update.education') }}">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="educationModalLabel">Add Education</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-4">
                                        <label for="institution" class="mb-2">Institution</label>
                                        <input type="text" name="institution" id="institution" placeholder="Enter Institution Name" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label for="degree" class="mb-2">Degree</label>
                                        <input type="text" name="degree" id="degree" placeholder="Enter Degree" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label for="field_of_study" class="mb-2">Field of Study</label>
                                        <input type="text" name="field_of_study" id="field_of_study" placeholder="Enter Field of Study" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label for="start_date" class="mb-2">Start Date</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label for="end_date" class="mb-2">End Date</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label for="gradepercentage" class="mb-2">Grade/Percentage</label>
                                        <textarea name="gradepercentage" id="gradepercentage" placeholder="Enter your marks and grades here" class="form-control" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Education</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


               

                <!-- Certifications Section -->
                <div class="card border-0 shadow mb-4">
                    <div class="card-body p-4">
                        <h2 class="fs-4 mb-1">Certifications</h2>
                        <hr>
                        @if($certificates->isNotEmpty())
                            <div class="row mb-3">
                                @foreach($certificates as $certificate)
                                    <div class="col-md-4 mb-3">
                                        <img src="{{ asset('storage/certifications/' . $certificate->document) }}" class="img-fluid" alt="Certificate">
                                        <p>{{ $certificate->certification_name }}</p>
                                        <p>{{ $certificate->institution }}</p>
                                        <p>{{ $certificate->date_obtained }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>No certifications added yet.</p>
                        @endif
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#certificationModal">
                            Add Certification
                        </button>
                    </div>
                </div>
                

                <!-- Certification Modal -->
                <div class="modal fade" id="certificationModal" tabindex="-1" aria-labelledby="certificationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form class="update-form" method="post" action="{{ route('update.certification') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="certificationModalLabel">Add Certification</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-4">
                                        <label for="certification_name" class="mb-2">Certification Name</label>
                                        <input type="text" name="certification_name" id="certification_name" placeholder="Enter Certification Name" class="form-control" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="institution" class="mb-2">Institution</label>
                                        <input type="text" name="institution" id="institution" placeholder="Enter Institution Name" class="form-control" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="date_obtained" class="mb-2">Date Obtained</label>
                                        <input type="date" name="date_obtained" id="date_obtained" class="form-control" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="document" class="mb-2">Upload Document</label>
                                        <input type="file" name="document" id="document" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Certification</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Project Modal -->
                <div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="projectForm" class="update-form" method="post" action="{{ route('update.projects') }}">
                                @csrf
                                <div class="card-body p-4">
                                    <h2 class="fs-4 mb-1">Projects</h2>
                                    <hr>
                                    <div class="mb-4">
                                        <label for="project_name" class="mb-2">Project Name</label>
                                        <input type="text" name="project_name" id="project_name" placeholder="Enter Project Name" class="form-control" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="start_date" class="mb-2">Start Date</label>
                                            <input type="date" name="start_date" id="start_date" class="form-control" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="end_date" class="mb-2">End Date</label>
                                            <input type="date" name="end_date" id="end_date" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="technologies" class="mb-2">Technology or Software Used</label>
                                        <input type="text" name="technologies" id="technologies" placeholder="Enter Technologies and Software Used" class="form-control" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="description" class="mb-2">Description</label>
                                        <textarea name="description" id="description" placeholder="Enter Project Description" class="form-control" rows="5" required></textarea>
                                    </div>
                                </div>
                                <div class="card-footer p-4">
                                    <button type="submit" id="submitProjectForm" class="btn btn-primary">ADD</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow mb-4">
                    <div class="card-body p-4">
                        <h2 class="fs-4 mb-1">Projects</h2>
                        <hr>
                        @if($projects->isNotEmpty())
                            @foreach($projects as $project)
                                <div class="mb-4">
                                    <h5>{{ $project->project_name }}</h5>
                                    <p><b>Start Date: </b>{{ $project->start_date }}</p>
                                    <p><b>End Date: </b>{{ $project->end_date }}</p>
                                    <p><b>Technology and Software Used: </b>{{ $project->technologies }}</p>
                                    <p><b>Description: </b>{{ $project->description }}</p>
                                </div>
                                <hr>
                            @endforeach
                        @else
                            <p>No projects added yet.</p>
                        @endif
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#projectModal">
                            Add Project
                        </button>
                    </div>
                </div>
                
                



                <!-- Bootstrap CSS -->
                <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

                <!-- Bootstrap Bundle with Popper -->
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>



                <div class="card border-0 shadow mb-4">
                    <form id="honorsAwardsForm" class="update-form" method="post" action="{{ route('update.honorsndawards') }}">
                        @csrf
                        <div class="card-body p-4">
                            <h2 class="fs-4 mb-1">Honors & Awards</h2>
                            <hr>
                            <div class="mb-4">
                                <label for="honorsndawards" class="mb-2"></label>
                                <textarea name="honorsndawards" id="honorsndawards" placeholder="This optional section can help you stand out to recruiters. If this section is empty, it will not appear on your resume." class="form-control" rows="5">{{ $user->updateHonorsNdAwards }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer p-4">
                            <button type="submit" class="btn btn-primary">ADD</button>
                        </div>
                    </form>
                </div>
                



            

            <meta name="csrf-token" content="{{ csrf_token() }}">

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-9">
                        <div id="changePasswordSection" style="display: none;">
                            <div class="card border-0 shadow mb-4">
                                <form action="" method="post" id="changePasswordForm" name="changePasswordForm">
                                    <div class="card-body p-4">
                                        <h3 class="fs-4 mb-1">Change Password</h3>
                                        <div class="mb-4">
                                            <label for="oldPassword" class="mb-2">Old Password*</label>
                                            <input type="password" name="old_password" id="old_password" placeholder="Old Password" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-4">
                                            <label for="newPassword" class="mb-2">New Password*</label>
                                            <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-4">
                                            <label for="confirmPassword" class="mb-2">Confirm Password*</label>
                                            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="form-control">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="card-footer p-4">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- JavaScript to handle dropdown and section visibility -->
            <script>
                // Get elements
                const accountSettings = document.getElementById('accountSettings');
                const accountDropdown = document.getElementById('accountDropdown');
                const changePasswordLink = document.getElementById('changePasswordLink');
                const changePasswordSection = document.getElementById('changePasswordSection');

                // Toggle dropdown visibility when clicking on Account Settings
                accountSettings.addEventListener('click', () => {
                    accountDropdown.style.display = accountDropdown.style.display === 'none' ? 'block' : 'none';
                });

                // Show the Change Password section when clicking on "Change Password"
                changePasswordLink.addEventListener('click', () => {
                    changePasswordSection.style.display = 'block';
                    accountDropdown.style.display = 'none'; // Hide the dropdown


                changePasswordSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                });
            </script>

            <!-- Bootstrap JS -->

            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script type= "text/javascript">
$("#userForm").submit(function(e) {
    e.preventDefault();

    // Get the CSRF token value
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '{{ route("user.updateProfile") }}',
        type: 'put',
        dataType: 'json',
        data: $('#userForm').serialize(),
        headers: {
            'X-CSRF-TOKEN': csrfToken // Include CSRF token in the headers
        },
        success: function(response) {
            if (response.status == true) {
                // Handle success

                $("#name").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                $("#email").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                window.location.href= "{{ route('user.profile') }}";

            } else {
                var errors = response.errors;

                if (errors.name) {
                    $("#name")
                        .addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.name[0]);
                } else {
                    $("#name").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')
                }

                if (errors.email) {
                    $("#email")
                        .addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.email[0]);
                } else {
                    $("#email").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')
                }
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            // Handle error
            console.error(xhr.responseText);
        }
    });
});

$("#changePasswordForm").submit(function(e) {
    e.preventDefault();

    // Get the CSRF token value
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: '{{ route("account.updatePassword") }}',
        type: 'post',
        dataType: 'json',
        data: $('#changePasswordForm').serialize(), // serialize form data properly
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function(response) {
            if (response.status === true) {
                // Clear any previous errors
                $("#old_password").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('');

                $("#new_password").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('');

                $("#confirm_password").removeClass('is-invalid')
                    .siblings('p')
                    .removeClass('invalid-feedback')
                    .html('');

                // Redirect to the profile page
                window.location.href = "{{ route('user.profile') }}";

            } else {
                var errors = response.errors;

                if (errors.old_password) {
                    $("#old_password")
                        .addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.old_password[0]);
                } else {
                    $("#old_password").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');
                }

                if (errors.new_password) {
                    $("#new_password")
                        .addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.new_password[0]);
                } else {
                    $("#new_password").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');
                }

                if (errors.confirm_password) {
                    $("#confirm_password")
                        .addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.confirm_password[0]);
                } else {
                    $("#confirm_password").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');
                }
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            console.error(xhr.responseText);
        }
    });
});
</script>
@endsection