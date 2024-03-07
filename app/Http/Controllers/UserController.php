<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('superadmin.user', compact('users'));
    }
    public function indexApi()
    {
        $users = User::all();
        // return view('superadmin.user', compact('users'));
        return response()->json([
            'json' => $users,
            'message' => "Users Record found successfully"
        ]);
    }

    public function updateRole(Request $request, $id)
    {
        $validatedData = $request->validate([
            'role' => 'required|string|in:admin,viewer,superadmin',
        ]);
        $user = User::findOrFail($id);

        $user->syncRoles([]);

        $user->assignRole($validatedData['role']);

        // Remove all roles from the user
        return back()->with('message', 'Role updated successfully');
    }

    public function usercreate()
    {
        $roles = Role::all();
        return view('superadmin.create-user',compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,id'
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $role = Role::findById($request->input('role'));
        $user->assignRole($role);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
}
