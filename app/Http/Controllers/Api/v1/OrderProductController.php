<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class OrderProductController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        if (empty($request->input('user_id'))) {
            return response()->json('Unauthorized', 402);
        }
        $order = Order::query()->create([
            'order_code' => 'ORDER_#' . time(),
            'product_id' => $request->input('product')['id'],
            'user_id' => $request->input('user_id'),
            'variations' => collect($request->input('variations'))->toJson(),
            'price' => $request->input('product')['price'],
        ]);
        return response()->json($order);
    }
}
