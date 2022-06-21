<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CheckoutItem;

class UserOrderController extends Controller
{
    public function index()
    {
        $orders = Checkout::where('user_id', Auth::id())->get();
        return view('user.order.index')
            ->with(compact('orders'));
    }
    public function detail($id)
    {
        $order_items = CheckoutItem::where('checkout_id', $id)->get();
        $order = Checkout::where('id', $id)->first();
        if (!empty($order)) {
            return view('user.order.detail')
                ->with(compact('order_items', 'order'));
        } else {
            abort(404);
        }
    }
    public function update(Request $request, $id)
    {
        $order = Checkout::find($id);
        if (!empty($order)) {
            $order->message = $request->message;
            $order->update();
            return response()->json(['message' => 'Cập nhật thành công']);
        } else {
            abort(404);
        }
    }
}
