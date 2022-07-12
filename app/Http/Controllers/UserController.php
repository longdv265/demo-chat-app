<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Response;

class UserController extends Controller
{



    public function login(Request $request)
    {
        $user = User::Where('email', $request->email)->first();
        if (!$user || $request->password != $user->password) {
            return 'Error';
        } else {
            $token = $user->createToken('token')->plainTextToken;
            $user->token = $token;
            return Response::json($user);
        }
    }
}
