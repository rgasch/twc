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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(array $tweetIDs, array $parameters=[]): \stdClass
    {
        $parameters['ids'] = $tweetIDs;

        $uri = 'tweets' . $this->serializeParameters($parameters);
        dump ($uri);

        return JsonHelper::jsonToStdClass((string)$this->apiClient->get($uri)->getBody());
    }
}
