<?php
declare(strict_types=1);

namespace Rgasch\TwitterClient\Resources;

use Rgasch\TwitterClient\Helpers\JsonHelper;
use Rgasch\TwitterClient\Resources\Base\BaseResource;

/**
 *
 */
class Retweets extends BaseResource
{
    /**
     * See https://developer.twitter.com/en/docs/twitter-api/tweets/retweets/api-reference/get-tweets-id-retweeted_by
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(int $tweetID, array $options= []): \stdClass
    {
        $uri = "tweets/{$tweetID}/retweeted_by" . $this->serializeParameters($options);

        return JsonHelper::jsonToStdClass((string)$this->apiClient->get($uri)->getBody());
    }
}
