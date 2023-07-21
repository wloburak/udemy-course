<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function home() {
        // Mail::send('emails.auth.test', ['name' => 'Jeff'], function($message) {
        //     $message->to('wloburak12@gate39media.com', 'Jeff Star')->subject('Test Email');
        // });

        return view('home');
    }
}
