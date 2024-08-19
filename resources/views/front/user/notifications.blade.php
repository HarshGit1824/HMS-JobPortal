<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="description" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
<meta name="HandheldFriendly" content="True" />
<meta name="pinterest" content="nopin" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
<title>Notification Dashboard</title>
<style>
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 20px;
    }
    h1 {
        text-align: center;
    }
    .notification-section {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 20px;
    }
    .notification {
        padding: 10px;
        border: 1px solid #ddd;
        margin-bottom: 10px;
        background-color: #f9f9f9;
    }
    .notification-title {
        font-weight: bold;
    }
</style>
</head>
<body>
    @include('front.layouts.header')
    <h1>Notification Dashboard</h1>

    <div class="notification-section" id="user-notifications">
        <h2>Your Notifications</h2>
        @foreach($notifications as $notification)
            <div class="notification">
                <div class="notification-title">{{ $notification->recruiter_email }}</div>
                <div class="notification-message">{{ $notification->message }}</div>
            </div>
        @endforeach
    </div>

    <!-- Include your JavaScript if needed -->

</body>
</html>
