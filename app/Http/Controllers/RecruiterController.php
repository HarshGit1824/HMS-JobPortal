<?php


namespace App\Http\Controllers;

use App\Models\Recruiter;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\JobPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\JobType;
use Illuminate\Support\Facades\Mail;
use App\Models\Notification;
use App\Models\Rounds;



class RecruiterController extends Controller
{
    //

    public function recruiterlogin()
    {
        return view('front.account.recruiterlogin');
    }
    public function loginPost(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Attempt to authenticate the recruiter with the provided credentials
        if (Auth::guard('recruiter')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Retrieve the authenticated recruiter object
            $recruiter = Auth::guard('recruiter')->user();

            // Store the recruiter object in the session
            session(['recruiter' => $recruiter]);

            // Redirect to the intended route
            return redirect()->intended(route('front.recruiter.home'));
        } else {
            // If authentication fails, redirect back to the login page with an error message
            return redirect(route('account.recruiterlogin'))->with('error', 'Invalid Credentials');
        }
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    public function send(Request $request)
    {
        $request->validate([
            'applicant_id' => 'required|exists:applications,id',
            'message' => 'required|string|max:255',
        ]);

        $application = Application::findOrFail($request->applicant_id);

        // Get the recruiter's email
        $recruiterEmail = Auth::guard('recruiter')->user()->email;

        // Assuming you have the applicant's email in the Application model
        $applicantEmail = $application->email;
        $messageContent = $request->message;

        // Save the notification to the database
        Notification::create([
            'recruiter_email' => $recruiterEmail,
            'applicant_email' => $applicantEmail,
            'message' => $messageContent,
        ]);

        // Send email logic here (using Mail facade, etc.)
        Mail::raw($messageContent, function($message) use ($applicantEmail) {
            $message->to($applicantEmail)
                    ->subject('Message from Our Company');
        });

        return redirect()->back()->with('success', 'Message sent successfully!');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'applicant_id' => 'required|exists:applications,id',
            'status' => 'required|string|max:255',
            'round' => 'required|string|max:255',
        ]);

        $application = Application::findOrFail($request->applicant_id);
        $application->status = $request->status;
        $application->round_status = $request->round;
        $application->save();

