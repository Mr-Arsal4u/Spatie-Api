<?php

namespace App\Http\Controllers\Api;


use App\Models\User;
use App\Http\Middleware;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

// use App\Http\Controllers\Hash;




class AuthController extends Controller
{

    public $successStatus = 200;


    // public function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string',
    //         'email' => 'required|email:rfc,dns|unique:users',
    //         'password' => 'required',
    //         'c_password' => 'required|same:password',
    //         'role' => 'required|in:admin,customer',
    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()], 401);
    //     }
    //     if ($request->input('role') === 'superadmin') {
    //         return response()->json(['error' => 'Superadmin registration not allowed.'], 401);
    //     }
    //     $input = $request->all();
    //     $input['password'] = bcrypt($input['password']);
    //     $user = User::create($input);
    //     $user->assignRole([$request->input('role')]);
    //     // foreach ($user_permission as $permission) {
    //     //     $newUser->givePermissionTo($permission->name);
    //     //     }
    //     $success['User has registered successfully.'] = [
    //         'User Name' => $user->name,
    //         'User Email' => $user->email
    //     ];
    //     return response()->json(['success' => $success], $this->successStatus);
    // }

    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
            $request->user()->token()->revoke();
            return response()->json(['message' => 'Successfully logged out']);
        } else {
            return response()->json(['message' => 'No user found'], 401);
        }
    }


    public function details()
    {
        $user = Auth::guard('api')->user();

        if ($user) {
            $roles = $user->roles;
            $roleDetails = $roles->map(function ($role) {
                return ['Role' => $role->name,];
            });
            return response()->json([
                'success' => [
                    'name' => $user->name, 'email' => $user->email,
                    'Roles Details' => $roleDetails,
                ],
            ], $this->successStatus);
        } else {
            return response()->json(['error' => 'User is not logged in or You provide wrong token.'], 401);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            return response(['error' => $validator->errors()->all()], 422);
        }
    
        $credentials = $request->only('email', 'password');
    
        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Wrong Username or Password'], 401);
        }
    
        $user = $request->user();
        $token = $user->createToken('authToken')->accessToken;
        // $token = $user->createToken('authToken')->plainTextToken;

    
        return response()->json([
            'data' => $token,
            // 'access_token' => $token->token,
            'success' => 'User has logged in successfully.',
        ]);
    }
    
}
