<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $carts = Cart::where('user_id', Auth::id())->get();
        return view('cart.index')
            ->with(compact('carts'));
    }

    public function getDataCarts(Request $request)
    {
        if ($request->ajax()) {
            $carts = Cart::where('user_id', Auth::id())->get();
            return view('cart.itemCart')
                ->with(compact('carts'));
        }
    }

    public function addToCart(Request $request)
    {
        $product_id = $request->product_id;
        $product_quantity = $request->product_quantity;
        if (Auth::check()) {
            $product_check = Product::where('id', $product_id)->first();
            if ($product_check) {
                $cart_check = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
                if ($cart_check) {
                    $cart_check->quantity = $cart_check->quantity + $product_quantity;
                    $cart_check->update();
                    return response()->json([
                        'message' => 'Thêm sản phẩm thành công',
                    ]);
                } else {

                    $cart = new Cart();
                    $cart->product_id = $product_id;
                    $cart->user_id = Auth::id();
                    $cart->quantity = $product_quantity;
                    $cart->save();
                    $cart_count = count(Cart::where('user_id', Auth::id())->get());
                    return response()->json([
                        'message' => 'Thêm sản phẩm thành công',
                        'cart_count' => $cart_count
                    ]);
                }
            }
        } else {
            return response()->json([
                'message' => 'Đăng nhập để tiếp tục'
            ]);
        }
    }
    public function removeCart(Request $request)
    {
        $product_id = $request->product_id;
        $cart = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
        $cart->delete();
        $cart_count = count(Cart::where('user_id', Auth::id())->get());
        return response()->json([
            'message' => 'Xoá sản phẩm thành công',
            'cart_count' => $cart_count
        ]);
    }

    public function updateQuantity(Request $request)
    {
        $product_id = $request->product_id;
        $quantity = $request->product_quantity;
        $cart = Cart::where('product_id', $product_id)->where('user_id', Auth::id())->first();
        $cart->quantity = $quantity;
        $cart->update();
        return response()->json([
            'message' => 'Cập nhật số lượng sản phẩm thành công'
        ]);
    }
}
