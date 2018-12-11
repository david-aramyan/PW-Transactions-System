<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Get the list of users ordered by name as json string
     *
     * @return string
     */
    public function listJson()
    {
        $users =  User::where('id', '!=', auth()->user()->id)->orderBy('name')->get();
        return $users->toJson();
    }

    /**
     * Get the current balance of authenticated user
     *
     * @return string
     */
    public function getCurrentBalance(){
        return auth()->user()->balance;
    }
}
