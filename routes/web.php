<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResumeBuilderController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\WebAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\ThirdPartyController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;

// Route::get('/', function () {
//     return view('welcome');
// });


          /* Landing page route */
Route::get('/',[WebAdminController::class, 'start']) -> name ('landing');
/* User side routes */
// Route  for user home page
Route::get('/user/home',[AccountController::class,'index'])->name('home');


// Route to redirect Resume Builder page
Route::get('/user/resume-builder',[ AccountController::class,'resume_builder'])->name('front.user.resume_builder');
// Route to fetch all notifications via a controller
Route::get('/user/notifications', [NotificationController::class, 'notify'])->name('front.user.notifications');

Route::group(['account'],function(){
        //Guest route
        // Route for User Registration page......|get|
        Route::get('/account/register', [AccountController::class,'create'])->name('account.register');
        // Route for User Registration page......|post|
        Route::post('/account/register', [AccountController::class,'store']);
        // Route  for user Login page
        Route::get('/account/login', [AccountController::class,'login'])->name('account.login');
        // Route for User Authentication Process
        Route::post('/account/authenticate', [AccountController::class,'authenticate'])->name('account.authenticate');
});

//Authenticated Routes
       // Route for User Profile 
        Route::get('/user/profile', [AccountController::class,'profile'])->name('user.profile');
        Route::post('/update-password', [AccountController::class, 'updatePassword'])->name('account.updatePassword');
       // Route for User's Update Profile
        Route::put('/user/update-profile', [AccountController::class,'updateProfile'])->name('user.updateProfile');
        Route::post('/user/update-profile-pic',[AccountController::class, 'updateProfilePic'])->name('user.updateProfilePic');
        // Route to redirect back to login page  
        Route::get('/account/logout', [AccountController::class,'logout'])->name('account.logout');
        // Route::post('/update/summary', [AccountController::class, 'updateSummary'])->name('update.summary');
        Route::post('/update/experience', [AccountController::class, 'updateExperience'])->name('update.experience');
        // Route::post('/update/education', [AccountController::class, 'updateEducation'])->name('update.education');

        Route::post('/update/education', [AccountController::class, 'updateEducation'])->name('update.education');
        Route::post('/update/certification', [AccountController::class, 'updateCertification'])->name('update.certification');
        Route::post('/update/honorsndawards', [AccountController::class, 'updateHonorsNdAwards'])->name('update.honorsndawards');
        Route::post('/projects', [AccountController::class, 'updateProject'])->name('update.projects');
        Route::get('/post/{id}',[AccountController::class,'details'])->name('front.user.details');
        Route::post('/submit-application', [AccountController::class, 'submitApplication'])->name('submit.application');

        Route::get('/applied-jobs', [AccountController::class, 'appliedJobs'])->name('front.user.appliedjobs');
        Route::post('/upload-documents', [AccountController::class,'upload'])->name('upload.documents');

        Route::get('/jobs/category/{category}', [AccountController::class, 'showByCategory'])->name('front.job_search_results');





  
        /* Recruiter side routes */
// Route  for Recruiter Login page       
Route::get('/account/recruiterlogin', [RecruiterController::class, 'recruiterlogin'])->name('account.recruiterlogin');
// Route  for Recruiter home page
Route::get('/recruiter/home', [RecruiterController::class, 'recruiterHome'])->name('front.recruiter.home');

// Route  for Recruiter login
Route::post('/recruiter/login', [RecruiterController::class, 'loginPost'])->name('rlogin.post');
//Route for recruiter logout
Route::get('/recruiter/logout', [RecruiterController::class, 'Rlogout'])->name('rlogout');
//Route for recruiter view applications
Route::get('/applications', [RecruiterController::class,'index'])->name('front.recruiter.application');
// Route  for Recruiter JobPost page.....|get|
Route::get('/jobpost/create', [RecruiterController::class, 'showJobPosts'])->name('front.recruiter.jobpost');
// Route  for Recruiter JobPost page.....|Post|
Route::post('/jobpost/store', [RecruiterController::class, 'store'])->name('jobpost.store');
// Route  for Recruiter Verify Candidates page
Route::get('/verify', [RecruiterController::class, 'verify'])->name('front.recruiter.verify');
// Route  for Recruiter Forgot Password page
Route::get('/recruiter-forgotpass',[RecruiterController::class,'forgotPasswordForm'])->name('front.recruiter.forgotpass');
Route::post('/recruiter/forgotpass/',[RecruiterController::class,'RforgotPass'])->name('recruiter.forgotpass');
// Route  for Recruiter Notification page
Route::get('/recruiter/notifications', [RecruiterController::class, 'Notify'])->name('front.recruiter.notification');
//Route for Recruiter Create category
Route::get('/recruiter/categories/create', [RecruiterController::class, 'createCategory'])->name('front.recruiter.category');
//Route for Store Category in database
Route::post('/recruiter/categories', [RecruiterController::class, 'storeCategory'])->name('categories.store');

