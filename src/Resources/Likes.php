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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLikedTweets(int $userID, array $parameters=[]): \stdClass
    {
        $uri = "users/{$userID}/liked_tweets" . $this->serializeParameters($parameters);

        return JsonHelper::jsonToStdClass((string)$this->apiClient->get($uri)->getBody());
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLikingUsers(int $tweetID, array $parameters=[]): \stdClass
    {
        $uri = "tweets/{$tweetID}/liking_users" . $this->serializeParameters($parameters);

        return JsonHelper::jsonToStdClass((string)$this->apiClient->get($uri)->getBody());
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(int $userID, int $tweetID): \stdClass
    {
        $uri = "users/{$userID}/likes";

        return JsonHelper::jsonToStdClass((string)$this->apiClient->post($uri, [ 'json'=> [ 'tweet_id'=>$tweetID ] ])->getBody());
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(int $userID, int $tweetID): \stdClass
    {
        $uri = "users/{$userID}/likes/{$tweetID}";

        return JsonHelper::jsonToStdClass((string)$this->apiClient->delete($uri)->getBody());
    }
}
