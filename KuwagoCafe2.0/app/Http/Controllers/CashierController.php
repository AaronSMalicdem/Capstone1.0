<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    // View Orders
    public function orders() {
        $orders = Order::where('status', 'pending')->get(); // Only show pending orders
        return view('cashier.orders.index', compact('orders'));
    }

    // Update Order Status
    public function updateStatus(Request $request, Order $order) {
        $request->validate([
            'status' => 'required|string', // Ensure status is valid (e.g., completed)
        ]);

        $order->status = $request->status; // Update the status (e.g., completed)
        $order->save();

        return redirect()->back()->with('success', 'Order status updated.');
    }
}


