<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function getAllNotifications(Request $request)
    {
        try {
            $userEmail = $request->user()->email;
            $notifications = Notification::where('applicant_email', $userEmail)->get();
            return view('front.user.notifications', compact('notifications'));
        } catch (\Exception $e) {
            // Log the error or return an error view
            return view('errors.notification_error', ['error' => $e->getMessage()]);
        }
    }

    public function notify()
    {
        // You can perform some action here if needed
        // For example, return a view with a form to create notifications
        return view('front.user.notifications');
    }
}
