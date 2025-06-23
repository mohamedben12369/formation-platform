<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role', 'permissions')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $securiteQuestions = \App\Models\SecuriteQuestion::all();
        return view('admin.users.create', compact('roles', 'permissions', 'securiteQuestions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
            'tel' => 'nullable',
            'date_de_naissance' => 'nullable|date',
            'securite_question_id' => 'nullable|exists:securite_question,id',
            'reponse' => 'nullable',
        ]);
        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
            'tel' => $request->tel,
            'date_de_naissance' => $request->date_de_naissance,
            'securite_question_id' => $request->securite_question_id,
            'reponse' => $request->reponse,
            'is_active' => $request->has('is_active'),
        ]);
        $user->permissions()->sync($request->permissions ?? []);
        return redirect()->route('dashboard.users.index')->with('success', 'Utilisateur créé.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $securiteQuestions = \App\Models\SecuriteQuestion::all();
        return view('admin.users.edit', compact('user', 'roles', 'permissions', 'securiteQuestions'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
            'tel' => 'nullable',
            'date_de_naissance' => 'nullable|date',
            'securite_question_id' => 'nullable|exists:securite_question,id',
            'reponse' => 'nullable',
        ]);
        $user->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'tel' => $request->tel,
            'date_de_naissance' => $request->date_de_naissance,
            'securite_question_id' => $request->securite_question_id,
            'reponse' => $request->reponse,
            'is_active' => $request->has('is_active'),
        ]);
        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->password)]);
        }
        $user->permissions()->sync($request->permissions ?? []);
        return redirect()->route('dashboard.users.index')->with('success', 'Utilisateur modifié.');
    }    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('dashboard.users.index')->with('success', 'Utilisateur supprimé.');
    }
}
