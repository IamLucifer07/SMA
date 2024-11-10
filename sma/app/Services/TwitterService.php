<?php

namespace App\Services;

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterService
{
    protected $connection;

    public function __construct()
    {
        $this->connection = new TwitterOAuth(
            env('TWITTER_API_KEY'),
            env('TWITTER_API_SECRET_KEY'),
            env('TWITTER_ACCESS_TOKEN'),
            env('TWITTER_ACCESS_TOKEN_SECRET')
        );
    }

    public function getTweets($query, $count = 10)
    {
        return $this->connection->get("search/tweets", ["q" => $query, "count" => $count]);
    }
}
