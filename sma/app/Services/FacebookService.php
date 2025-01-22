<?php

namespace App\Services;

use Facebook\Facebook;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Exceptions\FacebookResponseException;

class facebookservice
{
    protected $fb;

    public function __construct()
    {
        $this->fb = new Facebook([
            'app_id' => config('services.facebook.app_id'),
            'app_secret' => config('services.facebook.app_secret'),
            'default_graph_version' => 'v18.0',
        ]);
    }

    public function getRecentPosts($pageId)
    {
        try {
            $accessToken = config('services.facebook.access_token');

            if (!$accessToken) {
                throw new \Exception('Facebook access token not found in configuration');
            }

            // Get page posts with specific fields
            $response = $this->fb->get(
                "/{$pageId}/posts?fields=id,message,created_time,likes.summary(true),comments.summary(true),shares&limit=10",
                $accessToken
            );

            // Convert response to array
            $graphEdge = $response->getGraphEdge();
            $posts = [];

            // Iterate through each post and safely extract data
            foreach ($graphEdge as $post) {
                $postArray = $post->asArray();

                // Format each post with safe array access
                $posts[] = [
                    'id' => $postArray['id'] ?? '',
                    'message' => $postArray['message'] ?? '(No message)',
                    'created_at' => isset($postArray['created_time'])
                        ? $postArray['created_time']->format('Y-m-d H:i:s')
                        : null,
                    'likes_count' => isset($postArray['likes']['summary']['total_count'])
                        ? $postArray['likes']['summary']['total_count']
                        : 0,
                    'comments_count' => isset($postArray['comments']['summary']['total_count'])
                        ? $postArray['comments']['summary']['total_count']
                        : 0,
                    'shares_count' => isset($postArray['shares']['count'])
                        ? $postArray['shares']['count']
                        : 0
                ];
            }

            return $posts;
        } catch (FacebookResponseException $e) {
            // Handle Graph API errors
            throw new \Exception('Facebook API error: ' . $e->getMessage());
        } catch (FacebookSDKException $e) {
            // Handle SDK errors
            throw new \Exception('Facebook SDK error: ' . $e->getMessage());
        } catch (\Exception $e) {
            // Handle other errors
            throw new \Exception('Error fetching posts: ' . $e->getMessage());
        }
    }
}
