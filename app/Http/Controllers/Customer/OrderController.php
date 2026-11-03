<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ServicePrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::where('user_id', Auth::id())->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10);
        return view('customer.orders.index', compact('orders'));
    }

    public function create()
    {
        $services = ServicePrice::where('is_active', true)->get()->keyBy('service_type');
        return view('customer.orders.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_type' => ['required', 'in:fast_clean,deep_clean,suede_treatment'],
            'shoe_quantity' => ['required', 'integer', 'min:1', 'max:10'],
            'is_pickup' => ['required', 'in:0,1'],
            'pickup_address' => ['required_if:is_pickup,1', 'nullable', 'string', 'max:500'],
            'payment_method' => ['required', 'in:cash,transfer_bca,transfer_mandiri,transfer_bni,gopay,ovo,dana,qris'],
            'notes' => ['nullable', 'string', 'max:500'],
            'shoe_brand' => ['nullable', 'string', 'max:100'],
            'shoe_color' => ['nullable', 'string', 'max:100'],
        ], [
            'service_type.required' => 'Pilih jenis layanan terlebih dahulu.',
            'shoe_quantity.required' => 'Jumlah sepatu wajib diisi.',
            'is_pickup.required' => 'Pilih metode pengambilan.',
            'pickup_address.required_if' => 'Alamat pickup wajib diisi jika memilih pickup.',
            'payment_method.required' => 'Pilih metode pembayaran.',
        ]);

        $service = ServicePrice::where('service_type', $request->service_type)->first();
        if (!$service) {
            return back()->withErrors(['service_type' => 'Layanan tidak ditemukan.']);
        }

        $servicePrice = $service->price_per_pair * $request->shoe_quantity;
        $pickupFee = $request->is_pickup ? 15000 : 0;
        $totalPrice = $servicePrice + $pickupFee;

        $estimatedDays = $service->estimated_days;
        $estimatedDoneAt = now()->addDays($estimatedDays);

        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'user_id' => Auth::id(),
            'service_type' => $request->service_type,
            'shoe_quantity' => $request->shoe_quantity,
            'is_pickup' => (bool) $request->is_pickup,
            'pickup_address' => $request->is_pickup ? $request->pickup_address : null,
            'pickup_fee' => $pickupFee,
            'service_price' => $servicePrice,
            'total_price' => $totalPrice,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'status' => 'on_hold',
            'notes' => $request->notes,
            'shoe_brand' => $request->shoe_brand,
            'shoe_color' => $request->shoe_color,
            'estimated_done_at' => $estimatedDoneAt,
        ]);

        return redirect()->route('customer.orders.show', $order)
            ->with('success', 'Pesanan berhasil dibuat! Nomor pesanan: ' . $order->order_number);
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini.');
        }
        return view('customer.orders.show', compact('order'));
    }
}
