<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Document;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Application;
use App\Models\JobPost;
use App\Models\Category;
use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class AccountController extends Controller
{
    public function index()
    {
        
        // Fetch all categories ordered by name
        $categories = Category::orderBy('name', 'ASC')->get();

        

        // Fetch featured jobs
        $featuredJobs = JobPost::where('status', 1)
                        ->orderBy('created_at', 'DESC')
                        ->with('jobType')
                        ->get();

        // Fetch latest jobs
        $latestJobs = JobPost::where('status', 1)
                        ->orderBy('created_at', 'DESC')
                        ->with('jobType')
                        ->take(5)
                        ->get();

    

        return view('front.home', compact('categories', 'featuredJobs', 'latestJobs'));
    }

    public function details($id)
    {
        $job = JobPost::find($id);
            $user = Auth::user();
            return view('front.user.details', compact('job', 'user'));
    }

    public function create()
    {
        return view('front.account.registration');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z\s]+$/', // Ensure only characters
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|numeric|digits:10', // Ensure exactly 10 digits and only numeric values
            'password' => 'required|min:8|same:confirmed_password',
            'confirmed_password' => 'required|min:8|same:password',
        ]);
        if ($validator->passes()) {
            // Process successful form submission

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->password = Hash::make($request->password);
            $user->save();

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

    public function submitApplication(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'job_post_id' => 'required|exists:job_posts,id',
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'gender' => 'required|in:male,female,other',
            'contact' => 'required|string|max:15',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($validator->passes()) {
            // Handle the resume upload
            if ($request->hasFile('resume')) {
                $file = $request->file('resume');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('resumes', $filename, 'public');
            }

            // Store the application data
            $application = new Application();
            $application->job_post_id = $request->job_post_id;
            $application->user_id = $request->user_id;
            $application->name = $request->name;
            $application->email = $request->email;
            $application->gender = $request->gender;
            $application->contact = $request->contact;
            $application->resume = $filename; // Save the filename
            $application->save();

            // Redirect with success message
            session()->flash('success', 'Application submitted successfully');
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }



    public function login()
    {
        // Implement login functionality if needed
        return view('front.account.login');
    }

    public function authenticate(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if ($validator->passes()) {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($user->suspended) {
                return redirect()->route('account.login')->with('error', 'Your account is suspended by the admin.');
            }

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('home');
            } else {
                return redirect()->route('account.login')->with('error', 'Either Email/Password is incorrect');
            }
        } else {
            return redirect()->route('account.login')->with('error', 'Either Email/Password is incorrect');
        }
    } else {
        return redirect()->route('account.login')
            ->withErrors($validator)
            ->withInput($request->only('email'));
    }
}


    // public function authenticate(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //         'password'=> 'required'
    //     ]);
        
    //     if ($validator->passes()) {

    //         if(Auth::attempt(['email' => $request->email,'password'=> $request->password])){
    //             return redirect()->route('home');
    //         } else {
    //             return redirect()->route('account.login')->with('error','Either Email/Password is incorrect');
    //         }

    //     }else{
    //        return redirect()->route('account.login')
    //        ->withErrors($validator)
    //        ->withInput($request->only('email'));
    //     }

    // }
    public function profile()
    {
        $user = Auth::user();
        $id = $user->id;
        $summary = $user->summary;
        $skills = $user->skills;
        $honorsndawards = $user->honorsndawards;
        $certificates = Certification::where('user_id', $user->id)->get();
        $education = Education::where('user_id', $user->id)->get();
        $experiences = Experience::where('user_id', $user->id)->get();
        $projects = Project::where('user_id', $user->id)->get();

        return view('front.account.profile', compact('user', 'certificates', 'education', 'summary', 'skills', 'honorsndawards', 'experiences', 'projects'));
    }



    public function updateHonorsNdAwards(Request $request)
    {
        $id = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'honorsndawards' => 'required|string|max:255',
        ]);
        if ($validator->passes()) {
            // Process successful form submission

            $user = User::find($id);
            $user->updateHonorsNdAwards = $request->input('honorsndawards');
            $user->save();

            session()->flash('success', 'Honors and awards added successfully');

            return redirect()->back();
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    
    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:5|max:100',
            'email' => 'required|email|unique:users,email,' . $id . ',id',
            'mobile' => 'nullable|digits:10',
            'address'=> 'required|min:5|max:100',
            'designation' => 'nullable',
            'summary' => 'nullable|string|max:255',
            'skills' => 'nullable|string|max:255',
            'projects' => 'nullable|string',
        ]);

        if ($validator->passes()) {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->designation = $request->designation;
            $user->summary = $request->summary;
            $user->skills = $request->skills;
            $user->projects = $request->projects;
            $user->save();

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

    public function updateExperience(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required|string|max:255',
            'emp_type' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'location_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        if ($validator->passes()) {
            $user = Auth::user();
            $experience = new Experience();
            $experience->user_id = $user->id;  // Assuming you have a user_id field in the experiences table
            $experience->role = $request->role;
            $experience->emp_type = $request->emp_type;
            $experience->company = $request->company;
            $experience->location = $request->location;
            $experience->location_type = $request->location_type;
            $experience->start_date = $request->start_date;
            $experience->end_date = $request->end_date;
            $experience->description = $request->description;

            $experience->save();

            session()->flash('success', 'Experience added successfully');

            return redirect()->back();
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }


    public function updatePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:5',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return response()->json([
                'status' => false,
                'errors' => [
                    'old_password' => ['Your old password is incorrect.']
                ],
            ]);
        }

        // $user = Auth::user();
        // $user->password = Hash::make($request->new_password);
        // $user->save();

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        session()->flash('success', 'Password updated successfully.');
            return response()->json([
                'status' => true
            ]);
    }
    public function updateProfilePic(Request $request)
    {
        $id = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'image' => 'required|image'
        ]);
    
        if ($validator->passes()) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = $id . '-' . time() . '.' . $ext;
            $image->move(public_path('/profile_pic/'), $imageName);
    
            // Create a small thumbnail
            $sourcePath = public_path('/profile_pic/' . $imageName);
            $thumbnailPath = public_path('/profile_pic/thumb/' . $imageName);
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($sourcePath);
    
            // Crop the best fitting 5:3 (600x360) ratio and resize to 150x150 pixel
            $image->cover(150, 150);
    
            // Save the thumbnail
            $image->save($thumbnailPath);
    
            // Delete old profile pic
            File::delete(public_path('/profile_pic/thumb/'.Auth::user()->image));
            File::delete(public_path('/profile_pic/'.Auth::user()->image));  
    
            // Update user's image field in the database
            User::where('id', $id)->update(['image' => $imageName]);
    
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

    public function updateProject(Request $request)
    {

        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'technologies' => 'required|string',
            'description' => 'required|string',
        ]);

        // Create a new Project instance and store the data
        if ($validator->passes()) {
            $user = Auth::user();
            $project = new Project();
            $project->user_id = $user->id;  // Assuming you have a user_id field in the educations table
            $project->project_name = $request->input('project_name');
            $project->start_date = $request->input('start_date');
            $project->end_date = $request->input('end_date');
            $project->technologies = $request->input('technologies');
            $project->description = $request->input('description');
            $project->save();

            session()->flash('success', 'Project added successfully');

            return redirect()->back();
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function updateEducation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'gradepercentage' => 'nullable|string',
        ]);

        if ($validator->passes()) {
            $user = Auth::user();
            $education = new Education();
            $education->user_id = $user->id;  // Assuming you have a user_id field in the educations table
            $education->institution = $request->institution;
            $education->degree = $request->degree;
            $education->field_of_study = $request->field_of_study;
            $education->start_date = $request->start_date;
            $education->end_date = $request->end_date;
            $education->gradepercentage = $request->gradepercentage;

            $education->save();

            session()->flash('success', 'Education added successfully');

            return redirect()->back();
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function updateCertification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'certification_name' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'date_obtained' => 'required|date',
            'document' => 'required|file|mimes:jpg,png,jpeg|max:2048',
        ]);
    
        if ($validator->passes()) {
            $user = Auth::user();
            $certification = new Certification();
            $certification->user_id = $user->id;
            $certification->certification_name = $request->certification_name;  // Ensure this line matches your database field
            $certification->institution = $request->institution;
            $certification->date_obtained = $request->date_obtained;
    
            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/certifications', $filename);
                $certification->document = $filename;
            }
    
            $certification->save();
    
            session()->flash('success', 'Certification added successfully');
    
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
    
    


    // public function updateProfilePic(Request $request){
    //     // dd($request->all());
    //     $id = Auth::user()->id;
    //     $validator = Validator::make($request->all(),[
    //         'image'=> 'required|image'
    //     ]);
    //     if($validator->passes()){
    //         $image = $request->image;
    //         $ext = $image->getClientOriginalExtension();
    //         $imageName = $id.'-'.time().'.'.$ext;
    //         $image->move(public_path('/profile_pic/'),$imageName);

    //         //create a small thumbnail
    //         $sourcePath = public_path('/profil_pic/'.$imageName);
    //         $manager = new ImageManager(Driver::class);
    //         $image = $manager->read($sourcePath);

    //         // crop the best fitting 5:3 (600x360) ratio and resize to 600x360 pixel
    //         $image->cover(150, 150);
    //         $image->toPng()->save(public_path('/profile_pic/thumb/'.$imageName));

    //         // //deleting old profile pic
    //         File::delete(public_path('/profile_pic/thumb/'.Auth::user()->image));
    //         File::delete(public_path('/profile_pic/'.Auth::user()->image));            

    //         User::where('id',$id)->update(['image'=>$imageName]);
    //         session()->flash('success','Profile picture updated successfully');
    //         return response()->json([
    //             'status' => true,
    //              'errors' => $validator->errors()
    //          ]);
    //     }
    //     else{
    //         return response()->json([
    //            'status' => false,
    //             'errors' => $validator->errors()
    //         ]);
    //     }
    // }

    public function resume_builder(Request $request){
        
        $id = Auth::user()->id;
        

        //$user = User::find($id);

        $user = User::where('id',$id)->first();
        $summary = $user->summary;
        $skills = $user->skills;
        $honorsndawards=$user->honorsndawards;
        $certificates = Certification::where('user_id', $user->id)->get();
        $education = Education::where('user_id', $user->id)->get();
        $experiences = Experience::where('user_id', $user->id)->get();
        $projects = Project::where('user_id', $user->id)->get();


        return view ('front.user.resume_builder',compact('user','certificates','education','summary','skills','honorsndawards','experiences','projects'));

    }
    public function notifications(Request $request){

        return view ('front.user.notification');

    }

    // public function updateProfile(Request $request){

    //     $id = Auth::user()->id;

    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         // Add more validation rules for other fields if needed
    //     ]);

    //     $valicator = Validator::make($request->all(), [
    //         'name' => 'required,|min:5|max:20',
    //         'email' => 'required|email|unique:users,email,'.$id.',id'
    //     ]);

    //     if($valicator->passes()){

    //         $user = User::find($id);
    //         $user->name = $request->name;
    //         $user->email = $request->email;
    //         $user->mobie = ($request->mobile);
    //         $user->designation = $request->designation;
    //         $user->save();

    //         session()->flash('success','Profile updated Successfully');

    //         return response()->json([
    //             'status' => true,
    //             'errors' => []
    //         ]);



    //     }else{
    //         return response()->json([
    //             'status' => false,
    //             'errors' => $valicator->errors()
    //         ]);
    //     }
    // }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing');
    }

    public function appliedJobs()
{
    $applications = Application::where('user_id', Auth::id())->with('jobPost')->get();
    return view('front.user.appliedjobs', compact('applications'));
}


