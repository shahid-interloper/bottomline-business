<?php

namespace App\Http\Controllers\Api;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function registerProcess(Request $request)
    {
        $rules = [
            'first_name' => 'nullable|string|min:3|max:15|regex:/^\S*$/u',
            'last_name' => 'nullable|string|min:3|max:15|regex:/^\S*$/u',
            'email' => 'required|string|email|max:50|unique:users',
            'username' => 'nullable|string|max:50|unique:users',
            'phone' => 'required|max:50|unique:users',
            'password' => 'required|string|min:8', 
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)],403);
        }

        $role = Role::select('id')->where('role_type', 'Customer')->first();
        $user = new User();
        $user->first_name  = $request->first_name;
        $user->last_name   = $request->last_name;
        $user->email       = $request->email;
        $user->phone       = $request->phone;
        $user->username    = $request->username;
        $user->password    = Hash::make($request->password);

        if ($user->save()) {
            $user->roles()->attach($role->id);

            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                // return $user;
                $token = $user->createToken('auth_token')->plainTextToken;
    
                $response['status'] = true;
                $response['message'] = 'User Registered Successfully!';
                $response['user'] = $user;
                $response['token'] = $token;
                return $response;
            }
        } else {
            $errors = [];
            // translate('messages.Unauthorized')
            array_push($errors, ['code' => 'reg-001', 'message' => 'Err in inserting record! please try again later']);
            return response()->json([
                'errors' => $errors
            ], 401);
        }

        
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // return $user;
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'status' => true,
                'message' => 'Login Successfull!',
                'user' => $user,
                'token' => $token,
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'The provided credentials are incorrect.',
                'user' => [],
            ]);
        }

    }
    
    public function updateProfile(Request $request){
        $rules = [
            'first_name' => 'nullable|string|min:3|max:15|regex:/^\S*$/u',
            'last_name' => 'nullable|string|min:3|max:15|regex:/^\S*$/u',
            'email' => 'required|unique:users,email,'.$request->user()->id,
            'username' => 'nullable|string|max:50|unique:users,username,'.$request->user()->id,
            'phone' => 'required|max:50|unique:users,phone,'.$request->user()->id,
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:1024'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)],403);
        }

        $user = User::find($request->user()->id);
        $user->first_name  = $request->first_name;
        $user->last_name   = $request->last_name;
        $user->email       = $request->email;
        $user->phone       = $request->phone;
        $user->username    = $request->username;
        $user->address    = $request->address;
        $user->gender    = $request->gender;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->move('assets/frontend/images/profiles/' . $request->user()->id . '/', $image->getClientOriginalName())) {
                $user->image = $image->getClientOriginalName();
            }
        }

        $user->save();
        return response()->json([
            'status' => true,
            'message' => 'Profile Updated Successfully!',
            'user' => $user,
            'token' => $request->bearerToken(),
        ]);        
    }
}
