@extends('layouts.friends')

@section('title', 'Your friend requests')


@section('content')
    @if($friendRequests->isNotEmpty())
        @foreach ($friendRequests as $friend)
            {{-- Access the FriendRequest model relationship --}}
            {{$friend->user->name}}
            <form method="POST" action="{{ route('friendRequest.delete', ['id' => $friend->user->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit">Cancell Request</button>
            </form>
        @endforeach
    @else
        <div>No friend requests sent!</div>
    @endif
@endsection