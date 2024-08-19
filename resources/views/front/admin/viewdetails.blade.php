{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>View Company Details</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/newpost.css') }}">
</head>
<body>
    @include('front.layouts.Adheader')
    @include('front.layouts.Adsidebar')
    <div class="container1">
        <h2>Company Details</h2>
        <!-- Search Input -->
        <div class="mb-3 d-flex align-items-center">
            <input class="form-control" type="text" id="searchInput" placeholder="Search by company name" onkeyup="searchCompanies()">
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="application-table" id="companyTable">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Profile Photo</th>
                    <th>Company Name</th>
                    <th>Contact No</th>
                    <th>Email</th>
                    <th>Recruiters</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($company->image)
                            <img src="{{ asset('profile_pic2/thumb2/' . $company->image) }}" alt="Profile Photo" style="width: 50px; height: 50px;">
                        @else
                            <img src="{{ asset('assets/images/avatar7.png') }}" alt="Profile Photo" style="width: 50px; height: 50px;">
                        @endif
                    </td>
                    <td class="company-name">{{ $company->cname }}</td>
                    <td>{{ $company->mobile }}</td>
                    <td>{{ $company->email }}</td>
                    <td><a href="#" onclick="showRecruiters({{ $company->id }})">View</a></td>
                    <td>
                        <form action="{{ route('delete.company', ['id' => $company->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a class="delete-icon" type="submit" onclick="return confirm('Are you sure you want to delete this company?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal for displaying recruiters -->
<div id="recruitersModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modalTitle"></h2>
        <!-- Search Input inside Modal -->
        <div class="mb-3 d-flex align-items-center">
            <input class="form-control" type="text" id="recruiterSearchInput" placeholder="Search recruiters" onkeyup="searchRecruiters()">
        </div>
        <table class="application-table" id="recruitersTable">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Name</th>
                    <th>Contact No</th>
                    <th>Email</th>
                    <th>Actions</th> <!-- New column for delete button -->
                </tr>
            </thead>
            <tbody id="recruitersList">
                <!-- Dynamically populated with recruiter data -->
            </tbody>
        </table>
    </div>
</div>

<script>
        function showRecruiters(companyId) {
        fetch(`/companies/${companyId}/recruiters`)
            .then(response => response.json())
            .then(recruiters => {
                var modal = document.getElementById('recruitersModal');
                var modalTitle = document.getElementById('modalTitle');
                var recruitersList = document.getElementById('recruitersList');
                
                // Populate modal with recruiters data
                modalTitle.textContent = 'Recruiters';
                recruitersList.innerHTML = '';

                recruiters.forEach(function(recruiter, index) {
                    var row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${index + 1}</td>
                        <td class="recruiter-name">${recruiter.name}</td>
                        <td>${recruiter.mobile}</td>
                        <td>${recruiter.email}</td>
                        <td>
                            <a class="delete-icon" type="submit" onclick="deleteRecruiter(${recruiter.id}, ${companyId})"">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                    `;
                    recruitersList.appendChild(row);
                });

                modal.style.display = 'block';
            });
    }

    function closeModal() {
        var modal = document.getElementById('recruitersModal');
        modal.style.display = 'none';
    }

    function deleteRecruiter(recruiterId, companyId) {
        if (confirm('Are you sure you want to delete this recruiter?')) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`/recruiters/${recruiterId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => {
                if (response.ok) {
                    showRecruiters(companyId); // Refresh the list of recruiters
                } else {
                    alert('Failed to delete the recruiter');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }

    function searchCompanies() {
        var input = document.getElementById('searchInput');
        var filter = input.value.toLowerCase();
        var table = document.getElementById('companyTable');
        var tr = table.getElementsByTagName('tr');

        for (var i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
            var td = tr[i].getElementsByClassName('company-name')[0];
            if (td) {
                var textValue = td.textContent || td.innerText;
                if (textValue.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }
    }

    function searchRecruiters() {
        var input = document.getElementById('recruiterSearchInput');
        var filter = input.value.toLowerCase();
        var table = document.getElementById('recruitersTable');
        var tr = table.getElementsByTagName('tr');

        for (var i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
            var td = tr[i].getElementsByClassName('recruiter-name')[0];
            if (td) {
                var textValue = td.textContent || td.innerText;
                if (textValue.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }
    }

</script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>View Company Details</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/newpost.css') }}">

    <style>
        /* Add this to your existing CSS file */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-height: 80%;
            overflow-y: auto;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Adjust table styling for modal */
        #recruitersTable {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        #recruitersTable th, #recruitersTable td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #recruitersTable th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #f2f2f2;
        }

        #recruitersTable td {
            text-align: left;
        }

        #recruitersTable .delete-icon {
            cursor: pointer;
            color: red;
            font-size: 18px;
        }

        #recruitersTable .delete-icon:hover {
            color: darkred;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .action-buttons input[type="text"] {
            width: 150px;
        }

    </style>
</head>
<body>
    @include('front.layouts.Adheader')
    @include('front.layouts.Adsidebar')
    <div class="container1">
        <h2>Company Details</h2>
        <!-- Search Input -->
        <div class="mb-3 d-flex align-items-center">
            <input class="form-control" type="text" id="searchInput" placeholder="Search by company name" onkeyup="searchCompanies()">
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="application-table" id="companyTable">
            <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Profile Photo</th>
                    <th>Company Name</th>
                    <th>Contact No</th>
                    <th>Email</th>
                    <th>Recruiters</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($company->image)
                            <img src="{{ asset('profile_pic2/thumb2/' . $company->image) }}" alt="Profile Photo" style="width: 50px; height: 50px;">
                        @else
                            <img src="{{ asset('assets/images/avatar7.png') }}" alt="Profile Photo" style="width: 50px; height: 50px;">
                        @endif
                    </td>
                    <td class="company-name">{{ $company->cname }}</td>
                    <td>{{ $company->mobile }}</td>
                    <td>{{ $company->email }}</td>
                    <td><a href="#" onclick="showRecruiters({{ $company->id }})">View</a></td>
                    <td>
                        <form action="{{ route('delete.company', ['id' => $company->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a class="delete-icon" type="submit" onclick="return confirm('Are you sure you want to delete this company?')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

        <!-- Modal for displaying recruiters -->
        <div id="recruitersModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 id="modalTitle"></h2>
                    <button type="button" class="btn-close" onclick="closeModal()"></button>
                </div>                
                
                <!-- Search Input inside Modal -->
                <div class="mb-3 d-flex align-items-center">
                    <input class="form-control" type="text" id="recruiterSearchInput" placeholder="Search recruiters" onkeyup="searchRecruiters()">
                </div>
                <table class="application-table" id="recruitersTable">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th>Contact No</th>
                            <th>Email</th>
                            <th>Actions</th> <!-- New column for delete button and suspend/unsuspend -->
                        </tr>
                    </thead>
                    <tbody id="recruitersList">
                        <!-- Dynamically populated with recruiter data -->
                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>



<script>
    function showRecruiters(companyId) {
    fetch(`/companies/${companyId}/recruiters`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(recruiters => {
            var modal = document.getElementById('recruitersModal');
            var modalTitle = document.getElementById('modalTitle');
            var recruitersList = document.getElementById('recruitersList');

            // Populate modal with recruiters data
            modalTitle.textContent = 'Recruiters';
            recruitersList.innerHTML = '';

            recruiters.forEach(function(recruiter, index) {
                var row = document.createElement('tr');
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td class="recruiter-name">${recruiter.name}</td>
                    <td>${recruiter.mobile}</td>
                    <td>${recruiter.email}</td>
                    <td>
                        <input type="text" id="suspend_message_${recruiter.id}" value="${recruiter.suspend_message || ''}" placeholder="Enter message">
                        ${recruiter.suspended ? 
                            `<button onclick="unsuspendRecruiter(${recruiter.id}, ${companyId})" style="background: none; border: none; color: green; cursor: pointer;">
                                <i class="fas fa-user-check"></i> Unsuspend
                            </button>` : 
                            `<button onclick="suspendRecruiter(${recruiter.id}, ${companyId})" style="background: none; border: none; color: orange; cursor: pointer;">
                                <i class="fas fa-user-slash"></i> Suspend
                            </button>`
                        }
                        <a class="delete-icon" type="submit" onclick="deleteRecruiter(${recruiter.id}, ${companyId})">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                `;
                recruitersList.appendChild(row);
            });

            modal.style.display = 'block';
        })
        .catch(error => {
            console.error('Error fetching recruiters:', error);
            alert('Failed to fetch recruiters. Please try again later.');
        });
}
function closeModal() {
    var modal = document.getElementById('recruitersModal');
    modal.style.display = 'none';
}

