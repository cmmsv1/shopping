<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use App\Models\CheckoutItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Checkout::latest()->paginate(5);
        return view('admin.orders.index')
            ->with(compact('orders'));
    }
    public function getItem(Request $request)
    {
        if ($request->ajax()) {
            $orders = Checkout::latest()->paginate(5);
            return view('admin.orders.item')
                ->with(compact('orders'))->render();
        }
    }
    public function detail($id)
    {
        $order_items = CheckoutItem::where('checkout_id', $id)->get();
        $order = Checkout::where('id', $id)->first();
        if (!empty($order)) {
            return view('admin.orders.detail')
                ->with(compact('order_items', 'order'));
        } else {
            abort(404);
        }
    }
    public function update(Request $request, $id)
    {
        $order = Checkout::find($id);
        if (!empty($order)) {
            $order->status = $request->status;
            $order->message_reason = $request->message_reason;
            $order->update();
            return response()->json(['message' => 'Cập nhật thành công']);
        } else {
            abort(404);
        }
    }
}
