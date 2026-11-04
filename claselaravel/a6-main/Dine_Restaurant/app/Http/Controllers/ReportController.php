<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Reporte 1: Órdenes en un período con resumen de ingresos
     */
    public function orders(Request $request)
    {
        $from = $request->input('from', now()->startOfMonth()->toDateString());
        $to = $request->input('to', now()->toDateString());

        $orders = Order::with(['table', 'user', 'payMethod'])
            ->whereBetween('opened_at', [
                $from . ' 00:00:00',
                $to . ' 23:59:59',
            ])
            ->orderByDesc('opened_at')
            ->get();

        $totalRevenue = $orders->where('status', 'closed')->sum('total');
        $countByStatus = $orders->groupBy('status')->map->count();

        return view('reports.orders', compact('orders', 'from', 'to', 'totalRevenue', 'countByStatus'));
    }

    /**
     * Reporte 2: Top 20 platos más pedidos en un período
     */
    public function topDishes(Request $request)
    {
        $from = $request->input('from', now()->startOfMonth()->toDateString());
        $to = $request->input('to', now()->toDateString());

        $dishes = Dish::withCount([
            'orders as times_ordered' => function ($q) use ($from, $to) {
                $q->whereBetween('orders.opened_at', [
                    $from . ' 00:00:00',
                    $to . ' 23:59:59',
                ]);
            }
        ])
            ->with('category')
            ->orderByDesc('times_ordered')
            ->having('times_ordered', '>', 0)
            ->limit(20)
            ->get();

        // Ingresos por plato desde la tabla pivot order_dishes
        $dishRevenue = DB::table('order_dishes')
            ->join('orders', 'order_dishes.order_id', '=', 'orders.id')
            ->whereBetween('orders.opened_at', [
                $from . ' 00:00:00',
                $to . ' 23:59:59',
            ])
            ->select(
                'order_dishes.dish_id',
                DB::raw('SUM(order_dishes.quantity * order_dishes.unit_price) as revenue')
            )
            ->groupBy('order_dishes.dish_id')
            ->pluck('revenue', 'dish_id');

        return view('reports.top_dishes', compact('dishes', 'from', 'to', 'dishRevenue'));
    }
}