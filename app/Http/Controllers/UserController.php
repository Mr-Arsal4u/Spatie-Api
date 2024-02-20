<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
