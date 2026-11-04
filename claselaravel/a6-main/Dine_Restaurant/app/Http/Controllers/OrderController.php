<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PayMethod;
use App\Models\Table;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tables = Table::all();
        $users = User::all();
        $payMethods = PayMethod::all();
        return view('orders.create', compact('tables', 'users', 'payMethods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'table_id' => 'required',
            'user_id' => 'required',
            'pay_method_id' => 'nullable',
            'status' => 'required',
            'total' => 'nullable|numeric',
        ]);
        Order::create([
            'table_id' => $request->table_id,
            'user_id' => $request->user_id,
            'pay_method_id' => $request->pay_method_id,
            'status' => $request->status,
            'total' => $request->total,
        ]);
        return redirect('/orders');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $tables = Table::all();
        $users = User::all();
        $payMethods = PayMethod::all();
        return view('orders.edit', compact('order', 'tables', 'users','payMethods'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'table_id' => 'required',
            'user_id' => 'required',
            'pay_method_id' => 'nullable',
            'status' => 'required',
            'total' => 'nullable|numeric',
        ]);
        $order->update([
            'table_id' => $request->table_id,
            'user_id' => $request->user_id,
            'pay_method_id' => $request->pay_method_id,
            'status' => $request->status,
            'total' => $request->total,
        ]);
        return redirect('/orders');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect('/orders');
    }
}
