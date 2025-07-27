@extends('layouts.auth')

@section('title', 'Register')


@section('content')
<form action="{{ route('process.register') }}" method="post">
    @csrf
    <label for="">Name</label>
    <input type="text" placeholder="Email address" name="name" value="{{ old('name') }}">
    @error('name')<span>{{ $message }}</span> @enderror

    <label for="">Email</label>
    <input type="text" placeholder="Email address" name="email" value="{{ old('email') }}">
    @error('email')<span>{{ $message }}</span> @enderror

    <label for="">Password</label>
    <input type="password" placeholder="Email address" name="password" value="{{ old('password') }}">
    @error('password')<span>{{ $message }}</span> @enderror

    <label for="">Confirm Password</label>
    <input type="password" placeholder="Email address" name="password_confirmation" value="{{ old('password_confirmation') }}">
    @error('password_confirmation')<span>{{ $message }}</span> @enderror

    <button type="submit">Register</button>
</form>
@endsection