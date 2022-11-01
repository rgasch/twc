<?php
declare(strict_types=1);

namespace Rgasch\TwitterClient\Resources;

use Rgasch\TwitterClient\Helpers\JsonHelper;
use Rgasch\TwitterClient\Resources\Base\BaseResource;

/**
 *
 */
class UserFollows extends BaseResource
{
    /**
     * See https://developer.twitter.com/en/docs/twitter-api/users/follows/api-reference/get-users-id-followers
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFollowers(int $userID, array $options=[]): \stdClass
    {
        $uri = "users/{$userID}/followers" . $this->serializeParameters($options);

        return JsonHelper::jsonToStdClass((string)$this->apiClient->get($uri)->getBody());
    }

    /**
     * See https://developer.twitter.com/en/docs/twitter-api/users/follows/api-reference/get-users-id-following
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getFollowing(int $userID, array $options=[]): \stdClass
    {
        $uri = "users/{$userID}/following" . $this->serializeParameters($options);

        return JsonHelper::jsonToStdClass((string)$this->apiClient->get($uri)->getBody());
    }

    /**
     * See https://developer.twitter.com/en/docs/twitter-api/users/follows/api-reference/post-users-source_user_id-following
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(int $userID, int $targetUserID): \stdClass
    {
        $uri      = "users/{$userID}/blocking";
        $postData = [ 'target_user_id' => $targetUserID ];

        return JsonHelper::jsonToStdClass((string)$this->apiClient->post($uri, [ 'json'=>$postData ])->getBody());
    }

    /**
     *
     * See https://developer.twitter.com/en/docs/twitter-api/users/blocks/api-reference/delete-users-user_id-blocking
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(int $userID, int $targetUserID): \stdClass
    {
        $uri = "users/{$userID}/following/{$targetUserID}";

        return JsonHelper::jsonToStdClass((string)$this->apiClient->delete($uri)->getBody());
    }
}
