<div class="card border-0 shadow mb-4 p-3">
    <div class="s-body text-center mt-3">
        <img src="assets/assets/images/avatar7.png" alt="avatar"  class="rounded-circle img-fluid" style="width: 150px;">
        <h5 class="mt-3 pb-0">{{ Auth::user()->ceoname }}</h5>
        <p class="text-muted mb-1 fs-6">{{ Auth::user()->companyname }}</p>
        <p class="text-muted mb-1 fs-6">{{ Auth::user()->companyaddress }}</p>
        <p class="text-muted mb-1 fs-6">{{ Auth::user()->companyemail }}</p>
        <p class="text-muted mb-1 fs-6">{{ Auth::user()->position }}</p>
        <p class="text-muted mb-1 fs-6">{{ Auth::user()->contactno }}</p>
        <p class="text-muted mb-1 fs-6">{{ Auth::user()->gstnno }}</p>
        <p class="text-muted mb-1 fs-6">{{ Auth::user()->sociallink }}</p>

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
    
        {{-- <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center p-3" onclick="toggleDropdown()" id="myJobs">
                    <a href="#">My Jobs</a>
                </li>
                <!-- Dropdown for Recent Job Posts -->
                <div class="collapse" id="accountDropdown" style="display: none;">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3" onclick="scrollToRecentJobPosts()" id="recentjobpostsLink">
                            <a href="#">Recent Job Posts</a>
                        </li>
                    </ul>
                </div>
        </ul> --}}
        
        <ul class="list-group list-group-flush">
            <!-- "My Jobs" Item that toggles the dropdown -->
            <li class="list-group-item d-flex justify-content-between align-items-center p-3" onclick="toggleDropdown()">
                <a href="javascript:void(0);">My Jobs</a>
            </li>
        
            <!-- Dropdown for Recent Job Posts -->
            <div class="collapse" id="accountDropdown">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center p-3" onclick="scrollToRecentJobPosts()">
                        <a href="javascript:void(0);">Recent Job Posts</a>
                    </li>
                </ul>
            </div>
        </ul>
        
    
        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                <a href="{{ route('account.logout') }}">Logout</a>
        </li>                                                        
        
    </div>
</div>