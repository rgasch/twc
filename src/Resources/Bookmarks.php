<?php
declare(strict_types=1);

namespace Rgasch\TwitterClient\Resources;

use Rgasch\TwitterClient\Helpers\ResponseHelper;
use Rgasch\TwitterClient\Resources\Base\BaseResource;

/**
 *
 */
class Bookmarks extends BaseResource
{
    /**
     * See https://developer.twitter.com/en/docs/twitter-api/tweets/bookmarks/api-reference/get-users-id-bookmarks
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(int $userID, array $options=[]): \stdClass
    {
        $uri = "users/{$userID}/bookmarks" . $this->serializeParameters($options);

        return ResponseHelper::format((string)$this->apiClient->get($uri)->getBody(), $this->responseFormat);
    }

    /**
     * See https://developer.twitter.com/en/docs/twitter-api/tweets/bookmarks/api-reference/post-users-id-bookmarks
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(int $userID, array $postData): \stdClass
    {
        $uri = "users/{$userID}/bookmarks";

        return ResponseHelper::format((string)$this->apiClient->post($uri, ['json' =>$postData ])->getBody(), $this->responseFormat);
    }

    /**
     *
     * See https://developer.twitter.com/en/docs/twitter-api/tweets/bookmarks/api-reference/delete-users-id-bookmarks-tweet_id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(int $userID, int $tweetID): \stdClass
    {
        $uri = "users/{$userID}/bookmarks/{$tweetID}";

        return ResponseHelper::format((string)$this->apiClient->delete($uri)->getBody(), $this->responseFormat);
    }
}
