<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

    public function role_permissions()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('superadmin.roles', compact('roles', 'permissions'));
    }

    // public function save_permissions(Request $request)
    // {
    //     // dd($request->all());
    //     try {
    //         $request->validate([
    //             'role' => 'required|exists:roles,id',
    //             'permissions' => 'array',
    //         ]);
    //         $permissions = Permission::whereIn('id', $request->input('permissions', []))->pluck('name');
         
    //         $role =  Role::findOrFail($request->input('role'));;

    //         if (!$role) {
    //             throw new \Exception('Role not found.');
    //         }

    //         $role->permissions()->detach();

    //         if (!empty($permissions)) {
    //             // dd('here');
    //             $role->syncPermissions($permissions);
    //         }

    //         return redirect()->back()->with('message', 'Permissions updated successfully.');
    //     } catch (\Exception $e) {
    //         Log::error('Error occurred while saving permissions: ' . $e->getMessage());
    //         return redirect()->back()->with('message', 'An error occurred .');
    //     }
    // }
    public function save_permissions(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'role' => 'required|exists:roles,id',
                'permissions' => 'array',
            ]);
            $permissions = Permission::whereIn('id', $request->input('permissions', []))->pluck('name');
            $role =  Role::findOrFail($request->input('role'));
            $role->syncPermissions($permissions);
           
            return redirect()->back()->with('message', 'Permissions updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error occurred while saving permissions: ' . $e->getMessage());
            return redirect()->back()->with('message', 'An error occurred');
        }
    }
}
