<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'recever_id' => 'required',
            'message' => 'required'
        ]);

        $msg = Message::create([
            'sender_id' => Auth::id(),
            'recever_id' => $request->recever_id,
            'message' => $request->message
        ]);

        return response()->json($msg);
    }

    public function conversation(User $user)
    {
        $messages = Message::where(function ($q) use ($user) {
            $q->where('sender_id', auth::id())
                ->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($user) {
            $q->where('sender_id', $user->id)
                ->where('receiver_id', auth::id());
        })->get();

        return response()->json([
            'success' =>true,
            'message' =>'tout les messages affiche',
            'data' =>['messages'=>$messages]
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
