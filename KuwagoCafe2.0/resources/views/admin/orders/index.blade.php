@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Orders</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Menu Item</th>
                <th>Customizations</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->menu->name }}</td>
                    <td>{{ $order->customizations }}</td>
                    <td>{{ $order->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
