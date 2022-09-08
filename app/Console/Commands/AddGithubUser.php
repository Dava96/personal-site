<?php

namespace App\Console\Commands;

use App\Components\GithubSource;
use App\Models\Category;
use App\Models\GithubRepo;
use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class AddGithubUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AddGithubUser {--post}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an account that is used for testing';

    public function __construct(GithubSource $githubSource)
    {
        //TODO Pipeline is failing after I added this
        $this->githubSource = $githubSource;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        if (User::whereUsername('DavidLomathConnis')->exists()) {
            $this->error('User already exists..');
            return self::FAILURE;
        }

        $user = new User([
            'username' => 'DavidLomathConnis',
            'github_username' => 'Dava96',
            'name' => 'David Lomath',
            'email' => 'david1@gmail.com',
            'password' => 'password'
        ]);

        $user->save();

        $this->info('User created: ' . $user);

        if ($this->option('post')) {
            $repoArray = $this->githubSource->getPostInfomationFromRepo('Dava96', 'StarterEdit');
            $githubRepo = GithubRepo::make($repoArray);

            $category = Category::firstOrCreate(['name' => $githubRepo->language, 'slug' => Str::slug($githubRepo->language)]);
            $post = Post::create([
                'title'       => $githubRepo->repo_name,
                'slug'        => Str::slug($githubRepo->repo_name),
                'excerpt'     => $githubRepo->description,
                'body'        => $githubRepo->read_me,
                'category_id' => $category->id,
                'user_id'     => $user->id,
            ]);

            $this->info('Post added');
            $post->repo()->save($githubRepo);
            $githubRepo->save();
            $post->save();
        }

        return self::SUCCESS;
    }
}
