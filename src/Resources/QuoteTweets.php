<?php
declare(strict_types=1);

namespace Rgasch\TwitterClient\Resources;

use Rgasch\TwitterClient\Helpers\ResponseHelper;
use Rgasch\TwitterClient\Resources\Base\BaseResource;

/**
 *
 */
class QuoteTweets extends BaseResource
{
    /**
     * See https://developer.twitter.com/en/docs/twitter-api/tweets/quote-tweets/api-reference/get-tweets-id-quote_tweets
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(int $tweetID, array $options= []): \stdClass
    {
        $uri = "tweets/{$tweetID}/quoteTweets" . $this->serializeParameters($options);

        return ResponseHelper::format((string)$this->apiClient->get($uri)->getBody(), $this->responseFormat);
    }
}
