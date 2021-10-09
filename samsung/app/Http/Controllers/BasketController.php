<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('orderId');
//        dd($orderId);
        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }
        return view('basket',compact('order'));
    }

    public function basketPlace()
    {
        return view('order');
    }

    public function basketAdd($productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create()->id;
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }
        $order->products()->attach($productId);
//        dump($order->products);
//        dump($order);
        return view('basket', compact('order'));

    }

}
