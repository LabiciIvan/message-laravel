@extends('layouts.friends')

@section('title', 'Search Friends')


@section('content')
    <a href="{{route('friends.index')}}">X</a>
    <div>
        @if($searchResults->isNotEmpty())
            Search results:
            @foreach($searchResults as $friend)
             <div>
                {{ $friend->name }} {{$friend->email}} {{ $friend->isFriend}}

                @if($friend->isFriend)
                    <form method="POST" action="{{ route('process.unfriend', ['id' => $friend->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Unfriend</button>
                    </form>
                @elseif($friend->requestSent)
                    <form method="POST" action="{{ route('friendRequest.delete', ['id' => $friend->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Cancel Request</button>
                    </form>
                @else
                    <form method="post" action="{{ route('friendRequest.create') }}">
                        @csrf
                        @method('POST')
                        <button type="submit" value={{$friend->id}} name="friendId" >Send friend request</button>
                    </form>
                @endif
             </div>
            @endforeach
        @else
            <div>No results for this search!</div>
        @endif
    </div>

@endsection