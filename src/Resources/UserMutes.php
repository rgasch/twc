<?php
declare(strict_types=1);

namespace Rgasch\TwitterClient\Resources;

use Rgasch\TwitterClient\Helpers\ResponseHelper;
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

        return ResponseHelper::format((string)$this->apiClient->get($uri)->getBody(), $this->responseFormat);
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

        return ResponseHelper::format((string)$this->apiClient->post($uri, ['json' =>$postData ])->getBody(), $this->responseFormat);
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

        return ResponseHelper::format((string)$this->apiClient->delete($uri)->getBody(), $this->responseFormat);
    }
}
