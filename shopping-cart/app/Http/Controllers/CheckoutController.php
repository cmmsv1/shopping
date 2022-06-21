<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\Checkout;
use App\Models\CheckoutItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {

        $carts = Cart::where('user_id', Auth::id())->get();
        return view('checkout')
            ->with(compact('carts'));
    }
    public function order(CheckoutRequest $request)
    {
        $checkout = new Checkout();
        $checkout->name = $request->name;
        $checkout->province = $request->province;
        $checkout->phone = $request->phone;
        $checkout->district = $request->district;
        $checkout->message = $request->message;
        $checkout->ward = $request->ward;
        $checkout->house = $request->house;
        $checkout->total = $request->total;
        $checkout->user_id = Auth::id();
        if ($request->payment_id) {
            $checkout->payment_method = $request->payment_method;
        }
        $checkout->payment_id = $request->payment_id;
        $checkout->save();
        $carts = Cart::where('user_id', Auth::id())->get();
        foreach ($carts as $cart) {
            $checkout_item = new CheckoutItem();
            $product = Product::find($cart->product_id);
            $product->sold_out = $product->sold_out + $cart->quantity;
            $product->quantity = $product->quantity - $cart->quantity;
            if ($product->quantity < 1) {
                $product->quantity = 0;
                $product->stock_status = 'outofstock';
            }
            $product->save();
            $checkout_item->checkout_id = $checkout->id;
            $checkout_item->product_id = $cart->product_id;
            $checkout_item->quantity = $cart->quantity;
            $checkout_item->save();
            $cart->delete();
        }
        return response()->json([
            'message' => 'Đặt hàng thành công'
        ]);
    }
    public function checkPaypal(CheckoutRequest $request)
    {
        return response()->json([
            'message' => 'Check Paypal thành công'
        ]);
    }
}
