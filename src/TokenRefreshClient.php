<?php
declare(strict_types=1);

namespace Rgasch\TwitterClient;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Utils;
use Psr\Http\Message\ResponseInterface;
use Rgasch\TwitterClient\Helpers\JsonHelper;
use Rgasch\TwitterClient\Interfaces\TokenDatabaseUpdateInterface;
use Rgasch\TwitterClient\Resources\Bookmarks;
use Rgasch\TwitterClient\Resources\Likes;
use Rgasch\TwitterClient\Resources\Tweets;

/**
 * See https://developer.twitter.com/en/docs/api-reference-index
 */
class TokenRefreshClient
{
    public readonly string $baseUri;
    public readonly bool $debug;

    public function __construct(
        public readonly string $clientID,
        public readonly string $clientSecret,
        public readonly string $refreshToken,
        bool                   $debug = false)
    {
        if (!trim($clientID)) {
            throw new \InvalidArgumentException('Invalid [clientID] received');
        }
        if (!trim($clientSecret)) {
            throw new \InvalidArgumentException('Invalid [clientSecret] received');
        }
        if (!trim($refreshToken)) {
            throw new \InvalidArgumentException('Invalid [refreshToken] received');
        }

        $this->baseUri = 'https://api.twitter.com/2/oauth2/';
        $this->debug   = $debug;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function refreshToken(): \stdClass
    {
        $authToken = base64_encode("{$this->clientID}:{$this->clientSecret}");
        $guzzleConfig = [
            'debug'    => $this->debug,
            'base_uri' => $this->baseUri,
            'headers'  => [
                'Accept'        => 'application/json',
                'Authorization' => "Basic {$authToken}",
                'ContentType'   => "application/x-www-form-urlencoded",
            ]
        ];

        $apiClient = new Guzzle($guzzleConfig);

        $response = $apiClient->post(
            'token',
            [
                'form_params' => [
                    'client_id'     => $this->clientID,
                    'grant_type'    => 'refresh_token',
                    'refresh_token' => $this->refreshToken,
                ]
            ]
        );

        $statusCode = $response->getStatusCode();
        $contents   = JsonHelper::jsonToStdClass((string)$response->getBody());

        dump($statusCode);
        dump($contents);

        return $contents;
    }
}

