<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="sidebar">
    <ul>
        <div><li><a href="{{ route('front.recruiter.home') }}" class="button"><i class="fas fa-home"></i> Home</a></li></div>
        <li><a href="{{ route('front.recruiter.application') }}" class="button"><i class="fas fa-tasks"></i> Applications</a></li>
        <li><a href="{{ route('front.recruiter.jobpost') }}" class="button"><i class="fas fa-plus"></i> Post New Job</a></li>
        <li><a href="{{ route('front.recruiter.category') }}" class ="button"><i class="fas fa-cog"></i> Add Rounds & Category</a></li>
        <li><a href="{{ route('front.recruiter.verify') }}" class="button"><i class="fas fa-user-check"></i> Verified Candidates</a></li>
        <li><a href="{{ route('front.recruiter.forgotpass') }}" class="button"><i class="fas fa-key"></i> Forgot Password</a></li>
    </ul>
</div>
