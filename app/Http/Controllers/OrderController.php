<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;

class OrderController extends Controller
{
    public function store(Request $r)
    {
        $r->validate([
            'items'=>'required|array|min:1',
            'items.*.product_id'=>'required|exists:products,id',
            'items.*.quantity'=>'required|integer|min:1',
        ]);

        $user = $r->user();
        $items = $r->input('items');

        return DB::transaction(function() use ($items,$user){
            // load products with lock
            $productIds = collect($items)->pluck('product_id')->unique();
            $products = Product::whereIn('id',$productIds)->lockForUpdate()->get()->keyBy('id');

            $total = 0;
            // check stock
            foreach ($items as $it) {
                $pid = $it['product_id'];
                $qty = intval($it['quantity']);
                if (!isset($products[$pid])) {
                    return response()->json(['message'=>"Product {$pid} not found"],404);
                }
                if ($products[$pid]->quantity < $qty) {
                    return response()->json(['message'=>"Insufficient stock for product {$products[$pid]->sku}"],422);
                }
                $total += $products[$pid]->price * $qty;
            }

            // Apply a 10% discount if > 500
            $discount = 0;
            if ($total > 500) {
                $discount = round($total * 0.10, 2);
                $total = $total - $discount;
            }

            $order = Order::create([
                'order_number' => 'ORD-'.Str::upper(Str::random(10)),
                'user_id' => $user->id,
                'status' => 'pending',
                'total_amount' => $total,
            ]);

            foreach ($items as $it) {
                $p = $products[$it['product_id']];
                $qty = intval($it['quantity']);
                $line_total = $p->price * $qty;
                $order->items()->create([
                    'product_id'=>$p->id,
                    'quantity'=>$qty,
                    'unit_price'=>$p->price,
                    'line_total'=>$line_total
                ]);

                // reduce stock and log transaction
                $p->decrement('quantity', $qty);
                Transaction::create([
                    'product_id'=>$p->id,
                    'change_type'=>'out',
                    'quantity_changed'=>$qty,
                    'user_id'=>$user->id,
                    'reason'=>'Order '.$order->order_number
                ]);
            }

            // mark order completed
            $order->status = 'completed';
            $order->save();

            return response()->json(['order'=>$order->load('items.product'),'discount'=>$discount],201);
        });
    }

    public function index(Request $r)
    {
        $user = $r->user();
        if ($user->role === 'admin') {
            return Order::with('items.product','user')->paginate(15);
        }
        return $user->orders()->with('items.product')->paginate(15);
    }

    public function show(Request $r, Order $order)
    {
        $user = $r->user();
        if ($user->role !== 'admin' && $order->user_id !== $user->id) {
            return response()->json(['message'=>'Forbidden'],403);
        }
        return $order->load('items.product','user');
    }
}
