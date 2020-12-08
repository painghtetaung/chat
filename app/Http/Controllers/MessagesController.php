<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function send(Request $request)
    {
        $message = Message::create([
            'from' => auth()->id(),
            'to' => $request->contact_id,
            'text' => $request->text,
        ]);

        broadcast(new NewMessage($message));

        return response()->json($message);
    }
}
