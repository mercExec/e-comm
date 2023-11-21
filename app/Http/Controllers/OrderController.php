<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::where(['user_id' => $request->user()->id])->latest()->paginate(15);

        return response()->json($orders);
    }

    public function show(Order $order)
    {
        $order->load(['orderProducts.product.thumbnail']);

        return response()->json($order);
    }
}
