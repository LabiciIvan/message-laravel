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

        return view('friendRequests.index', ['friendRequests' => $user->friendRequests]);
    }


    public function received(): View
    {
        $user = Auth::user();

        return view('friendRequests.received', ['receivedFriendRequests' => $user->receivedFriendRequests]);
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
