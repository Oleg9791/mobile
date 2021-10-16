<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
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
        }
//        else {
//            $order = Order::findOrFail(1);
//            session(['order_Id' => 1]);
//        }
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

    public function basketConfirm(Request $request)
    {
        $orderId = session('order_Id');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }
        $order = Order::find($orderId);
//        $success = $order->saveOrder($request->name, $request->phone);
//        dd($request->name);
        $order->phone = $request->phone;
        $order->name = $request->name;
        $order->status = 1;
        $order->save();
        session()->forget('orderId');
        session()->flash('success','ваш заказ принят');
//        if ($success) {
//            session()->flash('success', 'Ваш заказ принят в обработку');
//        } else {
//            session()->flash('warning', 'Случилась ошибка');
//        }

        return redirect()->route('index');
    }

    public function basketPlace()
    {
        $orderId = session('order_Id');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }
        $order = Order::find($orderId);

        return view('order', compact('order'));
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
        if ($order->products->contains($productId)) {     // проверка что данный продукт уже содержится

            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot; // sql- запрос т.к. products() со скобками, иначе products относился бы к  where
            $pivotRow->count++;
            $pivotRow->update();
            //  dd($pivotRow); //  где pivot добраться до самой строки pivot
        } else {
            $order->products()->attach($productId);

        }
        $product = Product::find($productId);

        session()->flash('success', 'Добавлен товар ' . $product->name);

//        dump($order->products);
//        dump($order);

        return redirect()->route('basket');
//        return view('basket', compact('order'));

    }

    public function basketRemove($productId)
    {
        $orderId = session('order_Id');
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }
        $order = Order::find($orderId);

        if ($order->products->contains($productId)) {

            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($productId);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
        $product = Product::find($productId);

        session()->flash('warning', 'Удален товар ' . $product->name);

        return redirect()->route('basket');

    }
}
