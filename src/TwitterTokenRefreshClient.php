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
class TwitterTokenRefreshClient
{
    public readonly string $baseUri;
    public readonly bool $debug;

    public function __construct(
        public readonly string $clientID,
        public readonly string $refreshToken,
        public readonly string $updateDatabaseClass,
        bool                   $debug = false)
    {
        if (!$clientID) {
            throw new \InvalidArgumentException('Invalid [clientID] received');
        }
        if (!$refreshToken) {
            throw new \InvalidArgumentException('Invalid [refreshToken] received');
        }
        if (!$this->updateDatabaseClass) {
            throw new \InvalidArgumentException('Invalid [updateDatabaseClass] received');
        }
        if (!class_exists($this->updateDatabaseClass)) {
            throw new \InvalidArgumentException('Unable to load updateDatabaseClass [$updateDatabaseClass] received');
        }
        $reflectionClass = new \ReflectionClass($this->updateDatabaseClass);
        if (!$reflectionClass->implementsInterface(TokenDatabaseUpdateInterface::class)) {
            throw new \InvalidArgumentException('$this->updateDatabaseClass does not implement the [TokenDatabaseUpdateInterface]');
        }

        $this->baseUri = 'https://api.twitter.com/2/oauth2/';
        $this->debug   = $debug;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function refreshToken(): \stdClass
    {
        $guzzleConfig = [
            'debug'    => $this->debug,
            'base_uri' => $this->baseUri,
            'headers'  => [
                'ContentType' => "application/x-www-form-urlencoded",
                'Accept'      => 'application/json',
            ]
        ];

        $apiClient = new Guzzle($guzzleConfig);

        $response = $apiClient->post(
            'token',
            [
                'form_params' => [
                    'client_id'    => $this->clientID,
                    'refreshToken' => $this->refreshToken,
                    'grant_type'   => 'refresh_token',
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

