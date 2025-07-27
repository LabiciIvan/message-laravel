@extends('layouts.friends')

@section('title', 'Received requests')

@section('content')
    @if($receivedFriendRequests->isNotEmpty())
        @foreach ($receivedFriendRequests as $friendRequest)
            <div>
                {{ $friendRequest->requestor->email }}
                <form method="POST" action="{{ route('friends.create') }}">
                    @csrf
                    @method('POST')
                    <button type="submit" value="{{$friendRequest->id}}" name="friendRequestId">Confirm</button>
                </form>
                <form method="POST" action="{{ route('friendRequest.delete', ['id' => $friendRequest->requestor->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Cancel</button>
                </form>
            </div>
        @endforeach
    @else
        <div>No pending requests.</div>
    @endif
@endsection