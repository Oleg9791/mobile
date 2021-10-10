<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('order_Id');
//        dump(session());
        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        } else {
            $order = Order::findOrFail(1);
            session(['order_Id' => 1]);
        }
        return view('basket', compact('order'));
//        return view('basket', ['order' => $order]);
    }
//    public function basket()
//    {
//        $orderId = session('orderId');
//        if (is_null($orderId)) {
//            $order = Order::create()->id;
//        } else {
//            $order = Order::find($orderId);
//        }
//        return view('basket', compact('order'));
//    }

    public function basketPlace()
    {
        return view('order');
    }

    public function basketAdd($productId)
    {
        $orderId = session('order_Id');
        if (is_null($orderId)) {
            $order = Order::created()->id;
            session(['order_Id' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }

        $order->products()->attach($productId);
//        dump($order->products);
//        dump($order);
        return view('basket', compact('order'));

    }

}
