<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"))
                  ->orWhere('shoe_brand', 'like', "%{$search}%");
            });
        }

        if ($request->filled('service')) {
            $query->where('service_type', $request->service);
        }

        $orders = $query->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'in:on_hold,process,done,cancelled'],
            'admin_notes' => ['nullable', 'string', 'max:500'],
        ]);

        $data = ['status' => $request->status];
        
        if ($request->filled('admin_notes')) {
            $data['admin_notes'] = $request->admin_notes;
        }

        if ($request->status === 'done') {
            $data['done_at'] = now();
            $data['payment_status'] = 'paid';
        }

        $order->update($data);

        return back()->with('success', 'Status pesanan berhasil diupdate!');
    }

    public function updatePayment(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => ['required', 'in:pending,paid,failed'],
        ]);

        $order->update(['payment_status' => $request->payment_status]);
        return back()->with('success', 'Status pembayaran berhasil diupdate!');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dihapus.');
    }
}
