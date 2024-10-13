@extends('layouts.app')

@section('content')

<style>
        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .dashboard-container {
            margin-top: 50px;
            text-align: center;
        }
    </style>

    <div class="dashboard-container">
        <h1>Welcome to Admin Dashboard</h1>

        <!-- Button to navigate to Users Management -->
        <a href="{{ route('admin.users.index') }}" class="btn">Manage Users</a>

        <!-- Button to navigate to Expenses Report -->
        <a href="{{ route('expenses-report') }}" class="btn">View Expenses Report</a>
    </div>
@endsection
