<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        return view('dashboard.roles.index', compact('roles', 'permissions'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('dashboard.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'permissions' => 'array',
        ]);
        $role = Role::create($request->only(['nom']));
        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        }
        return redirect()->route('dashboard.roles.index')->with('success', 'Rôle créé avec succès.');
    }

    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::all();
        return view('dashboard.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'permissions' => 'array',
        ]);
        $role = Role::findOrFail($id);
        $role->update($request->only(['nom']));
        $role->permissions()->sync($request->permissions ?? []);
        return redirect()->route('dashboard.roles.index')->with('success', 'Rôle modifié avec succès.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->permissions()->detach();
        $role->delete();
        return redirect()->route('dashboard.roles.index')->with('success', 'Rôle supprimé avec succès.');
    }
}