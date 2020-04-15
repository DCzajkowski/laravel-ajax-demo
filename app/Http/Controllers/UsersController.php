<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        return User::where('email', 'like', "%$search%")->get();
    }
}
