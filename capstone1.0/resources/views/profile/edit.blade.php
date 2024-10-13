@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h2 class="text-center mb-0">Edit Profile</h2>
                </div>
                <div class="card-body p-5">
                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Edit Profile Form -->
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">Name</label>
                            <input type="text" class="form-control form-control-lg rounded-pill shadow-sm" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control form-control-lg rounded-pill shadow-sm" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <!-- Additional fields can be added here -->

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                                Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
