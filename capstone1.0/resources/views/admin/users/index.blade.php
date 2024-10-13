@extends('layouts.app')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<style>
    .container {
        margin-top: 50px;
    }
    .btn-primary {
        background-color: #4CAF50;
        border: none;
        padding: 10px 20px;
        color: white;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #45a049;
    }
    .btn-warning {
        background-color: #f0ad4e;
        border: none;
    }
    .btn-danger {
        background-color: #d9534f;
        border: none;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }
    .pagination {
        justify-content: center;
    }
</style>

<div class="mb-4">
                <a href="{{ url('admin/dashboard') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i> <!-- Font Awesome icon -->
                </a>
            </div>
<div class="container">

    <h1 class="text-center mb-4">Manage Users</h1>
    
    <div class="mb-4">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add New User</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $users->links() }}
    </div>
</div>

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@endsection
