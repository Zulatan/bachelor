<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::all();
        return response()->json($users);
    }

    public function show($id): JsonResponse
    {
        $user = User::find($id);
        
        if (!$user) {
            return response()->json(['message' => 'Burger ikke fundet'], 404);
        }
        
        return response()->json($user);
    }
}
