<div class="card border-0 shadow mb-4 p-3">
    <div class="s-body text-center mt-3">
        @if(Auth::guard('company')->user()->image !='')
            <img src="{{ asset('profile_pic2/thumb2/'.Auth::guard('company')->user()->image) }}" alt="avatar"  class="rounded-circle img-fluid" style="width: 150px;">
        @else
            <img src="{{ asset('assets/images/avatar7.png') }}" alt="avatar"  class="rounded-circle img-fluid" style="width: 150px;">
        @endif       
     <h5 class="mt-3 pb-0">{{ Auth::guard('company')->user()->ceoname }}</h5>
        <p class="text-muted mb-1 fs-6">Company Name : {{ Auth::guard('company')->user()->cname }}</p>
        <p class="text-muted mb-1 fs-6">Address : {{ Auth::guard('company')->user()->caddress }}</p>
        <p class="text-muted mb-1 fs-6">Website Link : {{ Auth::guard('company')->user()->email }}</p>
        <p class="text-muted mb-1 fs-6">Contact No : {{ Auth::guard('company')->user()->mobile }}</p>
        <p class="text-muted mb-1 fs-6">GSTN No : {{ Auth::guard('company')->user()->gstn }}</p>
        <p class="text-muted mb-1 fs-6">{{ Auth::guard('company')->user()->link }}</p>
    

        <div class="d-flex justify-content-center mb-2">
            <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" class="btn btn-primary">Change Profile Picture</button>
        </div>
    </div>
</div>
<div class="card account-nav border-0 shadow mb-4 mb-lg-0">
    <div class="card-body p-0">
        <ul class="list-group list-group-flush ">
            <li class="list-group-item d-flex justify-content-between p-3" id="accountSettings">
                <a href="#">Account Settings</a>
            </li>
            <div class="card-body p-0" id="accountDropdown" style="display: none;">
                <li class="list-group-item d-flex justify-content-between p-3" id="changePasswordLink">
                    <a href="#">Change Password</a>
                </li>
            </div>
        </ul>

        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center p-3" onclick="toggleDropdown()">
                <a href="javascript:void(0);">My Jobs</a>
            </li>
        
            <div class="collapse" id="accountDropdown">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3" onclick="scrollToRecentJobPosts()">
                        <a href="javascript:void(0);">Recent Job Posts</a>
                    </li>
                </ul>
            </div>
        </ul>
    </div>
</div>
