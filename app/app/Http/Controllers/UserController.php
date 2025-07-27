<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show(string $id): View
    {

        // $user = User::first();
        error_log('-----------just in to the logs-------');
        User::create([
            'name' => 'Ioan',
            'email' => 'ioan2@mail.com',
            'password' => 'secret'
        ]);
        // dd($user);
        return view('welcome', [
            'user' => "JUST A TEST"
        ]);
    }

}
