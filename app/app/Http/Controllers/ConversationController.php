<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|numeric|exists:users,id'
        ]);


        $user = Auth::user();
        
        $conversation = Conversation::create([
            'title' => $validated['user_id'] . ' '. $user->id
        ]);

        $conversation->users()->attach([$user->id, $validated['user_id']]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dd($id);

        $user = Auth::user();

        $conversation = Conversation::whereHas('users', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->whereHas('users', function ($q) use ($id) {
            $q->where('user_id', $id);
        })->get();

        return view('conversations.show', ['conversation' => $conversation]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conversation $conversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conversation $conversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conversation $conversation)
    {
        //
    }
}
