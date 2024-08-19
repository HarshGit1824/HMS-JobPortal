<!DOCTYPE html>
<html class="no-js" lang="en_AU">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>EmployeeHUB | Find Best Jobs</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
    <meta name="HandheldFriendly" content="True" />
    <meta name="pinterest" content="nopin" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}" />
    <!-- Fav Icon -->
    <link rel="shortcut icon" type="image/x-icon" href="#" />
</head>
<body data-instant-intensity="mousedown">

<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
        <div class="container">
            <a class="navbar-brand" href="index.html">EmployeeHUB</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
</header>

<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Register</h1>

                    <form method="POST" id="cadminregistration" name="cadminregistration" action="{{ route('account.cadminregister') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="ceoname" class="mb-2">CEO Name:</label>
                            <input type="text" id="ceoname" name="ceoname" class="form-control" placeholder="Enter CEO Name">
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label for="cname" class="mb-2">Company Name:</label>
                            <input type="text" id="cname" name="cname" class="form-control" placeholder="Enter Company Name">
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="mb-2">Company Email:</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter Company Email">
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label for="link" class="mb-2">Website link:</label>
                            <input type="link" id="link" name="link" class="form-control" placeholder="Enter your website link">
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label for="mobile" class="mb-2">Mobile Number:</label>
                            <input type="tel" id="mobile" name="mobile" class="form-control" placeholder="Enter mobile number">
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="mb-2">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password">
                            <p></p>
                        </div>

                        <div class="mb-3">
                            <label for="confirmed_password" class="mb-2">Confirm Password:</label>
                            <input type="password" name="confirmed_password" id="confirmed_password" class="form-control" placeholder="Enter confirmed Password">
                            <p></p>
                        </div>

                        <button class="btn btn-primary mt-2" type="submit">Register</button>
                    </form>
                </div>
                <div class="mt-4 text-center">
                    <p>Have an account? <a href="{{ route('account.cadminlogin') }}">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            $("#cadminregistration").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('account.cadminregister') }}",
                    type: 'post',
                    data: $("#cadminregistration").serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'error') {
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
                                    .html('');
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
                                    .html('');
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
                                    .html('');
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
                                    .html('');
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
                                    .html('');
                            }

                            if (errors.password) {
                                $("#password")
                                    .addClass('is-invalid')
                                    .siblings('p')
                                    .addClass('invalid-feedback')
                                    .html(errors.password[0]);
                            } else {
                                $("#password").removeClass('is-invalid')
                                    .siblings('p')
                                    .removeClass('invalid-feedback')
                                    .html('');
                            }

                            if (errors.confirmed_password) {
                                $("#confirmed_password")
                                    .addClass('is-invalid')
                                    .siblings('p')
                                    .addClass('invalid-feedback')
                                    .html(errors.confirmed_password[0]);
                            } else {
                                $("#confirmed_password").removeClass('is-invalid')
                                    .siblings('p')
                                    .removeClass('invalid-feedback')
                                    .html('');
                            }
                        } else if (response.status == 'success') {
                            alert(response.message);
                            $("#cadminregistration")[0].reset();
                            window.location.href='{{ route("account.cadminlogin") }}';
                        }
                    }
                });
            });
        });

</script>

</body>
</html>
