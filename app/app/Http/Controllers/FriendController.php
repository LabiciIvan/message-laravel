<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Friend;
use App\Models\FriendRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        return view('friends.index', ['friends' => $user->friends]);
    }


    public function create(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'friendRequestId' => 'required|numeric|exists:friend_requests,id'
        ]);

        $friendRequest = FriendRequest::find($validated['friendRequestId']);

        Log::debug('--------------confirm friend request--------');

        FriendRequest::where('id', $friendRequest->id)->delete();

        $user = Auth::user();

        Friend::create([
            'user_id' => $user->id,
            'friend_id' => $friendRequest->requestor->id
        ]);

        Friend::create([
            'user_id' => $friendRequest->requestor->id,
            'friend_id' => $user->id,
        ]);

        return redirect()->route('friends.index');
    }


    /**
     * Search user results on which to send a friend request.
     */
    public function search(Request $request): RedirectResponse|View
    {
        $validated = $request->validate(['searchName' => 'required|min:3']);

        $user = Auth::user();

        $searchTerms =$validated['searchName'];

        $searchResult = User::where('name', 'LIKE', "%{$searchTerms}%")->where('id', '!=', $user->id)->get();

        foreach ($searchResult as $person) {
            $person->isFriend = Friend::where(function ($q) use ($user, $person) {
                $q->where('user_id', $user->id)->where('friend_id', $person->id);
            })->orWhere(function ($q) use ($user, $person) {
                $q->where('user_id', $person->id)->where('friend_id', $user->id);
            })->exists();

            // requestor_id - the one sending the request
            // receiver_id - the one receiving the request
            $person->requestSent = FriendRequest::where(function ($q) use ($user, $person) {
                $q->where('requestor_id', $user->id)->where('receiver_id', $person->id);
            })->exists();
        }

        return view('friends.search', ['searchResults' => $searchResult]);
    }

    public function friendRequest(Request $request): RedirectResponse
    {
        $validated = $request->validate(['friendId' => 'required|numeric|exists:user,id']);

        Log::info('Send friend request to user with id: {userId}.', ['userId' => $validated['friendId']]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $user = Auth::user();

        Log::info('Process delete for user: {id} ', ['id' => $id]);

        Friend::where(function ($query) use ($user, $id) {
            $query->where('user_id', $user->id)->where('friend_id', $id);
        })->orWhere(function ($query) use ($user, $id) {
            $query->where('friend_id', $user->id)->where('user_id', $id);
        })->delete();

        Log::info('Unfriend successful for {userId}, by removing {friendId}.', ['userId' => $user->id, 'friendId' => $id]);

        return back();

    }
}
