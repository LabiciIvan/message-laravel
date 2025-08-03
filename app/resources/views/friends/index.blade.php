@extends('layouts.friends')

@section('name', 'Friends list')

@section('friendsContent')
    <form method="POST" action="{{ route('friends.search') }}">
        @csrf
        <input name="searchName" />
        @error('searchName') {{ $message }} @enderror
        <button type="submit">Search</button>
    </form>
    <h4>Your friends list:</h4>
    @if($friends)
        @foreach ($friends as $person)
        <div>
            <a href="{{ route('view.user.show', ['id' => $person->friend->id]) }}"><h3>{{ $person->friend->name }}, {{ $person->friend->email }}</h3></a>
            <form method="POST" action="{{ route('friends.delete', ['id' => $person->friend->id]) }}">
                @csrf
                @method('DELETE')
                <button class="border p-2 bg-blue-700 curson:pointer" type="submit">Unfriend</button>
            </form>
        </div>
        @endforeach
    @else
        <h4>No friends, search for friends and add them by sending a request.</h4>
    @endif
@endsection