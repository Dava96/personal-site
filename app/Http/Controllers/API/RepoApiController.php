<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\GithubRepo;

use function dd;

class RepoApiController extends Controller
{
    public function index() {
        return GithubRepo::all();
    }

    public function show(GithubRepo $githubRepo) {
        return $githubRepo;
    }
}
