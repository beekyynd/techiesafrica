<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportingController extends Controller
{
    public function lowStock()
    {
        // products with quantity < 5 and their order count
        $products = Product::with('orderItems')
            ->where('quantity', '<', 5)
            ->get();

        return response()->json($products);
    }

    public function salesSummary(Request $r)
    {
        // total revenue & orders count of completed orders
        $totalRevenue = Order::where('status', 'completed')
            ->sum('total_amount');

        $ordersCount = Order::where('status', 'completed')->count();

        // top 3 selling products using eager loading
        $top = DB::table('order_items')
            ->select('product_id', DB::raw('SUM(quantity) as total_qty'))
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->limit(3)
            ->get();

        // eager load products in one query
        $productIds = $top->pluck('product_id');
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $top = $top->map(function ($row) use ($products) {
            $prod = $products->get($row->product_id);
            return [
                'product_id' => $row->product_id,
                'name' => $prod?->name,
                'sku' => $prod?->sku,
                'total_sold' => $row->total_qty,
            ];
        });

        return response()->json([
            'total_revenue' => $totalRevenue,
            'orders_count' => $ordersCount,
            'top_selling' => $top,
        ]);
    }
}
