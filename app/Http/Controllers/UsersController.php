<?php

namespace App\Http\Controllers;

use App\User;

class UsersController extends Controller
{
    public function showAll()
    {
        return view('users.show-all')->with(['users' =>User::all()]);
    }
}
