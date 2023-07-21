@extends ('layout.main');

@section('content');
    <form action="{{ URL::route('account-create-post') }}" method="post">
        <div class="field">
            Email: <input type="text" name="email">
        </div>
        <div class="field">
            Username: <input type="text" name="username">
        </div>
        <div class="field">
            Pass: <input type="passowrd" name="password">
        </div>
        <div class="field">
            Pass again: <input type="passowrd" name="password_again">
        </div>

        <input type="submit" value="Create account">
        @csrf
    </form>

@stop;