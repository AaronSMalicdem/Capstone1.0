@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

<div>
   <a href="{{ route('admin.users.index') }}" class="btn">Manage Users</a>
   </div>
   <style>
    .btn { padding: 8px 12px; text-decoration: none; background-color: #007bff; color: white; border-radius: 4px; }
        .btn:hover { background-color: #0056b3; }
        .btn-warning { background-color: #ffc107; color: white; }
        .btn-danger { background-color: #dc3545; color: white; }
        .btn-warning:hover, .btn-danger:hover { opacity: 0.9; }
</style>
@endsection
