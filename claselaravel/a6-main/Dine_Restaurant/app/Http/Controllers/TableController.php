<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Table;

use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = Table::all();
        return view('tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $waiters=User::whereHas('role',function($query){
            $query->where('name','waiter');
        })->get();
        return view('tables.create',compact('waiters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'number'=>'required|integer',
            'capacity'=>'required|integer',
            'status'=>'required',
            'waiter_id'=>'nullable|exists:users,id'
        ]);
        Table::create([
            'number'=>$request->number,
            'capacity'=>$request->capacity,
            'status'=>$request->status,
            'waiter_id'=>$request->waiter_id
        ]);
        return redirect('/tables');
    }

    /**
     * Display the specified resource.
     */
    public function show(Table $table)
    {
        return view('tables.show',compact('table'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Table $table)
    {
        $waiters=User::whereHas('role',function($query){
            $query->where('name','waiter');
        })->get();
        return view('tables.edit',compact('table','waiters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Table $table)
    {
        $request->validate([
            'number'=>'required|integer',
            'capacity'=>'required|integer',
            'status'=>'required',
            'waiter_id'=>'nullable|exists:users,id'
        ]);
        
        $table->update([
            'number'=>$request->number,
            'capacity'=>$request->capacity,
            'status'=>$request->status,
            'waiter_id'=>$request->waiter_id
        ]);
        return redirect('/tables');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table)
    {
        $table->delete();
        return redirect('/tables');
    }
}
