<?php

namespace App\Http\Controllers;

use App\Components\GithubSource;
use App\Models\User;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create() {
        return view('register.create');
    }

    public function store(GithubSource $githubSource) {
        $attributes = request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'username'=> ['required', 'min:3', 'max:255', Rule::unique('users', 'username')],
            'github_username' => ['required', 'max:255', Rule::unique('users', 'github_username')],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'min:7', 'max:255']
        ]);

        $attributes = array_merge($attributes, $githubSource->getUserInformation($attributes['github_username']));
        auth()->login(User::create($attributes));

        return redirect('/')->with('success', 'Your account has been created.');
    }
}
