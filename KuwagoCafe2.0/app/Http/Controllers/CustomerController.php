<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Feedback;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // View Menu
    public function viewMenu() {
        $menus = Menu::all(); // Show all available menu items
        return view('customer.menu.index', compact('menus'));
    }

    // Place an Order
    public function placeOrder(Request $request, Menu $menu) {
        $request->validate([
            'customizations' => 'nullable|string', // Optional customizations
        ]);

        Order::create([
            'user_id' => auth()->id(), // Authenticated user
            'menu_id' => $menu->id, // The selected menu item
            'customizations' => $request->customizations,
            'status' => 'pending',
        ]);

        // Notify Cashier about the new order (you can implement notifications here)
        return redirect()->back()->with('success', 'Order placed successfully.');
    }

    // Submit Feedback
    public function submitFeedback(Request $request) {
        $request->validate([
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5', // Rating between 1 and 5
        ]);

        Feedback::create([
            'user_id' => auth()->id(), // Authenticated user
            'message' => $request->message,
            'rating' => $request->rating,
        ]);

        return redirect()->back()->with('success', 'Feedback submitted.');
    }


    
}
