<?php

namespace App\Http\Controllers;

use App\Components\GithubSource;
use App\Models\Category;
use App\Models\GithubRepo;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GithubController extends Controller
{
    public function create() {
        return view('admin.posts.create-from-github');
    }

    public function store(GithubSource $githubSource) {
        $user = auth()->user();

        $attributes = request()->validate([
            'repo_name' => 'required',
            'thumbnail' => ['required', 'image']
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        $repoArray =  $githubSource->getPostInfomationFromRepo($user->github_username, $attributes['repo_name']);
        $githubRepo = GithubRepo::make($repoArray);
        $category = Category::firstOrCreate(['name' => $githubRepo->language, 'slug' => Str::slug($githubRepo->language)]);
        $post = Post::create([
            'title'       => $githubRepo->repo_name,
            'thumbnail'   => $attributes['thumbnail'],
            'slug'        => Str::slug($githubRepo->repo_name),
            'excerpt'     => $githubRepo->description,
            'body'        => $githubRepo->read_me,
            'category_id' => $category->id,
            'user_id'     => $attributes['user_id'],
            ]);

        $post->repo()->save($githubRepo);
        $githubRepo->save();
        $post->save();


        return redirect('/');
    }
}