// Route::get('/job-post/{id}/edit', [RecruiterController::class, 'edit'])->name('jobpost.edit');
// Route::put('/job-post/{id}', [RecruiterController::class, 'update'])->name('jobpost.update');
// Route::delete('/job-post/{id}', [RecruiterController::class, 'destroy'])->name('jobpost.destroy');
Route::get('/jobpost/{id}/edit',[RecruiterController::class,'edit']);
Route::put('/jobpost/{id}',[RecruiterController::class,'update']);
Route::delete('/jobpost/{id}',[RecruiterController::class,'destroy']);

Route::post('/send-message', [RecruiterController::class,'send'])->name('send.message');
Route::post('/update-status', [RecruiterController::class,'updateStatus'])->name('update.application');
Route::post('/update-round-status', [RecruiterController::class, 'updateRoundStatus'])->name('update.round.status');
Route::delete('/delete-application', [RecruiterController::class, 'deleteApplication'])->name('delete.application');
Route::post('/rounds/store', [RecruiterController::class, 'storeRound'])->name('rounds.store');

Route::delete('/categories/{id}', [RecruiterController::class, 'destroyCategory'])->name('categories.destroy');
Route::delete('/rounds/{id}', [RecruiterController::class, 'destroyRound'])->name('rounds.destroy');

// routes/web.php
Route::post('/send-for-verification/{id}', [RecruiterController::class, 'sendForVerification'])->name('sendForVerification');


Route::get('/application-list/{id}', [RecruiterController::class, 'applicationList'])->name('application.list');







 /* WebSiteAdmin side routes */
// Route  for WebAdmin home page
Route::get('/wadmin/home', [WebAdminController::class, 'adminHome'])->name('front.admin.home');
// Route  for WebAdmin Login page
Route::get('/webadmin/login', [WebAdminController::class, 'adminlogin'])->name('front.account.wadminlogin');
//Route for Webadmin Login
Route::post('/webadmin/login', [WebAdminController::class, 'loginPost'])->name('wlogin.post');
//Route for Webadmin logout
Route::get('/webadmin/logout', [WebAdminController::class, 'Wlogout'])->name('wlogout');
// Route  for WebAdmin Company Details page
Route::get('/admin/details', [WebAdminController::class, 'details'])->name('front.admin.viewdetails');
// Route  for WebAdmin ViewCandidates page
Route::get('/admin/viewcandidates',[WebAdminController::class, 'candidate'])->name('front.admin.viewcandidates');
Route::delete('/delete-candidate/{id}', [WebAdminController::class, 'deleteCandidate'])->name('delete.candidate');

// Route  for WebAdmin Forgot Password page
Route::get('/admin/forgotpass',[WebAdminController::class,'forgot'])->name('front.admin.forgot');
Route::post('/webadmin/forgotpass',[WebAdminController::class,'wforgotPass'])->name('webadmin.forgot');
// Route  for WebAdmin To Delete Company 
Route::get('/delete-company'/*/{companyId}*/, [WebAdminController::class, 'deleteCompany'])->name('delete.company');
// Route  for WebAdmin To View Recruiters 
Route::get('/view-recruiters'/*/{companyId}*/, [WebAdminController::class, 'viewRecruiters'])->name('view.recruiters');
//Route for Webadmin for full details of company and recruiters
Route::get('/companies/{id}/recruiters', [WebAdminController::class, 'showRecruiters'])->name('companies.recruiters');
// Route::delete('/companies/{id}', [WebAdminController::class, 'destroy'])->name('delete.company');
Route::delete('/recruiters/{id}', [WebAdminController::class, 'deleteRecruiter'])->name('recruiters.destroy');

Route::post('/suspend-candidate/{id}', [WebAdminController::class, 'suspend'])->name('suspend.candidate');
Route::post('/unsuspend-candidate/{id}', [WebAdminController::class, 'unsuspend'])->name('unsuspend.candidate');

Route::post('/suspend-recruiter/{id}', [WebAdminController::class, 'suspendRec'])->name('suspend.recruiter');
Route::post('/unsuspend-recruiter/{id}', [WebAdminController::class, 'unsuspendRec'])->name('unsuspend.recruiter');





        /* Company Admin side routes */
