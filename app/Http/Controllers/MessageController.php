<?php

namespace App\Http\Controllers;

use App\Models\KomunitasModel;
use App\Models\MessageModel;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index($id)
    {
        $komunitasID = $id;
        $namaKomunitas = KomunitasModel::where('id', $id)->pluck('nama_komunitas')->first();

        return view('user.chat.index', compact( 'komunitasID','namaKomunitas'));
    }

    public function fetchMessages($komunitasId)
    {
        $messages = MessageModel::where('komunitas_id', $komunitasId)->orderBy('created_at', 'asc')->get();
        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $message = MessageModel::create([
            'komunitas_id' => $request->komunitas_id,
            'message' => $request->message,
            'username' => $request->username,
        ]);

        return response()->json($message);
    }
}
