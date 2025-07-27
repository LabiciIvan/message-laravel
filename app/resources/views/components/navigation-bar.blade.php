<div>
    <a href={{ route('view.home') }}>Home</a>
    @if (Auth::check())
        <a href={{ route('friendRequest.index') }}>Sent Friend requests</a>
        <a href={{ route('friendRequest.received') }}>Received Friend requests</a>
        <a href={{ route('friends.index') }}>Friends list</a>
        <form method="post" action="{{ route('process.logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @else
        <a href={{ route('view.login') }}>Login</a>
        <a href={{ route('view.register') }}>Register</a>
    @endif
</div>