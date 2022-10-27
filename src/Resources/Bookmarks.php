<?php
declare(strict_types=1);

namespace Rgasch\TwitterClient\Resources;

use Rgasch\TwitterClient\Helpers\JsonHelper;
use Rgasch\TwitterClient\Resources\Base\BaseResource;

/**
 *
 */
class Bookmarks extends BaseResource
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(int $userID, array $parameters=[]): \stdClass
    {
        $uri = "users/{$userID}/bookmarks" . $this->serializeParameters($parameters);

        return JsonHelper::jsonToStdClass($this->apiClient->get($uri)->getBody());
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(int $userID, array $postData): \stdClass
    {
        $uri = "users/{$userID}/bookmarks";

        return JsonHelper::jsonToStdClass($this->apiClient->post($uri, [ 'json'=>$postData ])->getBody());
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(int $userID, int $tweetID): \stdClass
    {
        $uri = "users/{$userID}/bookmarks/{$tweetID}";

        return JsonHelper::jsonToStdClass($this->apiClient->delete($uri)->getBody());
    }
}
