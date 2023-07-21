<nav>
    <ul>
        <li><a href="{{ URL::route('routes.web') }}">Home</a></li>
        
        @if(Auth::check())

        @else 

        @endif;
    </ul>
</nav>