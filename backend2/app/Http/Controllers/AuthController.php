<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return response()->json([
            'name'      => $user->name,
            'email'     => $user->email,
            'message'   => 'Bruger oprettet'
        ], 201);
    }

    public function login(Request $request)
    {
        // return response()->json([
        //     'received_data' => $request->all(),
        //     'headers' => $request->headers->all(),
        //     'cookies' => $request->cookies->all()
        // ], 200);
        
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ]);

        $user = User::where('email',  $request->email)->first();

        if(! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => ['Username or password incorrect'],
            ]);
        }

        $user->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Bruger loggede ind succesfuldt',
            'name' => $user->name,
            'token' => $user->createToken('auth_token')->plainTextToken,
        ]);
    }

    public function logout(Request $request)
    {
        // $request->user()->currentAccessToken()->delete();
        $request->user()->tokens()->delete();

        return response()->json([
            'status'    => 'success',
            'message'   => 'User logged out successfully'
        ]);
    }
}
