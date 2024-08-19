<!-- resources/views/front/password/email.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">EmployeeHUB</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
    </header>
    <section class="section-5">
        <div class="container my-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 p-5">
                        <h1 class="h3">Forgot Password</h1>
                        <form action="{{ route('password.email') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="mb-2">Email*</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@example.com" required>
                                @error('email')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <button class="btn btn-primary mt-2">Send Password Reset Link</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