        return redirect()->back()->with('success', 'Application updated successfully!');
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function recruiterHome(){
    $recruiter = Auth::guard('recruiter')->user(); // Use the correct guard

    if ($recruiter) {
        // Count the job posts associated with the authenticated recruiter
        $jobPosts = JobPost::where('recruiter_id', $recruiter->id)->get();

// Calculate the total applications count
$totalApplications = 0;
foreach ($recruiter->jobPosts as $jobPost) {
    $totalApplications += $jobPost->applications->count();
}
        $totalJobPosts = $jobPosts->count();    
        return view('front.recruiter.home',compact('totalJobPosts','totalApplications'));
    } else {
        return redirect()->route('account.recruiterlogin')->with('error', 'Please login first.');
    }
}

public function index()
{
    // Get the currently authenticated recruiter
    $recruiter = Auth::guard('recruiter')->user();

    if ($recruiter) {
        // Fetch rounds created by the authenticated recruiter
        $rounds = Rounds::orderBy('name', 'ASC')->get();

        // Get all job posts created by the recruiter
        $jobPostIds = $recruiter->jobPosts->pluck('id');
        
        // Get all applications for the recruiter's job posts
        $applications = Application::whereIn('job_post_id', $jobPostIds)->get();

        foreach ($applications as $application) {
            $resumePath = public_path('storage/resumes/' . $application->resume);
            if (!file_exists($resumePath)) {
                // Handle missing file
                $application->resume = null;
            }
        }

        return view('front.recruiter.application', ['applications' => $applications, 'rounds' => $rounds]);
    } else {
        return redirect()->route('account.recruiterlogin')->with('error', 'Please login first to view applications.');
    }
}




public function create()
{
    // Logic for creating a new job post goes here
    return view('front.recruiter.jobpost'); // You need to create a view for creating job posts
}

public function showJobPosts()
{
    $categories = Category::orderBy('name', 'ASC')->get();

    $jobTypes = JobType::orderBy('name', 'ASC')->get();

    $recruiter = Auth::guard('recruiter')->user(); // Use the correct guard

    // Fetch job posts for the recruiter
    if ($recruiter) {
        $jobPosts = JobPost::where('recruiter_id', $recruiter->id)->get();
        // Get the total number of job posts
        
        return view('front.recruiter.jobpost', compact('jobPosts','categories'),
        ['jobPosts'=>$jobPosts,'jobTypes'=>$jobTypes]);
    } else {
        return redirect()->route('account.recruiterlogin')->with('error', 'Please login first.');
    }
}





public function store(Request $request)
{
    $recruiter = Auth::guard('recruiter')->user(); // Use the correct guard

    if (!$recruiter) {
        return redirect()->route('account.recruiterlogin')->with('error', 'Please login first.');
    }

    // Validate the incoming request data
    $request->validate([
        'position_name' => 'required|regex:/^[a-zA-Z\s]+$/',
        'category' => 'required',
        'job_type' => 'required',
        'vacancy' =>'required|integer',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'salary_range_from' => 'required|numeric',
        'salary_range_to' => 'required|numeric',
        'location' => 'required|regex:/^[a-zA-Z\s]+$/',
        'experience' => 'required|string', // Validate experience field
        'description' => 'nullable|string', // Validate description field, allow null
    ]);

    if ($recruiter) {
        // Create a new job post instance and save it to the database
        $jobPost = new JobPost();
        $jobPost->position_name = $request->position_name;

        // Get the category name
        $category = Category::find($request->category);
        $jobPost->category = $category ? $category->name : $request->category;

        // Get the job type name
        $jobPost->job_type =$request->job_type;

        $jobPost->vacancy = $request->vacancy;
        $jobPost->start_date = $request->start_date;
        $jobPost->end_date = $request->end_date;
        $jobPost->salary_range_from = $request->salary_range_from;
        $jobPost->salary_range_to = $request->salary_range_to;
        $jobPost->location = $request->location;
        $jobPost->experience = $request->experience; // Assign experience
        $jobPost->description = $request->description; // Assign description
        $jobPost->recruiter_id = $recruiter->id;

        $jobPost->save();

        // return redirect()->route('front.recruiter.jobpost')->with('success', 'Job post created successfully!');
        session()->flash('success', 'Job post created successfully.');

        return response()->json([
            'status' => 'success',
            'message' => 'Job Post Created successfully!',
        ]);
    } else {
        return redirect()->route('account.recruiterlogin')->with('error', 'Please login first.');
    }
}


public function update(Request $request, $id)
{
$recruiter = Auth::guard('recruiter')->user(); // Use the correct guard
if (!$recruiter) {
    return redirect()->route('account.recruiterlogin')->with('error', 'Please login first.');
}
$validator = Validator::make($request->all(), [
    'position_name' => 'required|regex:/^[a-zA-Z\s]+$/',
    'category' => 'required',
    'job_type' => 'required',
    'vacancy' => 'required|integer',
    'start_date' => 'required|date',
    'end_date' => 'required|date',
    'salary_range_from' => 'required|numeric',
    'salary_range_to' => 'required|numeric',
    'location' => 'required|regex:/^[a-zA-Z\s]+$/',
    'experience' => 'required|string', // Validate experience field
    'description' => 'nullable|string',
]);

if ($validator->fails()) {
    return response()->json([
        'status' => 'error',
        'errors' => $validator->errors()
    ]);
}
  
if ($recruiter) {
// Get the category and job type objects
$category = Category::where('id', $request->category)->first();

$jobPost = JobPost::find($id);
$jobPost->position_name = $request->position_name;
$jobPost->category = $category->name;
$jobPost->job_type = $request->job_type;
$jobPost->vacancy = $request->vacancy;
$jobPost->start_date = $request->start_date;
$jobPost->end_date = $request->end_date;
$jobPost->salary_range_from = $request->salary_range_from;
$jobPost->salary_range_to = $request->salary_range_to;
$jobPost->location = $request->location;
$jobPost->experience = $request->experience; // Assign experience
$jobPost->description = $request->description;
$jobPost->save();

// session()->flash('success', 'Job post added successfully');

return response()->json(['status' => 'success', 'message' => 'Job post updated successfully']);
}
else {
    return redirect()->route('account.recruiterlogin')->with('error', 'Please login first.');
}
}


//     public function destroy($id)
//     {
//         $jobPost = JobPost::find($id);
//         $jobPost->delete();
//         return response()->json(['status' => 'success', 'message' => 'Job post deleted successfully']);
//     }

// public function edit($id)
//     {
//         $jobPost = JobPost::find($id);
//         $categories = Category::all();
//         $jobTypes = JobType::all();
//         return view('front.editjobpost', compact('jobPost', 'categories', 'jobTypes'));
//     }
// JobPostController.php
public function edit($id) {
$jobPost = JobPost::find($id);
return response()->json($jobPost);
}

// public function update(Request $request, $id) {
//     $jobPost = JobPost::find($id);
//     $jobPost->update($request->all());
//     return response()->json(['status' => 'success', 'message' => 'Job post updated successfully']);
// }

public function destroy($id) {
JobPost::destroy($id);
return response()->json(['status' => 'success', 'message' => 'Job post deleted successfully']);
}



public function Notify(){
    $recruiter = Auth::guard('recruiter')->user(); // Use the correct guard
    if ($recruiter) {           
        $recruiter = Auth::guard('recruiter')->user();
    return view('front.recruiter.notification');
} else {
    return redirect()->route('account.recruiterlogin')->with('error', 'Please login first to view Notifications.');
    }
}

public function forgotPasswordForm()
{
    $recruiter = Auth::guard('recruiter')->user();
    return view('front.recruiter.forgotpass', compact('recruiter'));    }

