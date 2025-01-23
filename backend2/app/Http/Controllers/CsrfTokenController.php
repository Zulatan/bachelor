<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CsrfTokenController extends Controller
{
    public function getCsrfToken(Request $request)
    {
        // Laravel CSRF-token genereres automatisk ved at bruge session
        $token = csrf_token();
        
        return response()->json(['token' => $token]);
    }
}
