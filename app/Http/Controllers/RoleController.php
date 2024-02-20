<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function updateRole(Request $request, $id)
    {
        // dd($id);
        $validatedData = $request->validate([
            'role' => 'required|string|in:admin,viewer,superadmin',
        ]);
        $user = User::findOrFail($id);

        $user->syncRoles([]);

        $user->assignRole($validatedData['role']);

        // Remove all roles from the user
        return back()->with('message', 'Role updated successfully');
    }
    // public function updateRoleApi(Request $request, $id)
    // {
    //     $validatedData = $request->validate([
    //         'role' => 'required|string|in:admin,viewer,superadmin',
    //     ]);
    //     $user = User::findOrFail($id);

    //     $user->syncRoles([]);

    //     $user->assignRole($validatedData['role']);

    //     return response()->json([
    //         'message' => "Role updated successfully"
    //     ]);
    // }
}
