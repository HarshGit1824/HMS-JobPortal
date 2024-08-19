{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Candidates</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
</head>
<body>
    @include('front.layouts.Adheader')
    @include('front.layouts.Adsidebar')
    <div class="container1">
        <h2>View Candidates</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!-- Search Input -->
    <div class="mb-3 d-flex align-items-center">
        <input class="form-control" type="text" id="searchInput" placeholder="Search by name or email" onkeyup="searchCandidates()">
    </div>
        <table class="application-table" id="candidatesTable">
            <thead>
                <tr>
                    <th>SR.No</th>
                    <th>Profile Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Designation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($candidates as $candidate)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($candidate->image)
                        <img src="{{ asset('profile_pic/thumb/' . $candidate->image) }}" alt="Profile Photo" style="width: 50px; height: 50px;">
                        @else
                            Not set
                        @endif
                    </td>
                    <td>{{ $candidate->name }}</td>
                    <td>{{ $candidate->email }}</td>
                    <td>{{ $candidate->mobile }}</td>
                    <td>
                        @if($candidate->designation)
                          {{ $candidate->designation}}
                        @else
                            Not set
                        @endif 
                    </td>
                    <td>
                        <form action="{{ route('delete.candidate', ['id' => $candidate->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this candidate?')" style="background: none; border: none; color: red; cursor: pointer;">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function searchCandidates() {
            // Get the search input value
            var input = document.getElementById('searchInput');
            var filter = input.value.toLowerCase();
            var table = document.getElementById('candidatesTable');
            var tr = table.getElementsByTagName('tr');

            // Loop through all table rows, except for the header
            for (var i = 1; i < tr.length; i++) {
                var tdName = tr[i].getElementsByTagName('td')[2];
                var tdEmail = tr[i].getElementsByTagName('td')[3];
                if (tdName || tdEmail) {
                    var nameValue = tdName.textContent || tdName.innerText;
                    var emailValue = tdEmail.textContent || tdEmail.innerText;
                    if (nameValue.toLowerCase().indexOf(filter) > -1 || emailValue.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = '';
                    } else {
                        tr[i].style.display = 'none';
                    }
                }
            }
        }
    </script>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Candidates</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
</head>
<body>
    @include('front.layouts.Adheader')
    @include('front.layouts.Adsidebar')
    <div class="container1">
        <h2>View Candidates</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <!-- Search Input -->
        <div class="mb-3 d-flex align-items-center">
            <input class="form-control" type="text" id="searchInput" placeholder="Search by name or email" onkeyup="searchCandidates()">
        </div>
        <table class="application-table" id="candidatesTable">
            <thead>
                <tr>
                    <th>SR.No</th>
                    <th>Profile Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Designation</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($candidates as $candidate)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($candidate->image)
                        <img src="{{ asset('profile_pic/thumb/' . $candidate->image) }}" alt="Profile Photo" style="width: 50px; height: 50px;">
                        @else
                            Not set
                        @endif
                    </td>
                    <td>{{ $candidate->name }}</td>
                    <td>{{ $candidate->email }}</td>
                    <td>{{ $candidate->mobile }}</td>
                    <td>
                        @if($candidate->designation)
                          {{ $candidate->designation }}
                        @else
                            Not set
                        @endif 
                    </td>
                    <td>
                        <input type="text" id="suspend_message_{{ $candidate->id }}" value="{{ $candidate->suspend_message }}" placeholder="Enter message">
                    </td>
                    <td>
                        @if($candidate->suspended)
                        <form action="{{ route('unsuspend.candidate', ['id' => $candidate->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" onclick="return confirm('Are you sure you want to unsuspend this candidate?')" style="background: none; border: none; color: green; cursor: pointer;">
                                <i class="fas fa-user-check"></i> Unsuspend
                            </button>
                        </form>
                        @else
                        <form action="{{ route('suspend.candidate', ['id' => $candidate->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="message" id="message_{{ $candidate->id }}" value="">
                            <button type="submit" onclick="return confirm('Are you sure you want to suspend this candidate?')" style="background: none; border: none; color: orange; cursor: pointer;">
                                <i class="fas fa-user-slash"></i> Suspend
                            </button>
                        </form>
                        @endif
                        <form action="{{ route('delete.candidate', ['id' => $candidate->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this candidate?')" style="background: none; border: none; color: red; cursor: pointer;">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function searchCandidates() {
            // Get the search input value
            var input = document.getElementById('searchInput');
            var filter = input.value.toLowerCase();
            var table = document.getElementById('candidatesTable');
            var tr = table.getElementsByTagName('tr');

            // Loop through all table rows, except for the header
            for (var i = 1; i < tr.length; i++) {
                var tdName = tr[i].getElementsByTagName('td')[2];
                var tdEmail = tr[i].getElementsByTagName('td')[3];
                if (tdName || tdEmail) {
                    var nameValue = tdName.textContent || tdName.innerText;
                    var emailValue = tdEmail.textContent || tdEmail.innerText;
                    if (nameValue.toLowerCase().indexOf(filter) > -1 || emailValue.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = '';
                    } else {
                        tr[i].style.display = 'none';
                    }
                }
            }
        }

        // Attach event listeners to each suspend button to update the hidden input with the message
        document.querySelectorAll('form[action*="suspend-candidate"]').forEach(form => {
            form.addEventListener('submit', function (event) {
                const candidateId = form.getAttribute('action').split('/').pop();
                const message = document.getElementById(`suspend_message_${candidateId}`).value;
                document.getElementById(`message_${candidateId}`).value = message;
            });
        });
    </script>
</body>
</html>
