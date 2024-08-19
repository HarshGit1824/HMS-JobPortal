<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EmployeeHUB | Landing Page</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif, sans-serif;
            background-image: url('/assets/images/landing.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Changed from center to flex-start */
            height: 100vh;
            margin: 0;
            padding-top: 100px; /* Further increased padding to the top */
        }

        .landing-page {
            text-align: center;
            animation: fadeIn 1s ease-out;
        }

        .login-options {
            margin-top: 50px; /* Further increased positive margin to move the cards downward */
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .login-option {
            margin: 15px;
            display: inline-block;
            width: 200px;
            height: 200px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            animation: slideIn 0.5s ease-out;
            transition: transform 0.3s;
        }

        .login-option:hover {
            transform: scale(1.1);
        }

        .login-option img {
            width: 50px;
            height: 50px;
            margin: 20px;
            border-radius: 50%;
        }

        .login-option h3 {
            font-weight: bold;
            margin-top: 10px;
        }

        .login-option a {
            text-decoration: none;
            color: #278af5;
        }

        .login-option a:hover {
            color: #0062cc;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            0% {
                transform: translateX(-50px);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="landing-page">
        <h1>Welcome to Our EmployeeHUB!</h1>
        <p>Please choose a login option:</p>
        <div class="login-options">
            <div class="login-option">
                <img src="assets/images/avatar7.png" alt="User Icon">
                <h3>User Login</h3>
                <a href="{{ route('account.login') }}">Login</a>
            </div>
            <div class="login-option">
                <img src="/assets/images/download.png" alt="Company Icon">
                <h3>Company Admin Login</h3>
                <a href="{{ route('account.cadminlogin') }}">Login</a>
            </div>
            <div class="login-option">
                <img src="/assets/images/images.png" alt="Recruiter Icon">
                <h3>Recruiter Login</h3>
                <a href="{{ route('account.recruiterlogin') }}">Login</a>
            </div>
            <div class="login-option">
                <img src="/assets/images/images.jpeg" alt="Third Party Icon">
                <h3>Third Party Login</h3>
                <a href="{{ route('account.thirdpartylogin') }}">Login</a>
            </div>
            <div class="login-option">
                <img src="/assets/images/download.jpeg" alt="Admin Icon">
                <h3>Website Admin Login</h3>
                <a href="{{ route('front.account.wadminlogin') }}">Login</a>
            </div>
        </div>
    </div>
</body>
</html>