// Route  for CompanyAdmin Home page
// Route::get('/cadmin/home', [CAdminController::class, 'CadminHome'])->name('front.cadmin.home');
// Route  for CompanyAdmin Login page
Route::get('/account/cadminlogin', [CAdminController::class, 'cadminlogin'])->name('account.cadminlogin');
// Route  for CompanyAdmin logout
Route::get('/cadmin/logout', [CAdminController::class, 'Clogout'])->name('clogout');
// Route for the CompanyAdmin profile page
Route::get('/company/profile', [CAdminController::class, 'Cprofile'])->name('cadmin.Cprofile');
// Route for User's Update Profile
Route::put('/account/update-profile', [CAdminController::class,'updateCProfile'])->name('cadmin.updateProfile');
Route::post('/account/update-profile-pic',[CAdminController::class, 'updateProfilePic'])->name('cadmin.updateProfilePic');
// Route for CompanyAdmin Authentication Process
// Route::post('/account/cauthenticate', [CAdminController::class,'cauthenticate'])->name('account.cauthenticate');
Route::post('/cadmin/login', [CAdminController::class, 'loginPost'])->name('login.post');
// Route  for CompanyAdmin To ViewCandidates page
Route::get('/cadmin/candidates',[CAdminController::class, 'candidate'])->name('front.cadmin.candidates');
// Route  for CompanyAdmin To ViewRecruiters page
Route::get('/cadmin/viewrecruiter', [CAdminController::class, 'viewRecruiters'])->name('front.cadmin.viewrecruiter');
// Route  for CompanyAdmin To Create/Add New Recruiter page
// Route::post('/cadmin/recruiter/create', [CAdminController::class, 'storeRecruiter'])->name('recruiter.store');
// Route  for CompanyAdmin To Forgot Password 
Route::get('/companyadmin/forgot-password', [CAdminController::class, 'caforgotpass'])->name('front.cadmin.forgotpass');
Route::post('/companyadmin/forgotpass',[CAdminController::class,'forgotPass'])->name('cadmin.forgotpass');
//Company Admin login /register/
Route::get('/account/cadminregister', [CAdminController::class, 'cadmincreate'])->name('account.cadminregister');
Route::post('/account/cadminregister', [CAdminController::class, 'cadminstore']);

        Route::get('/cadmin/home', [CAdminController::class, 'CadminHome'])->name('front.cadmin.home');
        Route::post('/cadmin/recruiter', [CAdminController::class, 'storeRecruiter'])->name('recruiter.store');
//Route For Edit recruiter
Route::put('recruiter/{recruiter}', [CAdminController::class, 'updateRecruiter'])->name('recruiter.update');

Route::delete('recruiter/{recruiter}', [CAdminController::class, 'destroy'])->name('recruiter.destroy');





        /* ThirdParty Admin side routes */
// Route  for ThirdParty Login page
Route::get('/account/thirdpartylogin', [ThirdPartyController::class,'thirdpartylogin'])->name('account.thirdpartylogin');
//Route for Webadmin Login
Route::post('/thirdparty/login', [ThirdPartyController::class, 'loginPost'])->name('thirdpartylogin.post');
// Route  for ThirdParty logout
Route::get('/thirdparty/logout', [ThirdPartyController::class, 'Tlogout'])->name('tlogout');
// Route  for ThirdParty Home page
Route::get('/thirdparty/home', [ThirdPartyController::class, 'ThirdHome'])->name('front.Thirdparty.home');
// Route  for ThirdParty To Show Applications page
Route::get('/thirdparty/showapplications',[ThirdPartyController::class, 'showApplications'])->name('front.Thirdparty.showapplications');
// Route  for ThirdParty To Verification page
Route::get('/thirdparty/verification', [ThirdPartyController::class, 'show'])->name('front.Thirdparty.verification');
// Route  for ThirdParty To Forgot Password page
Route::get('/thirdparty/forgot-password', [ThirdPartyController::class, 'thforgotpass'])->name('front.Thirdparty.forgotpass');
Route::post('/thirdparty/forgotpassword', [ThirdPartyController::class, 'TforgotPass'])->name('thirdparty.forgotpass');

// routes/web.php
Route::post('/verify-application/{id}', [ThirdPartyController::class, 'verifyApplication'])->name('verifyApplication');
Route::post('/unverify-application/{id}', [ThirdPartyController::class, 'unverifyApplication'])->name('unverifyApplication');
Route::delete('/applications/{id}', [ThirdPartyController::class, 'destroy'])->name('deleteApplication');


/*For Password reset, by Rushikesh Surve*/


Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::get('/user/notifications', [NotificationController::class, 'getAllNotifications'])
    ->name('front.user.notifications')
    ->middleware('auth'); // Make sure to apply authentication middleware if needed