    public function RforgotPass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:recruiters,email',
            'password' => 'required|string|min:8|same:confirm_password',
            'confirm_password' => 'required|string|min:8|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $recruiter = Recruiter::where('email', $request->email)->first();
        $recruiter->password = Hash::make($request->password);
        $recruiter->save();

        return response()->json(['success' => 'Password has been successfully updated.']);

    }

    public function Rlogout(Request $request){
        Auth::guard('recruiter')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing');
    }
    


// public function verify()
//     {
//         $recruiter = Auth::guard('recruiter')->user(); // Use the correct guard
//         if ($recruiter) {           
//             $recruiter = Auth::guard('recruiter')->user();
//             $applications = Application::whereIn('round_status', ['Hired', 'hire', 'Hire', 'hired'])->get();
//             return view('front.recruiter.verify', compact('applications'));
//     } else {
//         return redirect()->route('account.recruiterlogin')->with('error', 'Please login first to verify.');
//         }
//     }
public function verify()
{
    $recruiter = Auth::guard('recruiter')->user(); // Use the correct guard
    if ($recruiter) {
        // Get the job post IDs created by the logged-in recruiter
        $jobPostIds = $recruiter->jobPosts->pluck('id');

        // Fetch applications for those job posts
        $applications = Application::whereIn('round_status', ['Hired', 'hire', 'Hire', 'hired'])
                                ->whereIn('job_post_id', $jobPostIds)
                                ->get();

        return view('front.recruiter.verify', compact('applications'));
    } else {
        return redirect()->route('account.recruiterlogin')->with('error', 'Please login first to verify.');
    }
}


public function saveProfile(Request $request)
{
    $recruiter = Auth::guard('recruiter')->user(); // Use the correct guard
    if ($recruiter) {           
        $recruiter = Auth::guard('recruiter')->user();
    // Validate request
    $request->validate([
        'profilePicture' => 'required|image|max:2048', // Example validation rules, adjust as needed
        'companyName' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'contactNo' => 'required|string|max:20',
    ]);

    // Save profile information
    // ...

    // Return success response
    return response()->json(['success' =>true]);
} else {
    return redirect()->route('account.recruiterlogin')->with('error', 'Please login first to save profile.');
    }
}

