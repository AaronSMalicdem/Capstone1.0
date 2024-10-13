<!-- resources/views/admin/users/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        form { max-width: 600px; margin: 0 auto; }
        label { display: block; margin-bottom: 5px; }
        input, select { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; }
        .btn { padding: 10px 15px; text-decoration: none; background-color: #007bff; color: white; border-radius: 4px; }
        .btn:hover { background-color: #0056b3; }
    </style>
</head>
<body>

<h1>Create New User</h1>

<!-- Display validation errors -->
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Form to create a new user -->
<form action="{{ route('admin.users.store') }}" method="POST">
    @csrf
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
    <br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
    <br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>

    <label for="password_confirmation">Confirm Password:</label>
    <input type="password" id="password_confirmation" name="password_confirmation" required>
    <br>

    <label for="role">Role:</label>
    <select id="role" name="role" required>
        <option value="admin">Admin</option>
        <option value="finance">Finance</option>
        <option value="manager_cafe">Cafe Manager</option>
        <option value="manager_merch">Merchandise Manager</option>
    </select>
    <br>

    <button type="submit">Create User</button>
</form>

</body>
</html>
