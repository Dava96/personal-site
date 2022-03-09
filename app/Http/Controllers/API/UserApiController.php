<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserApiController extends Controller
{
    public function index() {
        return User::all();
    }

    public function show(User $user) {
        return $user;
    }
}
