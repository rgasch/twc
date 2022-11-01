<?php
declare(strict_types=1);

namespace Rgasch\TwitterClient\Resources;

use Rgasch\TwitterClient\Helpers\JsonHelper;
use Rgasch\TwitterClient\Resources\Base\BaseResource;

/**
 *
 */
class Users extends BaseResource
{
    /**
     * See https://developer.twitter.com/en/docs/twitter-api/users/lookup/api-reference/get-users-id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getByUserID(int $userID, array $options=[]): \stdClass
    {
        $uri = "users/{$userID}" . $this->serializeParameters($options);

        return JsonHelper::jsonToStdClass((string)$this->apiClient->get($uri)->getBody());
    }

    /**
     * See https://developer.twitter.com/en/docs/twitter-api/users/lookup/api-reference/get-users-id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getByUserIDs(array $userIDs, array $options=[]): \stdClass
    {
        $options['ids'] = implode(',', $userIDs);
        $uri            = "users" . $this->serializeParameters($options);

        return JsonHelper::jsonToStdClass((string)$this->apiClient->get($uri)->getBody());
    }

    /**
     * See https://developer.twitter.com/en/docs/twitter-api/users/lookup/api-reference/get-users-by
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getByUsername(string $username, array $options=[]): \stdClass
    {
        $uri = "users/by/username/{$username}" . $this->serializeParameters($options);

        return JsonHelper::jsonToStdClass((string)$this->apiClient->get($uri)->getBody());
    }

    /**
     * See https://developer.twitter.com/en/docs/twitter-api/users/lookup/api-reference/get-users-by
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getByUsernames(array $usernames, array $options=[]): \stdClass
    {
        $options['usernames'] = implode(',', $usernames);
        $uri                  = "users/by" . $this->serializeParameters($options);

        return JsonHelper::jsonToStdClass((string)$this->apiClient->get($uri)->getBody());
    }

    /**
     * See https://developer.twitter.com/en/docs/twitter-api/users/lookup/api-reference/get-users-by
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMe(array $options=[]): \stdClass
    {
        $uri = "users/me" . $this->serializeParameters($options);

        return JsonHelper::jsonToStdClass((string)$this->apiClient->get($uri)->getBody());
    }
}
