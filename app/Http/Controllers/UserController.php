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
        if (!$user) {
            return Response::json('User not exist', 404);
        } else {
            if ($request->email == $user->email && $request->password == $user->password) {
                $token = $user->createToken('token')->plainTextToken;
                $user->token = $token;
                return Response::json($user);
            }
            else {
                return Response::json('Error', 404);
            }
        }
    }
}
