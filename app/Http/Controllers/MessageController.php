<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'offer_id' => $request->offer_id
        ]);

        $ch = curl_init('http://192.168.1.105:3000/message');

        $data = json_encode([
            'message' => $message->message,
            'sender_id' => Auth::id(),
            'receiver_id' => $message->receiver_id,
            'offer_id' => $message->offer_id
        ]);

        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            ],
            CURLOPT_RETURNTRANSFER => true,
        ]);

        curl_exec($ch);

        return response()->json($message, 201);
    }

    public function getMessages($userId, $offer_id)
    {
        $messages = Message::where('offer_id',$offer_id)->where(function ($q) use ($userId) {
            $q->where('sender_id', Auth::id())->where('receiver_id', $userId);
        })->orWhere(function ($q) use ($userId) {
            $q->where('sender_id', $userId)->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }
}
