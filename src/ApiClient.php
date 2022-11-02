<?php
declare(strict_types=1);

namespace Rgasch\TwitterClient;

use GuzzleHttp\Client as Guzzle;
use Ramsey\Uuid\Type\Time;
use Rgasch\TwitterClient\Enums\ResponseFormatEnum;
use Rgasch\TwitterClient\Resources\Bookmarks;
use Rgasch\TwitterClient\Resources\Likes;
use Rgasch\TwitterClient\Resources\QuoteTweets;
use Rgasch\TwitterClient\Resources\Retweets;
use Rgasch\TwitterClient\Resources\Timelines;
use Rgasch\TwitterClient\Resources\Tweets;
use Rgasch\TwitterClient\Resources\UserBlocks;
use Rgasch\TwitterClient\Resources\UserFollows;
use Rgasch\TwitterClient\Resources\UserMutes;
use Rgasch\TwitterClient\Resources\Users;

/**
 * See https://developer.twitter.com/en/docs/api-reference-index
 */
class ApiClient
{
    public readonly Guzzle $apiClient;
    public readonly string $baseUri;
    public readonly bool $debug;

    public readonly Bookmarks $bookmarks;
    public readonly Likes $likes;
    public readonly QuoteTweets $quoteTweets;
    public readonly Retweets $retweets;
    public readonly Timelines $timelines;
    public readonly Tweets $tweets;
    public readonly UserBlocks $userBlocks;
    public readonly UserFollows $userFollows;
    public readonly UserMutes $userMutes;
    public readonly Users $users;

    public function __construct(string $bearerToken, ResponseFormatEnum $responseFormat=ResponseFormatEnum::JSON, bool $debug = false)
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
        $this->apiClient   = new Guzzle($guzzleConfig);

        $this->bookmarks   = new Bookmarks($this->apiClient, $responseFormat);
        $this->likes       = new Likes($this->apiClient, $responseFormat);
        $this->quoteTweets = new QuoteTweets($this->apiClient, $responseFormat);
        $this->retweets    = new Retweets($this->apiClient, $responseFormat);
        $this->timelines   = new Timelines($this->apiClient, $responseFormat);
        $this->tweets      = new Tweets($this->apiClient, $responseFormat);
        $this->userBlocks  = new UserBlocks($this->apiClient, $responseFormat);
        $this->userFollows = new UserFollows($this->apiClient, $responseFormat);
        $this->userMutes   = new UserMutes($this->apiClient, $responseFormat);
        $this->users       = new Users($this->apiClient, $responseFormat);
    }
}

