<?php
declare(strict_types=1);

namespace Rgasch\TwitterClient\Resources;

use Rgasch\TwitterClient\Helpers\JsonHelper;
use Rgasch\TwitterClient\Resources\Base\BaseResource;

/**
 *
 */
class UserMutes extends BaseResource
{
    /**
     * See https://developer.twitter.com/en/docs/twitter-api/users/mutes/api-reference/get-users-muting
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(int $userID, array $options=[]): \stdClass
    {
        $uri = "users/{$userID}/muting" . $this->serializeParameters($options);

        return JsonHelper::jsonToStdClass((string)$this->apiClient->get($uri)->getBody());
    }

    /**
     * See https://developer.twitter.com/en/docs/twitter-api/users/mutes/api-reference/post-users-user_id-muting
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(int $userID, int $targetUserID): \stdClass
    {
        $uri      = "users/{$userID}/muting";
        $postData = [ 'target_user_id' => $targetUserID ];

        return JsonHelper::jsonToStdClass((string)$this->apiClient->post($uri, [ 'json'=>$postData ])->getBody());
    }

    /**
     *
     * See https://developer.twitter.com/en/docs/twitter-api/users/mutes/api-reference/delete-users-user_id-muting
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(int $userID, int $targetUserID): \stdClass
    {
        $uri = "users/{$userID}/muting/{$targetUserID}";

        return JsonHelper::jsonToStdClass((string)$this->apiClient->delete($uri)->getBody());
    }
}
