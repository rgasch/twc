<?php
declare(strict_types=1);

namespace Rgasch\TwitterClient\Resources;

use Rgasch\TwitterClient\Helpers\JsonHelper;
use Rgasch\TwitterClient\Resources\Base\BaseResource;

/**
 *
 */
class Likes extends BaseResource
{
    /**
     * See https://developer.twitter.com/en/docs/twitter-api/tweets/likes/api-reference/get-users-id-liked_tweets
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLikedTweets(int $userID, array $options=[]): \stdClass
    {
        $uri = "users/{$userID}/liked_tweets" . $this->serializeParameters($options);

        return JsonHelper::jsonToStdClass((string)$this->apiClient->get($uri)->getBody());
    }

    /**
     * See https://developer.twitter.com/en/docs/twitter-api/tweets/likes/api-reference/get-tweets-id-liking_users
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLikingUsers(int $tweetID, array $options=[]): \stdClass
    {
        $uri = "tweets/{$tweetID}/liking_users" . $this->serializeParameters($options);

        return JsonHelper::jsonToStdClass((string)$this->apiClient->get($uri)->getBody());
    }

    /**
     * See https://developer.twitter.com/en/docs/twitter-api/tweets/likes/api-reference/post-users-id-likes
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(int $userID, int $tweetID): \stdClass
    {
        $uri = "users/{$userID}/likes";

        return JsonHelper::jsonToStdClass((string)$this->apiClient->post($uri, [ 'json'=> [ 'tweet_id'=>$tweetID ] ])->getBody());
    }

    /**
     * See https://developer.twitter.com/en/docs/twitter-api/tweets/likes/api-reference/delete-users-id-likes-tweet_id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(int $userID, int $tweetID): \stdClass
    {
        $uri = "users/{$userID}/likes/{$tweetID}";

        return JsonHelper::jsonToStdClass((string)$this->apiClient->delete($uri)->getBody());
    }
}
