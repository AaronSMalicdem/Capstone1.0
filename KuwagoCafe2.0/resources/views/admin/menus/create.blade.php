@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Menu Item</h1>
    
    <form action="{{ route('admin.menus.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" id="price" class="form-control" required step="0.01">
        </div>
        <button type="submit" class="btn btn-primary">Add Menu Item</button>
    </form>
</div>
@endsection
