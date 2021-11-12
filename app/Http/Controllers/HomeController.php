<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function my_order()
    {
        $userOrders = Order::query()
            ->where('user_id', '=', auth()->user()->id)
            ->with('product', 'product.store')->orderByDesc('created_at')
            ->get();
        return view('my-order', compact('userOrders'));
    }
}
