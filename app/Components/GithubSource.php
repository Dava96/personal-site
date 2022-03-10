<?php

namespace App\Components;

use Github\Client;

class GithubSource
{

    protected $client;

    public function __construct($accessToken)
    {
        $this->client = new \Github\Client();
        $this->client->authenticate($accessToken, Client::AUTH_ACCESS_TOKEN);
    }

    public function getPostInfomationFromRepo($githubUser, $repoName) {
        $repo = $this->client->api('repo')->show($githubUser, $repoName);

        try {
            $readMe = $this->client->api('repo')->readme($githubUser, $repo['name']);
        } catch (\Exception $e) {
            $readMe = 'There is no read me for this repo, please write one :)';
        }

        $readMe = $this->client->api('markdown')->render($readMe, 'markdown');


        return [
            'repo_name'        => $repo['name'], // Set to title
            'description'      => $repo['description'], // Set to excerpt
            'read_me'          => $readMe, // set to body
            'html_url'         => $repo['html_url'], // use link in a find on github button
            'language'         => $repo['language'], // use to categorise
            'created_at'       => $repo['created_at'], // timestamp
            'updated_at'       => $repo['updated_at'], // timestamp
            'stargazers_count' => $repo['stargazers_count'], // stats panel
            'watchers_count'   => $repo['watchers_count'],
            'forks_count'      => $repo['forks_count'],
            'fork'             => $repo['fork'], // could use this to display the post or not, since it's true or false
        ];
    }

    public function getUserInformation($username) {
        $user = $this->client->api('user')->show($username);

        return [
            'github_name'=> $user['name'],
            'company'    => $user['company'],
            'location'   => $user['location'],
            'bio'        => $user['bio'],
            'followers'  => $user['followers'],
            'following'  => $user['following'],
            'avatar_url' => $user['avatar_url'],
        ];

    }

    public function getPostInformationFromAllRepos($githubUser) {
        $repos = $this->client->api('user')->repositories($githubUser);

        $postInformation = [];

        foreach($repos as $repo) {

            try {
                $readMe = $this->client->api('repo')->readme($githubUser, $repo['name']);
            } catch(\Exception $e) {
                $readMe = 'There is no read me for this repo, please write one :)';
            }

            $readMe = $this->client->api('markdown')->render($readMe, 'markdown');

            $postInformation[] = [
                'repo_name'        => $repo['name'], // Set to title
                'description'      => $repo['description'], // Set to excerpt
                'read_me'          => $readMe, // set to body
                'html_url'         => $repo['html_url'], // use link in a find on github button
                'language'         => $repo['language'], // use to categorise
                'created_at'       => $repo['created_at'], // timestamp
                'updated_at'       => $repo['updated_at'], // timestamp
                'stargazers_count' => $repo['stargazers_count'], // stats panel
                'watchers_count'   => $repo['watchers_count'],
                'forks_count'      => $repo['forks_count'],
                'fork'             => $repo['fork'], // could use this to display the post or not, since it's true or false
            ];
        }

        return $postInformation;
    }
}
