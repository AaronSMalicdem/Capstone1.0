@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pending Orders</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Menu Item</th>
                <th>Customizations</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->menu->name }}</td>
                    <td>{{ $order->customizations }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <form action="{{ route('cashier.orders.update', $order->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('POST')
                            <select name="status" onchange="this.form.submit()">
                                <option value="">Select Status</option>
                                <option value="completed">Complete</option>
                                <option value="canceled">Cancel</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
