<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Recruiter;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Application;
use Faker\Provider\da_DK\Company as Da_DKCompany;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CAdminController extends Controller
{
    
    public function CadminHome(){
        $company = Auth::guard('company')->user(); // Use the correct guard
    
        if ($company) {
            // Count the recruiters associated with the authenticated company
            $totalRecruiters = $company->recruiters->count();
            $applications = Application::whereHas('jobPost.recruiter', function ($query) use ($company) {
                $query->where('company_id', $company->id);
            })->get();
    
            // Calculate the total number of candidates
            $totalCandidates = $applications->count();

            
            return view('front.cadmin.home', compact('totalRecruiters','totalCandidates'));
        } else {
            return redirect()->route('account.cadminlogin')->with('error', 'Please login first.');
        }
    }
    public function cadminlogin()
    {
        // Implement login functionality if needed
        return view('front.account.cadminlogin');
    }
    // public function loginPost(Request $request){
        
    //     if(Auth::guard('company')->attempt(['email' => $request -> email,'password'=> $request -> password])){
    //         return redirect()->intended(route('front.cadmin.home'));
    //     }
    //     else{
    //         return redirect(route('account.cadminlogin'))->with('error','Invalid Credentials');
    //     }
    // }
    public function loginPost(Request $request)
    {
        // Attempt to authenticate the company with the email and password
        if (Auth::guard('company')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Retrieve the authenticated company object
            $company = Auth::guard('company')->user();
            
            // Check if the company object is retrieved properly
            if ($company) {
                // Store the company object in the session
                session(['company' => $company]);

                // Redirect to the intended route
                return redirect()->intended(route('front.cadmin.home'));
            } else {
                // If company is not retrieved, handle the error appropriately
                return redirect(route('account.cadminlogin'))->with('error', 'Company not found.');
            }
        } else {
            // If unsuccessful, redirect back to the login page with an error message
            return redirect(route('account.cadminlogin'))->with('error', 'Invalid Credentials');
        }
    }

    public function Clogout(Request $request){
        Auth::guard('company')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing');
    }

    // public function loginPost(Request $request)
    // {
    //     // Attempt to authenticate the company with the email and password
    //     if (Auth::guard('company')->attempt(['email' => $request->email, 'password' => $request->password])) {
    //         // Retrieve the authenticated company object
    //         $company = Auth::guard('company')->user();
    //         // Store the company object in the session
    //         session(['company' => $company]);

    //         // Redirect to the intended route
    //         return redirect()->intended(route('front.cadmin.home'));
    //     } else {
    //         // If unsuccessful, redirect back to the login page with an error message
    //         return redirect(route('account.cadminlogin'))->with('error', 'Invalid Credentials');
    //     }
    // }
    // public function cauthenticate(Request $request){
    //     $request->validate([
    //         'email' => 'required',
    //         'password' => 'required'
    //     ]);
    //     //user-> login with -> mobile and password -> user table -> mobile aand password (auth-> user )-> user id--> user_type (1/0)--> if 0(admin page) else (user page)

    //     $user = Company::where('email', $request->input('email'))->first();

    //     if (!$user || !Hash::check($request->input('password'), $user->password)) {
    //         // Authentication failed
    //         return redirect(route('login'))->with('error', 'Invalid credentials');
    //     }
    //     //dd($user);
    //     //check usertype 0 or 1
    //     if ($user->usertype == 0) {
    //         return redirect()->route('dash');
    //     } else {
    //         return redirect()->route('home');
    //     } 
    //     // $validator = Validator::make($request->all(), [
    //     //     'email' => 'required|email',
    //     //     'password'=> 'required'
    //     // ]);
        
    //     // if ($validator->passes()) {

    //     //     if(Auth::attempt(['email' => $request->email,'password'=> $request->password]))
            
    //     //     {
                
    //     //         return redirect()->route('front.cadmin.home');
    //     //     } 
    //     //     dd(1);
    //     //     // else {
    //     //     //     return redirect()->route('account.cadminlogin')->with('error','Either Email/Password is incorrect');
    //     //     // }
            

    //     // }else{
    //     //    return redirect()->route('account.cadminlogin')
    //     //    ->withErrors($validator)
    //     //    ->withInput($request->only('email'));
    //     // }

    // }
    public function cadmincreate()
    {
        return view('front.account.cadminregister');
    }

    // public function viewRecruiters()
    // {
    //     $recruiters = Recruiter::all(); // Assuming you want to fetch all recruiters
    //     return view('front.cadmin.viewrecruiter', ['recruiters' => $recruiters]);
    // }

    public function Cprofile()
    {
        $id = Auth::guard('company')->user()->id;
        $company = Company::where('id',$id)->first();

        if (is_null($company)) {
            // Redirect to login or display a message
            return redirect()->route('account.cadminlogin')->with('error', 'Please log in to view your profile.');
        }

        return view('front.cadmin.Cprofile', ['company' => $company]);
    }

    public function updateCProfile(Request $request)
    {
        $id = Auth::guard('company')->user()->id;
    
        $validator = Validator::make($request->all(), [
            'ceoname' => 'required|regex:/^[a-zA-Z\s]+$/',
            'cname' => 'required|regex:/^[a-zA-Z\s]+$/',
            'caddress' => 'required|string|max:255', // You might want to make this field nullable if it's not always required
            'email' => 'required|email|unique:companies,email,'.$id.',id', // You might want to make this field nullable if it's not always required
            'mobile' => 'required|numeric|digits:10',
            'gstn' => 'required|numeric|digits:15',
            'link' => 'required|url',
        ]);
    
        if ($validator->passes()) {
            $company = Company::find($id);
            $company->ceoname = $request->ceoname;
            $company->cname = $request->cname;
            $company->caddress = $request->caddress; 
            $company->email = $request->email;
            $company->mobile = $request->mobile; 
            $company->gstn = $request->gstn;
            $company->link = $request->link;
            $company->save();
    
            session()->flash('success', 'Profile updated successfully');
    
            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
   
    public function updateProfilePic(Request $request)
    {
        $id = Auth::guard('company')->user()->id;
        $validator = Validator::make($request->all(), [
            'image' => 'required|image'
        ]);

        if ($validator->passes()) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = $id . '-' . time() . '.' . $ext;
            $image->move(public_path('/profile_pic2/'), $imageName);

            // Create a small thumbnail
            $sourcePath = public_path('/profile_pic2/' . $imageName);
            $thumbnailPath = public_path('/profile_pic2/thumb2/' . $imageName);
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($sourcePath);

            // Crop the best fitting 5:3 (600x360) ratio and resize to 150x150 pixel
            $image->cover(150, 150);

            // Save the thumbnail
            $image->save($thumbnailPath);

            // Delete old profile pic
            File::delete(public_path('/profile_pic2/thumb2/'.Auth::guard('company')->user()->image));
            File::delete(public_path('/profile_pic2/'.Auth::guard('company')->user()->image));  

            // Update user's image field in the database
            Company::where('id', $id)->update(['image' => $imageName]);

            session()->flash('success', 'Profile picture updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'Profile picture updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    
    public function viewRecruiters()
    {
        $company = Auth::guard('company')->user();
        if ($company) {
            $recruiters = Recruiter::where('company_id', $company->id)->get();
            return view('front.cadmin.viewrecruiter', compact('recruiters'));
        } else {
            return redirect()->route('account.cadminlogin')->with('error', 'Please log in to view recruiters.');
        }
    }
    public function updateRecruiter(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'department' => 'required|regex:/^[a-zA-Z\s]+$/',
            'mobile' => 'required|string|max:10',
            'email' => 'required|string|email|max:255|unique:recruiters,email,' . $id,
            'password' => 'nullable|string|min:8'
        ]);

        $recruiter = Recruiter::findOrFail($id);
        $recruiter->name = $request->name;
        $recruiter->department = $request->department;
        $recruiter->mobile = $request->mobile;
        $recruiter->email = $request->email;

        if ($request->password) {
            $recruiter->password = bcrypt($request->password);
        }

        $recruiter->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Recruiter updated successfully.'
        ]);
    }

    public function destroy($id)
    {
        $recruiter = Recruiter::findOrFail($id);
        $recruiter->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Recruiter deleted successfully.'
        ]);
    }

    public function storeRecruiter(Request $request)
    {
        // Retrieve the authenticated company object
        $company = Auth::guard('company')->user();
        
        // Debug to ensure company is retrieved
        // dd($request, $company);
    
        // Validate the input
        $validator = Validator::make($request->all(), [     
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'department' => 'required|regex:/^[a-zA-Z\s]+$/',
            'mobile' => 'required|numeric|digits:10', // Ensure exactly 10 digits
            'email' => 'required|email|unique:recruiters,email',
            'password' => 'required|min:5',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()->toArray(), // Convert errors to array
            ]);
        }
    
        // Ensure the company object is retrieved
        if ($company) {
            // Process successful form submission
            $recruiter = new Recruiter();
            $recruiter->name = $request->name;
            $recruiter->department = $request->department;
            $recruiter->mobile = $request->mobile;
            $recruiter->email = $request->email;
            $recruiter->password = Hash::make($request->password);
            $recruiter->company_id = $company->id; // Assign the authenticated company's ID
            $recruiter->save();
    
            session()->flash('success', 'Recruiter added successfully.');
    
            return response()->json([
                'status' => 'success',
                'message' => 'Recruiter added successfully!',
            ]);
        }  else {
            return redirect()->route('account.cadminlogin')->with('error', 'Please login first.');
            }
    }
    
    

    
    
    
    public function candidate()
    {
        $company = Auth::guard('company')->user(); // Use the correct guard
    
        if ($company) {
            // Fetch applications for job posts created by the recruiters of the logged-in company
            $applications = Application::whereHas('jobPost.recruiter', function ($query) use ($company) {
                $query->where('company_id', $company->id);
            })->get();

    
            return view('front.cadmin.candidates', ['applications' => $applications
        ]);
        } else {
            return redirect()->route('account.cadminlogin')->with('error', 'Please login first to view applications.');
        }
    }
    


    public function cadminstore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ceoname' => 'required|regex:/^[a-zA-Z\s]+$/',
            'cname' => 'required|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|unique:companies,email',
            'link' => 'required|url',
            'mobile' => 'required|numeric|digits:10', // Ensure exactly 10 digits
            'password' => 'required|min:5|same:confirmed_password',
            'confirmed_password' => 'required|min:5|same:password',
        ]);
        if ($validator->passes()) {
            // Process successful form submission

            $company = new Company();
            $company->ceoname = $request->ceoname;
            $company->cname = $request->cname;
            $company->email = $request->email;
            $company->link = $request->link;
            $company->mobile = $request->mobile;
            $company->password = Hash::make($request->password);
            $company->save();

            session()->flash('success','You have registerd successfully.');

            return response()->json([
                'status' => 'success',
                'message' => 'Registration successful!',
            ]);
        } else {        
            return response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors(),
            ]);
                
        }
    }


    public function caforgotpass()
    {
        $company = Auth::guard('company')->user();
        return view('front.cadmin.forgotpass', compact('company'));
    }
       // Handle the form submission
    public function forgotPass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:companies,email',
            'password' => 'required|string|min:8|same:confirm_password',
            'confirm_password' => 'required|string|min:8|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $company = Company::where('email', $request->email)->first();
        $company->password = Hash::make($request->password);
        $company->save();

        return response()->json(['success' => 'Password has been successfully updated.']);

    }
}
    

