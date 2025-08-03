<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show(string $id): View
    {

        $user = Auth::user();

        return view('user.show', ['userId' => $id]);
    }

}