public function upload(Request $request)
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        'application_id' => 'required|exists:applications,id',
        'photo_id_proof' => 'required|file|mimes:pdf|max:2048', // Allow only PDF
        'address_proof' => 'required|file|mimes:pdf|max:2048',
        'degree_certificate' => 'required|file|mimes:pdf|max:2048',
        'other_document' => 'nullable|file|mimes:pdf|max:2048', // Optional other document
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Find the application for the logged-in user
    $application = Application::where('id', $request->application_id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    // Store the files and update the document paths
    if ($request->hasFile('photo_id_proof')) {
        $file = $request->file('photo_id_proof');
        $filename = time() . '_photo_id_proof_' . $file->getClientOriginalName();
        $file->storeAs('documents', $filename, 'public');
        $application->photo_id_proof = $filename;
    }

    if ($request->hasFile('address_proof')) {
        $file = $request->file('address_proof');
        $filename = time() . '_address_proof_' . $file->getClientOriginalName();
        $file->storeAs('documents', $filename, 'public');
        $application->address_proof = $filename;
    }

    if ($request->hasFile('degree_certificate')) {
        $file = $request->file('degree_certificate');
        $filename = time() . '_degree_certificate_' . $file->getClientOriginalName();
        $file->storeAs('documents', $filename, 'public');
        $application->degree_certificate = $filename;
    }

    if ($request->hasFile('other_document')) {
        $file = $request->file('other_document');
        $filename = time() . '_other_document_' . $file->getClientOriginalName();
        $file->storeAs('documents', $filename, 'public');
        $application->other_document = $filename;
    }

    // Save the updated application
    $application->save();

    // Redirect with success message
    session()->flash('success', 'Documents submitted successfully');
    return redirect()->back();
}

    
    public function showByCategory($category)
    {
        // Fetch the category
        $category = Category::where('name', $category)->firstOrFail();

        // Fetch jobs under the category
        $jobs = JobPost::where('category', $category->category)
                        ->where('status', 1)
                        ->orderBy('created_at', 'DESC')
                        ->get();

        // Pass the jobs and category to the view
        return view('front.job_search_results', compact('jobs', 'category'));
    }


    // public function upload(Request $request)
    // {
    //     // Validate the request
    //     $request->validate([
    //         'application_id' => 'required|exists:applications,id',
    //         'photo_id_proof' => 'required|file|mimes:pdf|max:2048', // Allow only PDF
    //         'address_proof' => 'required|file|mimes:pdf|max:2048',
    //         'degree_certificate' => 'required|file|mimes:pdf|max:2048',
    //         'other_document' => 'nullable|file|mimes:pdf|max:2048', // Optional other document
    //     ]);

    //     // Store uploaded documents in the database
    //     $document = new Document();
    //     $document->application_id = $request->application_id;
    //     $document->photo_id_proof = $request->file('photo_id_proof')->store('storage/documents');
    //     $document->address_proof = $request->file('address_proof')->store('storage/documents');
    //     $document->degree_certificate = $request->file('degree_certificate')->store('storage/documents');
    //     if ($request->hasFile('other_document')) {
    //         $document->other_document = $request->file('other_document')->store('storage/documents');
    //     }
    //     $document->save();

    //     // Redirect back or to a success page
    //     return redirect()->back()->with('success', 'Documents uploaded successfully.');
    // }
}