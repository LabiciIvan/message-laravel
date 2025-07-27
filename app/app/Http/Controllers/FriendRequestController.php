<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FriendRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class FriendRequestController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $friendRequests = FriendRequest::where('requestor_id', $user->id)->get();
        //view.sent.friend.requests
        return view('friendRequests.index', ['friendRequests' => $friendRequests]);
    }


    public function received(): View
    {
        $friendRequests = [];

        $user = Auth::user();

        $friendRequests = FriendRequest::where('receiver_id', $user->id)->get();

        return view('friendRequests.received', ['receivedFriendRequests' => $friendRequests]);
    }

    public function create(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'friendId' => 'required|numeric|exists:users,id'
        ]);

        $user = Auth::user();

        FriendRequest::create([
            'requestor_id' => $user->id,
            'receiver_id' => $validated['friendId'],
        ]);

        Log::debug('----sending friend request, before redirect to back of search -----');

        return redirect()->route('friendRequest.index');
    }

    public function destroy(string $id): RedirectResponse
    {
        $user = Auth::user();

        FriendRequest::where('requestor_id', $user->id)->where('receiver_id', $id)->delete();

        return redirect()->back();
    }
}
