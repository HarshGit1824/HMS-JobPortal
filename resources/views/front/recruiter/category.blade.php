<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <style>
        /* Add some space between buttons and existing elements */
        .form-container {
            margin-bottom: 20px; /* Adjust the value as needed */
        }
    </style>
</head>
<body>
    @include('front.layouts.Rheader')
    @include('front.layouts.Rsidebar')

    <div class="container1">
        <div class="row">
            <div class="col-md-6">
                <!-- Category Form -->
                <div class="form-container">
                    <h2>Create a New Category</h2>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Create Category</button>
                    </form>
                </div>

                <!-- Existing Categories -->
                {{-- <div class="form-container">
                    <h4>Existing Categories</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i> <!-- Font Awesome trash icon -->
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> --}}
            </div>

            <div class="col-md-6">
                <!-- Round Form -->
                <div class="form-container">
                    <h2>Add a New Round</h2>
                    <form action="{{ route('rounds.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="recruiter_id" value="{{ $recruiter->id }}">
                        <div class="mb-3">
                            <label for="round_name" class="form-label">Round Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Round</button>
                    </form>
                </div>

                <!-- Existing Rounds -->
                {{-- <div class="form-container">
                    <h4>Existing Rounds</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Round Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rounds as $round)
                            <tr>
                                <td>{{ $round->name }}</td>
                                <td>
                                    <form action="{{ route('rounds.destroy', $round->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i> <!-- Font Awesome trash icon -->
                                        </button>
                                    </form>
                                </td>                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> --}}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
