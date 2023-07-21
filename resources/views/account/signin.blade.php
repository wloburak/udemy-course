@extends ('layout.main');

@section('content');
    <form action="{{ URL::route('account-sign-in-post') }}" method="post">
        <div class="field">
            Email: <input type="text" name="email">
        </div>
        <div class="field">
            Pass: <input type="passowrd" name="password">
        </div>

        <input type="submit" value="Login">
        @csrf
    </form>
@stop