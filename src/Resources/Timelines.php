<?php
declare(strict_types=1);

namespace Rgasch\TwitterClient\Resources;

use Rgasch\TwitterClient\Helpers\JsonHelper;
use Rgasch\TwitterClient\Resources\Base\BaseResource;

/**
 *
 */
class Timelines extends BaseResource
{
    /**
     * See https://developer.twitter.com/en/docs/twitter-api/tweets/timelines/api-reference/get-users-id-mentions
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getMentions(int $userID, array $options= []): \stdClass
    {
        $uri = "users/{$userID}/mentions" . $this->serializeParameters($options);

        return JsonHelper::jsonToStdClass((string)$this->apiClient->get($uri)->getBody());
    }

    /**
     * See https://developer.twitter.com/en/docs/twitter-api/tweets/timelines/api-reference/get-users-id-reverse-chronological
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTimeline(int $userID, array $options= []): \stdClass
    {
        $uri = "users/{$userID}/timelines/reverse_chronological" . $this->serializeParameters($options);

        return JsonHelper::jsonToStdClass((string)$this->apiClient->get($uri)->getBody());
    }

    /**
     * See https://developer.twitter.com/en/docs/twitter-api/tweets/timelines/api-reference/get-users-id-tweets
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTweets(int $userID, array $options= []): \stdClass
    {
        $uri = "users/{$userID}/tweets" . $this->serializeParameters($options);

        return JsonHelper::jsonToStdClass((string)$this->apiClient->get($uri)->getBody());
    }
}
