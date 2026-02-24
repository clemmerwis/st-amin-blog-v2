<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a paginated listing of orders.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $query = Order::with('post')->orderBy('created_at', 'desc');

        if ($request->query('status')) {
            $query->where('fulfillment_status', $request->query('status'));
        }

        return OrderResource::collection($query->paginate(15));
    }

    /**
     * Display a single order.
     *
     * @param  \App\Models\Order  $order
     * @return \App\Http\Resources\OrderResource
     */
    public function show(Order $order)
    {
        $order->load('post');

        return new OrderResource($order);
    }

    /**
     * Update order fields (fulfillment_status, tracking_number, notes).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \App\Http\Resources\OrderResource
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'fulfillment_status' => 'sometimes|in:unfulfilled,fulfilled',
            'tracking_number'    => 'nullable|string|max:255',
            'notes'              => 'nullable|string',
        ]);

        $order->update($request->only(['fulfillment_status', 'tracking_number', 'notes']));
        $order->load('post');

        return new OrderResource($order);
    }
}
