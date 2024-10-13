<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // CRUD for Menu Items
    public function index() {
        $menus = Menu::all(); // List all menu items
        return view('admin.menus.index', compact('menus'));
    }

    public function create() {
        return view('admin.menus.create'); // Return form to create a new menu
    }

    public function store(Request $request) {
        // Validate and store the menu item
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        Menu::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu created successfully.');
    }

    public function edit(Menu $menu) {
        return view('admin.menus.edit', compact('menu')); // Edit a specific menu item
    }

    public function update(Request $request, Menu $menu) {
        // Validate and update the menu item
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $menu->update($request->all());

        return redirect()->route('admin.menus.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu) {
        $menu->delete(); // Delete a specific menu item
        return redirect()->route('admin.menus.index')->with('success', 'Menu deleted successfully.');
    }

    // View all Orders
    public function orders() {
        $orders = Order::all(); // Admin can view all orders
        return view('admin.orders.index', compact('orders'));
    }
}

