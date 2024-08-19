<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Webadmin;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Company;
use App\Models\Recruiter;

class WebAdminController extends Controller
{
    public function start(){
        return view('landing');
    }
    public function details(){
        $companies = Company::all();
        return view('front.admin.viewdetails',compact('companies'));
    }
    public function candidate(){
         // Fetch data from the users table
        $candidates = User::all();

        // Pass the data to the view
    
        return view('front.admin.viewcandidates',compact('candidates'));
    }

    public function showRecruiters($companyId)
    {
        $company = Company::with('recruiters')->find($companyId);
        return response()->json($company->recruiters);
    }

    public function destroy($companyId)
    {
        $company = Company::find($companyId);
        $company->recruiters()->delete(); // delete all recruiters associated with the company
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully');
    }
    
    public function deleteCandidate($id)
    {
        // Find the candidate by ID and delete
        $candidate = User::findOrFail($id);
        $candidate->delete();

        // Redirect back to the candidates view with a success message
        return redirect()->route('front.admin.viewcandidates')->with('success', 'Candidate deleted successfully.');
    }
    public function forgot(){
        $webadmin = Auth::guard('webadmin')->user(); // Use the correct guard

        return view('front.admin.forgot',compact('webadmin'));
    }
    public function wforgotPass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:webadminlogin,email',
            'password' => 'required|string|min:8|same:confirm_password',
            'confirm_password' => 'required|string|min:8|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $webadmin = Webadmin::where('email', $request->email)->first();
        $webadmin->password = Hash::make($request->password);
        $webadmin->save();

        return response()->json(['success' => 'Password has been successfully updated.']);

    }
    public function adminHome(){
        $totalCompanies = Company::count();
        $totalRecruiters = Recruiter::count();
        $totalCandidates = User::count();
        return view('front.admin.home',compact('totalCompanies','totalRecruiters','totalCandidates'));
    }
    public function adminlogin(){
        return view('front.account.wadminlogin');
    }
    public function loginPost(Request $request){
        
        if(Auth::guard('webadmin')->attempt(['email' => $request -> email,'password'=> $request -> password])){
            return redirect()->intended(route('front.admin.home'));
        }
        else{
            return redirect(route('front.account.wadminlogin'))->with('error','Invalid Credentials');
        }
    }
    public function Wlogout(Request $request){
        Auth::guard('webadmin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing');
    }
    public function deleteRecruiter($id)
    {
        $recruiter = Recruiter::find($id);
        if ($recruiter) {
            $recruiter->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }

    public function suspend(Request $request, $id)
    {
        $candidate = User::find($id);
        if ($candidate) {
            $candidate->suspended = true;
            $candidate->suspend_message = $request->input('message'); // Save the suspend message
            $candidate->save();

            return redirect()->back()->with('success', 'Candidate suspended successfully.');
        }

        return redirect()->back()->with('error', 'Candidate not found.');
    }

    public function unsuspend(Request $request, $id)
    {
        $candidate = User::find($id);
        if ($candidate) {
            $candidate->suspended = false;
            $candidate->suspend_message = null; // Clear the suspend message
            $candidate->save();

            return redirect()->back()->with('success', 'Candidate unsuspended successfully.');
        }

        return redirect()->back()->with('error', 'Candidate not found.');
    }

    public function suspendRec(Request $request, $id)
    {
        $recruiter = Recruiter::find($id);
        if ($recruiter) {
            $recruiter->suspended = true;
            $recruiter->suspend_message = $request->message;
            $recruiter->save();

            return response()->json(['success' => 'Recruiter suspended successfully.']);
        }
        return response()->json(['error' => 'Recruiter not found.'], 404);
    }

    public function unsuspendRec(Request $request, $id)
    {
        $recruiter = Recruiter::find($id);
        if ($recruiter) {
            $recruiter->suspended = false;
            $recruiter->suspend_message = null;
            $recruiter->save();

            return response()->json(['success' => 'Recruiter unsuspended successfully.']);
        }
        return response()->json(['error' => 'Recruiter not found.'], 404);
    }
    
    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();
    //     return redirect('/');
    // }
}