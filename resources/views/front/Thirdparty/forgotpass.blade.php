<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/forgotpass.css') }}">

</head>
<body>
    @include('front.layouts.Tpheader')
    @include('front.layouts.Tpsidebar')
    <div class="container1">
        <h2>Change your password here!</h2>
    </div>
    <div class="container4">        
        <form id="forgot-password-form" method="POST" action="{{ route('thirdparty.forgotpass') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="{{ $thirdparty->email }}" disabled>
                <input type="hidden" name="email" value="{{ $thirdparty->email }}">
                <div class="error-message" id="email-error"></div>
            </div>

            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" >
                <div class="error-message" id="password-error"></div>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" >
                <div class="error-message" id="confirm-password-error"></div>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn-save">Save</button>
                <button type="button" class="btn-cancel">Cancel</button>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#forgot-password-form').on('submit', function(event) {
                event.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            alert('Password reset successfully.');
                            window.location.href = "{{ route('account.thirdpartylogin') }}";
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        if (errors.email) {
                            $('#email-error').text(errors.email[0]);
                        } else {
                            $('#email-error').text('');
                        }
                        if (errors.password) {
                            $('#password-error').text(errors.password[0]);
                        } else {
                            $('#password-error').text('');
                        }
                        if (errors.confirm_password) {
                            $('#confirm-password-error').text(errors.confirm_password[0]);
                        } else {
                            $('#confirm-password-error').text('');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
