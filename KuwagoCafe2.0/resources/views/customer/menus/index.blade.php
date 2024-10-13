@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Menu</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($menus as $menu)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $menu->name }}</h5>
                        <p class="card-text">{{ $menu->description }}</p>
                        <p class="card-text">Price: ${{ $menu->price }}</p>
                        <form action="{{ route('customer.menu.order', $menu->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="customizations" class="form-label">Customizations</label>
                                <input type="text" name="customizations" id="customizations" class="form-control" placeholder="e.g. extra cheese">
                            </div>
                            <button type="submit" class="btn btn-primary">Order Now</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
