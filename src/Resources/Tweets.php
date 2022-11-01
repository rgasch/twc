<?php
declare(strict_types=1);

namespace Rgasch\TwitterClient\Resources;

use Rgasch\TwitterClient\Helpers\JsonHelper;
use Rgasch\TwitterClient\Resources\Base\BaseResource;

/**
 *
 */
class Tweets extends BaseResource
{
    /**
     * See
     *   - https://developer.twitter.com/en/docs/twitter-api/tweets/lookup/api-reference/get-tweets
     *   - https://developer.twitter.com/en/docs/twitter-api/tweets/lookup/api-reference/get-tweets-id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(int|array $tweetID, array $options = []): \stdClass
    {
        if (is_array($tweetID)) {
            $uri = 'tweets' . $this->serializeParameters($options);
        } else {
            $uri = "tweets/{$tweetID}" . $this->serializeParameters($options);
        }
        $uri .= $this->serializeParameters($options);

        return JsonHelper::jsonToStdClass((string)$this->apiClient->get($uri)->getBody());
    }

    /**
     * See
     *   - https://developer.twitter.com/en/docs/twitter-api/tweets/counts/api-reference/get-tweets-counts-recent
     *   - https://developer.twitter.com/en/docs/twitter-api/tweets/search/integrate/build-a-query
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function count(array $options = []): \stdClass
    {
        $uri = 'tweets/counts/recent' . $this->serializeParameters($options);

        return JsonHelper::jsonToStdClass((string)$this->apiClient->get($uri)->getBody());
    }

    /**
     * See
     *   - https://developer.twitter.com/en/docs/twitter-api/tweets/search/api-reference/get-tweets-search-recent
     *   - https://developer.twitter.com/en/docs/twitter-api/tweets/search/integrate/build-a-query
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(array $options = []): \stdClass
    {
        $uri = 'tweets/search/recent' . $this->serializeParameters($options);

        return JsonHelper::jsonToStdClass((string)$this->apiClient->get($uri)->getBody());
    }

    /**
     * See https://developer.twitter.com/en/docs/twitter-api/tweets/manage-tweets/api-reference/post-tweets
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(string $text, array $options): \stdClass
    {
        $uri             = "tweets";
        $options['text'] = $text;

        return JsonHelper::jsonToStdClass((string)$this->apiClient->post($uri, ['json' => $options])->getBody());
    }

    /**
     * See https://developer.twitter.com/en/docs/twitter-api/tweets/manage-tweets/api-reference/delete-tweets-id
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(int $tweetID): \stdClass
    {
        $uri = "tweets/{$tweetID}";

        return JsonHelper::jsonToStdClass((string)$this->apiClient->delete($uri)->getBody());
    }
}
