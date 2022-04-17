<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;

class OrderController extends Controller
{
    public function __invoke(StoreOrderRequest $request): array
    {
        $orderProducts = collect($request->products)->mapWithKeys(function ($product) {
            return [
                $product['id'] => [
                    'price' => $product['price'],
                    'qty' => $product['qty'],
                    'line_total' => $product['qty'] * $product['price']
                ]
            ];
        });

        $order = Order::create([
            'customer_id' => $request->customer,
            'total' => $orderProducts->sum('line_total')
        ]);

        $order->products()->attach($orderProducts->toArray());

        $this->reduceStock($order->products);

        return [
            'message' => "Order #{$order->id} has been placed successfully."
        ];
    }

    private function reduceStock($orderProducts)
    {
        foreach ($orderProducts as $product) {
            foreach ($product->ingredients as $ingredient) {
                $amount = $product->pivot->qty * ($ingredient->pivot->qty / 1000);
                $ingredient->decrement('stock', $amount);
            }
        }
    }
}