function suspendRecruiter(recruiterId, companyId) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const message = document.getElementById(`suspend_message_${recruiterId}`).value;

    fetch(`/suspend-recruiter/${recruiterId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ message: message })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showRecruiters(companyId); // Refresh the list of recruiters
        } else {
            alert(data.error || 'Failed to suspend the recruiter');
        }
    })
    .catch(error => {
        console.error('Error suspending recruiter:', error);
        alert('Failed to suspend the recruiter. Please try again later.');
    });
}

function unsuspendRecruiter(recruiterId, companyId) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch(`/unsuspend-recruiter/${recruiterId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showRecruiters(companyId); // Refresh the list of recruiters
        } else {
            alert(data.error || 'Failed to unsuspend the recruiter');
        }
    })
    .catch(error => {
        console.error('Error unsuspending recruiter:', error);
        alert('Failed to unsuspend the recruiter. Please try again later.');
    });
}

function deleteRecruiter(recruiterId, companyId) {
    if (confirm('Are you sure you want to delete this recruiter?')) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/recruiters/${recruiterId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                showRecruiters(companyId); // Refresh the list of recruiters
            } else {
                alert(data.error || 'Failed to delete the recruiter');
            }
        })
        .catch(error => {
            console.error('Error deleting recruiter:', error);
            alert('Failed to delete the recruiter. Please try again later.');
        });
    }
}
function searchCompanies() {
        var input = document.getElementById('searchInput');
        var filter = input.value.toLowerCase();
        var table = document.getElementById('companyTable');
        var tr = table.getElementsByTagName('tr');

        for (var i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
            var td = tr[i].getElementsByClassName('company-name')[0];
            if (td) {
                var textValue = td.textContent || td.innerText;
                if (textValue.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }
    }

    function searchRecruiters() {
        var input = document.getElementById('recruiterSearchInput');
        var filter = input.value.toLowerCase();
        var table = document.getElementById('recruitersTable');
        var tr = table.getElementsByTagName('tr');

        for (var i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
            var td = tr[i].getElementsByClassName('recruiter-name')[0];
            if (td) {
                var textValue = td.textContent || td.innerText;
                if (textValue.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }
    }

// Other functions (showRecruiters, searchCompanies, searchRecruiters) remain the same


</script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