public function createCategory()
{
     // Get the currently authenticated recruiter
     $recruiter = Auth::guard('recruiter')->user();

     if ($recruiter) {
         // Fetch categories added by the authenticated recruiter
         $categories = Category::where('recruiter_id', $recruiter->id)->get();

         // Fetch rounds added by the authenticated recruiter
         $rounds = Rounds::where('recruiter_id', $recruiter->id)->get();

         // Pass the categories and rounds data to the view
         return view('front.recruiter.category', compact('categories', 'rounds','recruiter'));
     } else {
         // Handle case where no recruiter is logged in
         return redirect()->route('login')->with('error', 'Please login first to view categories and rounds.');
     }
}

// Store a new category in the database
public function storeCategory(Request $request)
{
    $recruiter = Auth::guard('recruiter')->user();

    if (!$recruiter) {
        return redirect()->route('account.recruiterlogin')->with('error', 'Please login first.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    Category::create([
        'name' => $request->name,
        'recruiter_id' => $recruiter->id,
    ]);

    return redirect()->route('front.recruiter.category')->with('success', 'Category created successfully.');
}

public function updateRoundStatus(Request $request)
{
    $request->validate([
        'applicant_id' => 'required|exists:applications,id',
        'round_status' => 'required|exists:rounds,id', // Make sure the round_status is a valid round ID
    ]);

    $application = Application::findOrFail($request->applicant_id);

    // Fetch the round name based on the round ID
    $round = Rounds::findOrFail($request->round_status);

    // Update the round status with the round name
    $application->round_status = $round->name;
    $application->save();

    return redirect()->back()->with('success', 'Application updated successfully!');
}



public function deleteApplication(Request $request)
{
    $request->validate([
        'applicant_id' => 'required|exists:applications,id',
    ]);

    $application = Application::find($request->input('applicant_id'));
    $application->delete();

    return redirect()->back()->with('success', 'Application deleted successfully.');
}



public function storeRound(Request $request)
{
    $request->validate([
        'recruiter_id' => 'required|exists:recruiters,id',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    $rounds = new Rounds();
    $rounds->recruiter_id = $request->recruiter_id;
    $rounds->name = $request->name;
    $rounds->save();

    return redirect()->back()->with('success', 'Round added successfully.');
}

public function destroyCategory($id)
{
    $category = Category::findOrFail($id);
    $category->delete();
    
    return redirect()->back()->with('success', 'Category deleted successfully');
}

public function destroyRound($id)
{
    $round = Rounds::findOrFail($id);
    $round->delete();
    
    return redirect()->back()->with('success', 'Round deleted successfully');
}

public function sendForVerification($id)
{
    // Find the application by ID
    $application = Application::findOrFail($id);

    // Update the status (assuming there's a status field)
    $application->status = 'Verification';
    $application->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Application sent for verification.');
}

public function applicationList($id)
{
     // Fetch applications that need verification, adjust the query based on your logic
     $applicationsForVerification = Application::where('status', 'verification')->get();

     return view('front.thirdparty.applicationList', compact('applicationsForVerification'));
    // $application = Application::findOrFail($id);
    // $applicationsForVerification = $application->jobPost->applications; // Assuming you have a relationship defined

    // // Get all job posts created by the recruiter
    // $jobPostIds = $recruiter->jobPosts->pluck('id');
        
    // // Get all applications for the recruiter's job posts
    // $applications = Application::whereIn('job_post_id', $jobPostIds)->get();

    // foreach ($applications as $application) {
    //     $photo_id_proofPath = public_path('storage/documents/' . $application->photo_id_proof);
    //     if (!file_exists($photo_id_proofPath)) {
    //         // Handle missing file
    //         $application->photo_id_proof = null;
    //     }
    //     $address_proofPath = public_path('storage/documents/' . $application->address_proof);
    //     if (!file_exists($address_proofPath)) {
    //         // Handle missing file
    //         $application->address_proof = null;
    //     }
    //     $degree_certificatePath = public_path('storage/documents/' . $application->degree_certificate);
    //     if (!file_exists($degree_certificatePath)) {
    //         // Handle missing file
    //         $application->degree_certificate = null;
    //     }
    //     $other_documentPath = public_path('storage/documents/' . $application->other_document);
    //     if (!file_exists($other_documentPath)) {
    //         // Handle missing file
    //         $application->other_document = null;
    //     }
    // }

    // return view('front.thirdparty.applicationList', compact('applicationsForVerification'));
}




}