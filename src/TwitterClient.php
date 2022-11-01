<?php
declare(strict_types=1);

namespace Rgasch\TwitterClient;

use GuzzleHttp\Client as Guzzle;
use Rgasch\TwitterClient\Resources\Bookmarks;
use Rgasch\TwitterClient\Resources\Likes;
use Rgasch\TwitterClient\Resources\Tweets;

/**
 * See https://developer.twitter.com/en/docs/api-reference-index
 */
class TwitterClient
{
    public readonly Guzzle $apiClient;
    public readonly string $baseUri;
    public readonly bool $debug;

    public readonly Bookmarks $bookmarks;
    public readonly Likes $likes;
    public readonly Tweets $tweets;

    public function __construct(string $bearerToken, bool $debug = false)
    {
        if (!trim($bearerToken)) {
            throw new \InvalidArgumentException('Invalid [bearerToken] received');
        }

        $this->baseUri = 'https://api.twitter.com/2/';
        $this->debug   = $debug;
        $guzzleConfig  = [
            'debug'    => $debug,
            'base_uri' => $this->baseUri,
            'headers'  => [
                'Authorization' => "Bearer {$bearerToken}",
                'Accept'        => 'application/json',
            ]
        ];

        $this->apiClient = new Guzzle($guzzleConfig);
        $this->bookmarks = new Bookmarks($this->apiClient);
        $this->likes     = new Likes($this->apiClient);
        $this->tweets    = new Tweets($this->apiClient);
    }
}

