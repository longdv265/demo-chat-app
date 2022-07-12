<?php

namespace App\Http\Controllers;

use App\Events\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function message(Request $request)
    {
        $user = Auth::user();
        event(new Message($user->id, $user->name, $request->input('message')));
        $dataInput = [
            'user_id' => $user->id,
            'message' => $request->input('message')
        ];
        \App\Models\Message::create($dataInput);
        return  [$user];
    }
}
