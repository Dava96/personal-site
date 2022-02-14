<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GithubRepos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('github_repos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id');
            $table->string('repo_name');
            $table->text('description');
            $table->text('read_me');
            $table->string('html_url');
            $table->text('language');
            $table->timestamps();
            $table->integer('stargazers_count');
            $table->integer('watchers_count');
            $table->integer('forks_count');
            $table->boolean('fork');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
