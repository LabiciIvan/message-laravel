@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<form action="{{ route('process.login') }}" method="post">
    @csrf
    <label for="">Email</label>
    <input type="text" placeholder="Email address" name="email" value="{{ old('email') }}">
    @error('email')<span>{{ $message }}</span> @enderror

    <label for="">Password</label>
    <input type="password" placeholder="Email address" name="password">
    @error('password')<span>{{ $message }}</span> @enderror

    <button type="submit">Login</button>
</form>
@endsection
