<div class="grid grid-cols-10 items-center gap-2 p-4 bg-gray-100">
    <a class="col-span-1 border bg-red-200 px-4 py-2 rounded hover:bg-red-300 transition text-center"
       href="{{ route('view.home') }}">Home</a>

    @if (Auth::check())
        <a class="col-span-2 bg-blue-100 px-4 py-2 rounded hover:bg-blue-200 transition text-center"
           href="{{ route('friendRequest.index') }}">Sent</a>

        <a class="col-span-2 bg-yellow-100 px-4 py-2 rounded hover:bg-yellow-200 transition text-center"
           href="{{ route('friendRequest.received') }}">Received</a>

        <a class="col-span-2 bg-green-100 px-4 py-2 rounded hover:bg-green-200 transition text-center"
           href="{{ route('friends.index') }}">Friends</a>

        <form method="post" action="{{ route('process.logout') }}" class="col-span-1">
            @csrf
            <button type="submit"
                    class="w-full bg-red-300 text-white px-4 py-2 rounded hover:bg-red-400 transition text-center">
                Logout
            </button>
        </form>
    @else
        <a class="col-span-2 bg-green-200 px-4 py-2 rounded hover:bg-green-300 transition text-center"
           href="{{ route('view.login') }}">Login</a>

        <a class="col-span-2 bg-purple-200 px-4 py-2 rounded hover:bg-purple-300 transition text-center"
           href="{{ route('view.register') }}">Register</a>
    @endif
</div>
