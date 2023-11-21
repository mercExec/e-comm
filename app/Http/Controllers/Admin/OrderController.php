<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getOrders()
    {
        return response()->json(Order::latest()->paginate(10));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $order->status = $request->orderStatus;
        $order->update();

        return response()->json('Order Status Updated');
    }
}
