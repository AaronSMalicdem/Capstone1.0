@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Submit Feedback</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('customer.feedback.submit') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="message" class="form-label">Feedback Message</label>
            <textarea name="message" id="message" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Rating (1-5)</label>
            <input type="number" name="rating" id="rating" class="form-control" required min="1" max="5">
        </div>
        <button type="submit" class="btn btn-primary">Submit Feedback</button>
    </form>
</div>
@endsection
