<!-- resources/views/admin/users/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table th, table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        table th { background-color: #f4f4f4; }
        .btn { padding: 8px 12px; text-decoration: none; background-color: #007bff; color: white; border-radius: 4px; }
        .btn:hover { background-color: #0056b3; }
        .btn-warning { background-color: #ffc107; color: white; }
        .btn-danger { background-color: #dc3545; color: white; }
        .btn-warning:hover, .btn-danger:hover { opacity: 0.9; }
    </style>
</head>
<body>

    <h1>Manage Users</h1>
   <div>
   <a href="{{ route('admin.users.create') }}" class="btn">Add User</a>
   </div>
<br>
<br>
    <table>
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
                <td>{{ $user->role }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <br>
    <div>
   <a href="{{ route('home') }}" class="btn">Back</a>
   </div>
</body>
</html>
