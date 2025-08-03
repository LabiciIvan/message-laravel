@extends('layouts.friends')

@section('name', 'Your sent friend requests')


@section('friendsContent')
    @if($friendRequests->isNotEmpty())
        @foreach ($friendRequests as $friend)
            {{-- Access the FriendRequest model relationship --}}
            {{$friend->receiver->name}}
            <form method="POST" action="{{ route('friendRequest.delete', ['id' => $friend->receiver->id]) }}">
                @csrf
                @method('DELETE')
                <button class="flex bg-blue-200" type="submit">Cancell Request</button>
            </form>
        @endforeach
    @else
        <div>No friend requests sent!</div>
    @endif
@endsection