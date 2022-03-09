<?php

namespace App\Http\Controllers;

use App\Models\GithubRepo;
use Illuminate\Http\Request;

class RepoApiController extends Controller
{
    public function index() {
        return GithubRepo::all();
    }
}
