<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidates Verifications</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/verify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    @include('front.layouts.Tpheader')
    @include('front.layouts.Tpsidebar')
    <div class="container1">
        <h2>Total Applications</h2>
        <div class="filter">
            <label for="verification-filter">Filter by Verification Status:</label>
            <select id="verification-filter">
                <option value="all">All</option>
                <option value="verified">Verified</option>
                <option value="unverified">Unverified</option>
            </select>
        </div>
        <table>
            <tr>
                <th>Sr.No</th>
                <th>Requests</th>
                <th>Documents</th>
                <th>Status</th>
            </tr>
           
            {{-- @foreach ($requests as $request)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $request->request }}</td>
                <td>{{ $request->documents }}</td>
                <td>
                    @if ($request->status == 'verified')
                        <i class="fas fa-check-circle" style="color:green"></i>
                    @else
                        <i class="fas fa-times-circle" style="color:red"></i>
                    @endif
                </td>
            </tr>
            @endforeach --}}
            
        </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const filterDropdown = document.getElementById('verification-filter');
        const rows = document.querySelectorAll('table tbody tr');

        filterDropdown.addEventListener('change', function () {
            const selectedValue = this.value;

            rows.forEach(row => {
                const statusCell = row.querySelector('td:nth-child(4)');
                const status = statusCell.textContent.trim();

                if (selectedValue === 'all' || status === selectedValue) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>

</body>
</html>
