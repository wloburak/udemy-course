<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;


class AccountController extends Controller {

    public function getSignIn() {
        return View::make('account.signin');
    }

    public function postSignIn(Request $request) {
        $validator = Validator::make(\request()->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::route('account-sign-in')->withErrors($validator)->withInput();
        } else {
            $auth = Auth::attempt([
                'email' => request()->input('email'),
                'password' => request()->input('password'),
                'active' => '1',
            ]);

            if ($auth) {
                return Redirect::intended('/');
            }

            return Redirect::route('account-sign-in')->with('global', 'Can not sign you in');
        }
    }

    public function getCreate(Request $request) {
        return view('account.create');
    }

    public function postCreate(Request $request) {
        $validator = Validator::make(\request()->all(), [
            'email' => 'required|max:50|email|unique:users',
            'username' => 'required|max:20',
            'password' => 'required',
            'password_again' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return Redirect::route('account-create-post')->withErrors($validator)->withInput();
        } else {
            $email = request()->input('email');
            $username = request()->input('username');
            $password = request()->input('password');
            $code = Str::random(60);

            $user = User::create([
                'email' => $email,
                'username' => $username,
                'password' => $password,
                'code' => $code,
                'active' => 1,
            ]);

            if ($user) {
                Mail::send('emails.auth.activate', ['link' => URL::route('account-activate', $code), 'username' => $username], function ($message) use ($user) {
                    $message->to($user->email)->subject('Activate account');
                });

                return Redirect::route('home')->with('global', 'Account Created!');
            }
        }
    }

    public function getActivate($code) {
        $user = User::where('code', '=', $code)->where('active', '=', 0);
        
        if ($user->count()) {
            $user = $user->first();

            //updare the user state
            $user->active = 1;
            $user->code = '';

            $user->save();

            if ($user->save()) {
                return Redirect::route('home')->with('global', 'Account was activated!');
            }
        }

        return Redirect::route('home')->with('global', 'Account can not be activated');
    }

}