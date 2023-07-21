<nav>
    <ul>
        <li><a href="{{ URL::route('home') }}">Home</a></li>
        
        @if(Auth::check())

        @else 
            <li><a href="{{ URL::route('account-sign-in')}}">Sign In</a></li>
            <li><a href="{{ URL::route('account-create')}}">Create an Account</a></li>
        @endif;
    </ul>
</nav>