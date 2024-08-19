<!DOCTYPE html>
<html>
<head>
    <title>Recruiter Dashboard</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
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
    .message-section {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 20px;
    }
    .message {
        padding: 10px;
        border: 1px solid #ddd;
        margin-bottom: 10px;
        background-color: #f1f1f1;
    }
    .message-title {
        font-weight: bold;
    }
</style>
<body>
    @include('front.layouts.Rheader')
    @include('front.layouts.Rsidebar')

    <div class="container1">
        <h2>Notifications and Messages</h2>

        <div class="notification-section" id="company-notifications">
            <h3>Company Notifications</h3>
            <!-- Notifications will be inserted here -->
        </div>

        <div class="message-section" id="communication-messages">
            <h3>Communication Messages</h3>
            <!-- Messages will be inserted here -->
        </div>
    </div>

    <script>
        // Sample data for notifications
        const companyNotifications = [
            { title: "Interview Invitation", message: "You are invited for an interview on April 30, 2024." },
            { title: "Job Offer", message: "Congratulations! You have received a job offer." },
        ];

        // Sample data for communication messages
        const communicationMessages = [
            { title: "Message from HR", message: "Please provide the required documents by the end of this week." },
            { title: "Follow-up", message: "Have you received the offer letter?" },
        ];

        function displayNotifications(sectionId, notifications) {
            const section = document.getElementById(sectionId);
            notifications.forEach((notification) => {
                const div = document.createElement("div");
                div.className = "notification";
                div.innerHTML = `
                    <div class="notification-title">${notification.title}</div>
                    <div class="notification-message">${notification.message}</div>
                `;
                section.appendChild(div);
            });
        }

        function displayMessages(sectionId, messages) {
            const section = document.getElementById(sectionId);
            messages.forEach((message) => {
                const div = document.createElement("div");
                div.className = "message";
                div.innerHTML = `
                    <div class="message-title">${message.title}</div>
                    <div class="message-content">${message.message}</div>
                `;
                section.appendChild(div);
            });
        }

        displayNotifications("company-notifications", companyNotifications);
        displayMessages("communication-messages", communicationMessages);

    </script>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
