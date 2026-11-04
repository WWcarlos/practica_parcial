<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|unique:roles',
            'description' => 'nullable|string',
        ]);

        Role::create([
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        return redirect('/roles');
    }

    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'        => 'required|string|unique:roles,name,' . $role->id,
            'description' => 'nullable|string',
        ]);

        $role->name        = $request->name;
        $role->description = $request->description;
        $role->save();

        return redirect('/roles');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect('/roles');
    }
}
