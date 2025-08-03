@extends('layouts.user')

@section('title', 'User')

@section('userContent')
    <a href="{{ route('view.conversations.show', ['user_id' => $userId]) }}">Chat</a>
    This is show for: {{$userId}}
@endsection