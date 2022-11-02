<?php
declare(strict_types=1);

namespace Rgasch\TwitterClient;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Utils;
use Psr\Http\Message\ResponseInterface;
use Rgasch\TwitterClient\Enums\ResponseFormatEnum;
use Rgasch\TwitterClient\Helpers\ResponseHelper;
use Rgasch\TwitterClient\Interfaces\TokenDatabaseUpdateInterface;
use Rgasch\TwitterClient\Resources\Bookmarks;
use Rgasch\TwitterClient\Resources\Likes;
use Rgasch\TwitterClient\Resources\Tweets;

/**
 * See https://developer.twitter.com/en/docs/authentication/oauth-2-0/user-access-token
 *
 * A successful request returns a structure like this:
 * {
 *   "token_type": "bearer"
 *   "expires_in": 7200
 *   "access_token": "elwieurghdsjkfGSDGiugkfbiukfsafkjlJWMEpCSThWTsdfpohsdfkbwerIOGERKJSKJHisudfgsdf6MToxOmF0OjE"
 *   "scope": "mute.write tweet.moderate.write block.read follows.read offline.access list.write bookmark.read list.read tweet.write space.read block.write like.write like.read users.read tweet.read bookmark.write mute.read follows.write"
 *   "refresh_token": "ZDODFSiuhfbmnqwxpkamsdfasfhbvkajsdYAKPOIEWQBHJBxNXNBVk1VWkN0OjE2NjczMzU5NDcxNzE6MToxOnJ0OjE"
 * }
 *
 * It is the calling program's request to ensure that credentials are updated whereever they're stored.
 */
class TokenRefreshClient
{
    public readonly string $baseUri;
    public readonly bool $debug;

    public function __construct(
        public readonly string $clientID,
        public readonly string $clientSecret,
        public readonly string $refreshToken,
        public readonly ResponseFormatEnum $responseFormat=ResponseFormatEnum::JSON,
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
        $contents   = ResponseHelper::format((string)$response->getBody(), $this->responseFormat);

        dump($statusCode);
        dump($contents);

        return $contents;
    }
}

