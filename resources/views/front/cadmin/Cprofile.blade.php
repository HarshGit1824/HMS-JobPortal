@extends('front.cadmin.Capp')

@section('main')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Account Settings</li>
                        <div class="ms-auto">
                            <a class="btn btn-outline-primary" href="{{ route('front.cadmin.home') }}">Back to home</a>
                        </div>
                        {{-- <lin class="breadcrumb-item active">My Jobs</li> --}}
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('front.cadmin.casidebar')
            </div>
            <div class="col-lg-9">
                @include('front.message')
                <div class="card border-0 shadow mb-4">
                    <form class="" method="post" id="userForm" name="userForm">
                    <div class="card-body  p-4">
                        <h3 class="fs-4 mb-1">My Profile</h3>
                        <div class="mb-4">
                            <label for="" class="mb-2">CEO Name*</label>
                            <input type="text" name="ceoname" id="ceoname" placeholder="Enter CEO Name" class="form-control" 
                            value="{{ $company->ceoname }}">
                            <p></p>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Company Name*</label>
                            <input type="text" name="cname" id="cname" placeholder="Enter Company Name" class="form-control" 
                            value="{{ $company->cname }}">
                            <p></p>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Company Address*</label>
                            <input type="text" name="caddress" id="caddress" placeholder="Enter Company Address" class="form-control" 
                            value="{{ $company->caddress }}">
                            <p></p>
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Company Email*</label>
                            <input type="text" name="email" id="email" placeholder="Enter Company Email" class="form-control" 
                            value="{{ $company->email }}">
                            <p></p>
                        </div>
                        
                        <div class="mb-4">
                            <label for="" class="mb-2">Contact No.</label>
                            <input type="text" name="mobile" id="mobile" placeholder=" Enter Contact No." class="form-control"
                            value="{{ $company->mobile }}">
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">GSTN No.</label>
                            <input type="text" name="gstn" id="gstn" placeholder=" Enter GSTN No." class="form-control"
                            value="{{ $company->gstn }}">
                        </div>
                        <div class="mb-4">
                            <label for="" class="mb-2">Social Link</label>
                            <input type="text" name="link" id="link" placeholder="Enter Social Link" class="form-control"
                            value="{{ $company->link }}">
                        </div>                          
                    </div>
                    <div class="card-footer  p-4">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>

            
        
            <!-- Bootstrap JS -->
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

            <script>
                function toggleDropdown() {
                    const dropdown = document.getElementById('accountDropdown');
                    dropdown.classList.toggle('collapse'); // Toggle dropdown visibility
                }
            
                function scrollToFeaturedJobs() {
                    const section = document.getElementById('recent-job-posts');
                    section.scrollIntoView({ behavior: 'smooth' }); // Smooth scroll to "Featured Jobs"
                    
                    // Collapse the dropdown after scrolling
                    const dropdown = document.getElementById('accountDropdown');
                    dropdown.classList.add('collapse');
                }
            </script>


            <div class="col-lg-9">
                <div class="row">
                    <!-- Sidebar -->
                    <!-- Main content -->
                    <div class="col-md-9">
                        <div id="recentjobposts" style="display: none;">
                            <div class="card border-0 shadow mb-4">
                                <div class="card-body p-4">
                                    <h4>Recent Job Posts</h4>
                                    <div class="row pt-6">
                                        <div class="job_listing_area">                    
                                            <div class="job_lists">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="card border-0 p-3 shadow mb-4">
                                                            <div class="card-body">
                                                                <h3 class="border-0 fs-5 pb-2 mb-0">Web Developer</h3>
                                                                <p>We are in need of a Web Developer for our company.</p>
                                                                <div class="bg-light p-3 border">
                                                                    <p class="mb-0">
                                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                                        <span class="ps-1">Noida</span>
                                                                    </p>
                                                                    <p class="mb-0">
                                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                                        <span class="ps-1">Remote</span>
                                                                    </p>
                                                                    <p class="mb-0">
                                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                                        <span class="ps-1">2-3 Lacs PA</span>
                                                                    </p>
                                                                </div>
                            
                                                                <div class="d-grid mt-3">
                                                                    <a href="job-detail.html" class="btn btn-primary btn-lg">Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="card border-0 p-3 shadow mb-4">
                                                            <div class="card-body">
                                                                <h3 class="border-0 fs-5 pb-2 mb-0">Web Developer</h3>
                                                                <p>We are in need of a Web Developer for our company.</p>
                                                                <div class="bg-light p-3 border">
                                                                    <p class="mb-0">
                                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                                        <span class="ps-1">Noida</span>
                                                                    </p>
                                                                    <p class="mb-0">
                                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                                        <span class="ps-1">Remote</span>
                                                                    </p>
                                                                    <p class="mb-0">
                                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                                        <span class="ps-1">2-3 Lacs PA</span>
                                                                    </p>
                                                                </div>
                            
                                                                <div class="d-grid mt-3">
                                                                    <a href="job-detail.html" class="btn btn-primary btn-lg">Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="card border-0 p-3 shadow mb-4">
                                                            <div class="card-body">
                                                                <h3 class="border-0 fs-5 pb-2 mb-0">Web Developer</h3>
                                                                <p>We are in need of a Web Developer for our company.</p>
                                                                <div class="bg-light p-3 border">
                                                                    <p class="mb-0">
                                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                                        <span class="ps-1">Noida</span>
                                                                    </p>
                                                                    <p class="mb-0">
                                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                                        <span class="ps-1">Remote</span>
                                                                    </p>
                                                                    <p class="mb-0">
                                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                                        <span class="ps-1">2-3 Lacs PA</span>
                                                                    </p>
                                                                </div>
                            
                                                                <div class="d-grid mt-3">
                                                                    <a href="job-detail.html" class="btn btn-primary btn-lg">Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="card border-0 p-3 shadow mb-4">
                                                            <div class="card-body">
                                                                <h3 class="border-0 fs-5 pb-2 mb-0">Web Developer</h3>
                                                                <p>We are in need of a Web Developer for our company.</p>
                                                                <div class="bg-light p-3 border">
                                                                    <p class="mb-0">
                                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                                        <span class="ps-1">Noida</span>
                                                                    </p>
                                                                    <p class="mb-0">
                                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                                        <span class="ps-1">Remote</span>
                                                                    </p>
                                                                    <p class="mb-0">
                                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                                        <span class="ps-1">2-3 Lacs PA</span>
                                                                    </p>
                                                                </div>
                                                                <div class="d-grid mt-3">
                                                                    <a href="job-detail.html" class="btn btn-primary btn-lg">Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="card border-0 p-3 shadow mb-4">
                                                            <div class="card-body">
                                                                <h3 class="border-0 fs-5 pb-2 mb-0">Web Developer</h3>
                                                                <p>We are in need of a Web Developer for our company.</p>
                                                                <div class="bg-light p-3 border">
                                                                    <p class="mb-0">
                                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                                        <span class="ps-1">Noida</span>
                                                                    </p>
                                                                    <p class="mb-0">
                                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                                        <span class="ps-1">Remote</span>
                                                                    </p>
                                                                    <p class="mb-0">
                                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                                        <span class="ps-1">2-3 Lacs PA</span>
                                                                    </p>
                                                                </div>
                                                                <div class="d-grid mt-3">
                                                                    <a href="job-detail.html" class="btn btn-primary btn-lg">Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="card border-0 p-3 shadow mb-4">
                                                            <div class="card-body">
                                                                <h3 class="border-0 fs-5 pb-2 mb-0">Web Developer</h3>
                                                                <p>We are in need of a Web Developer for our company.</p>
                                                                <div class="bg-light p-3 border">
                                                                    <p class="mb-0">
                                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                                        <span class="ps-1">Noida</span>
                                                                    </p>
                                                                    <p class="mb-0">
                                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                                        <span class="ps-1">Remote</span>
                                                                    </p>
                                                                    <p class="mb-0">
                                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                                        <span class="ps-1">2-3 Lacs PA</span>
                                                                    </p>
                                                                </div>
                                                                <div class="d-grid mt-3">
                                                                    <a href="job-detail.html" class="btn btn-primary btn-lg">Details</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                         
                                                </div>
                                            </div>
                                        </div>
                                    </div>                       
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Change Password Section -->
            <div class="col-lg-9">
                <div class="row">
                    <!-- Sidebar -->
                    <!-- Main content -->
                    <div class="col-md-9">
                        <div id="changePasswordSection" style="display: none;">
                            <div class="card border-0 shadow mb-4">
                                <div class="card-body p-4">
                                    <h3 class="fs-4 mb-1">Change Password</h3>
                                    <div class="mb-4">
                                        <label for="oldPassword" class="mb-2">Old Password*</label>
                                        <input type="password" id="oldPassword" placeholder="Old Password" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label for="newPassword" class="mb-2">New Password*</label>
                                        <input type="password" id="newPassword" placeholder="New Password" class="form-control">
                                    </div>
                                    <div class="mb-4">
                                        <label for="confirmPassword" class="mb-2">Confirm Password*</label>
                                        <input type="password" id="confirmPassword" placeholder="Confirm Password" class="form-control">
                                    </div>                        
                                </div>
                                <div class="card-footer  p-4">
                                    <button type="button" class="btn btn-primary">Update</button>
                                </div>
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
        url: '{{ route("cadmin.updateProfile") }}',
        type: 'put',
        dataType: 'json',
        data: $('#userForm').serialize(),
        headers: {
            'X-CSRF-TOKEN': csrfToken // Include CSRF token in the headers
        },
        success: function(response) {
            if (response.status == true) {
                // Handle success

                $("#ceoname").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                $("#cname").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                $("#caddress").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                $("#email").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                $("#mobile").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                $("#gstn").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                $("#link").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                window.location.href= "{{ route('cadmin.Cprofile') }}";

            } else {
                var errors = response.errors;

                if (errors.ceoname) {
                    $("#ceoname")
                        .addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.ceoname[0]);
                } else {
                    $("#ceoname").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')
                }

                if (errors.cname) {
                    $("#cname")
                        .addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.cname[0]);
                } else {
                    $("#cname").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')
                }

                if (errors.caddress) {
                    $("#caddress")
                        .addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.caddress[0]);
                } else {
                    $("#caddress").removeClass('is-invalid')
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

                if (errors.mobile) {
                    $("#mobile")
                        .addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.mobile[0]);
                } else {
                    $("#mobile").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')
                }

                if (errors.gstn) {
                    $("#gstn")
                        .addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.gstn[0]);
                } else {
                    $("#gstn").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')
                }

                if (errors.link) {
                    $("#link")
                        .addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(errors.link[0]);
                } else {
                    $("#link").removeClass('is-invalid')
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

</script>
@endsection