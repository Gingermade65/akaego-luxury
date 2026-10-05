<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $orders = Order::with('user')
            ->when($status, fn($query) => $query->where('status', $status))
            ->latest()
            ->paginate(15);

        return view('admin.orders.index', compact('orders', 'status'));
    }

    public function show(Order $order)
    {
        $order->load('items.product', 'user');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status'         => 'required|string|in:pending,processing,shipped,delivered,cancelled',
            'payment_status' => 'required|string|in:unpaid,paid,refunded',
        ]);

        $order->update([
            'status'         => $validated['status'],
            'payment_status' => $validated['payment_status'],
        ]);

        return redirect()->back()->with('success', 'Order #' . $order->order_number . ' updated successfully.');
    }
}