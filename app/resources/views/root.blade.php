@extends('main')

@section('main')

    Welcome, @if (Auth::check()) {{ Auth::user()->name }} .  @endif

@endsection