<?php

namespace app\Services;

use Facebook\Facebook;

class FacebookService
{
    protected $fb;

    public function __construct()
    {
        $this->fb = new Facebook([
            'app_id' => env('FACEBOOK_APP_ID'),
            'app_secret' => env('FACEBOOK_APP_SECRET'),
            'default_graph_version' => 'v10.0',
        ]);
    }

    // function to get facebook posts
    public function getPosts($pageId)
    {
        $response = $this->fb->get("/$pageId/posts", env('FACEBOOK_ACCESS_TOKEN'));
        return $response->getDecodedBody();
    }
}
