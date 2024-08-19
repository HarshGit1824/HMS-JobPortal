<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Thirdparty;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class ThirdPartyController extends Controller
{
    // public function show()
    // {
    //     $thirdparty = Auth::guard('thirdparty')->user(); // Use the correct guard
    //     if ($thirdparty) {           
    //         $thirdparty = Auth::guard('thirdparty')->user();
    //     // Fetch all service requests for verification
    //     $requests = ServiceRequest::all();
    //     return view('front.Thirdparty.verification', compact('requests'));
    //     }else {
    //         return redirect()->route('account.thirdpartylogin')->with('error', 'Please login first.');
    //         }
    // }

    // app/Http/Controllers/ThirdPartyController.php
// app/Http/Controllers/ThirdPartyController.php
    public function show()
    {
        $thirdparty = Auth::guard('thirdparty')->user();
        if ($thirdparty) {
            // Fetch all applications with 'verification' round_status and their associated recruiters, companies, and documents
            $applications = Application::with(['jobpost.recruiter.company', 'documents'])
                                        ->where('status', 'Verification')
                                        ->get();

            return view('front.thirdparty.verification', compact('applications'));
        } else {
            return redirect()->route('account.thirdpartylogin')->with('error', 'Please login first.');
        }
    }



    public function showApplications(/*$id*/)
    {
        $thirdparty = Auth::guard('thirdparty')->user(); // Use the correct guard
        if ($thirdparty) {           
            $thirdparty = Auth::guard('thirdparty')->user();
        // Find the service request by its ID
        //$request = ServiceRequest::findOrFail($id);

        // Assuming you want to show the applications list in a separate view
    return view('front.Thirdparty.showapplications'/*, compact('request')*/);
        }else {
                return redirect()->route('account.thirdpartylogin')->with('error', 'Please login first to view applications.');
        }
    }


    public function verifyApplication($id)
    {
        // Find the application by ID
        $application = Application::findOrFail($id);

        // Update the status to Verified
        $application->status = 'Verified';
        $application->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Application status updated to Verified.');
    }

    public function unverifyApplication($id)
    {
        // Find the application by ID
        $application = Application::findOrFail($id);

        // Update the status to Unverified
        $application->status = 'Unverified';
        $application->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Application status updated to Unverified.');
    }

    public function destroy($id)
    {
        $application = Application::findOrFail($id);
        $application->delete();

        return redirect()->back()->with('success', 'Application deleted successfully');
    }

    public function thforgotpass()
    {
        $thirdparty=Auth::guard('thirdparty')->user(); // Use the correct guard
        return view('front.Thirdparty.forgotpass',compact('thirdparty'));
    }

    public function TforgotPass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:thirdpartylogin,email',
            'password' => 'required|string|min:8|same:confirm_password',
            'confirm_password' => 'required|string|min:8|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $company = Thirdparty::where('email', $request->email)->first();
        $company->password = Hash::make($request->password);
        $company->save();

        return response()->json(['success' => 'Password has been successfully updated.']);

    }
    public function ThirdHome(){
        $thirdparty = Auth::guard('thirdparty')->user(); // Use the correct guard
        if ($thirdparty) {           
            $thirdparty = Auth::guard('thirdparty')->user();
             // Fetch count of applications with status 'Verification'
    $totalRequests = Application::where('status', 'Verification')->count();

    // Fetch count of applications with status 'Verified'
    $totalVerified = Application::where('status', 'Verified')->count();

    // Pass the counts to the view
    return view('front.Thirdparty.home', compact('totalRequests', 'totalVerified'));
    } else {
        return redirect()->route('account.thirdpartylogin')->with('error', 'Please login first.');
        }
    }
    public function thirdpartylogin()
    {
        return view('front.account.thirdpartylogin');
    }
    public function loginPost(Request $request){
        
        if(Auth::guard('thirdparty')->attempt(['email' => $request -> email,'password'=> $request -> password])){
            return redirect()->intended(route('front.Thirdparty.home'));
        }
        else{
            return redirect(route('account.thirdpartylogin'))->with('error','Invalid Credentials');
        }
    }
    public function Tlogout(Request $request){
        Auth::guard('thirdparty')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing');
    }
}
