<?php
declare(strict_types=1);

namespace Rgasch\TwitterClient\Helpers;

use GuzzleHttp\Utils;
use Illuminate\Support\Collection;
use Psr\Http\Message\ResponseInterface;
use Rgasch\TwitterClient\Enums\ResponseFormatEnum;


/**
 *
 */
class ResponseHelper
{
    public static function format(ResponseInterface|string $json, ResponseFormatEnum $responseFormat=ResponseFormatEnum::JSON): string|array|Collection|\stdClass
    {
        $json = (string)$json; // If $json is a ResponseInterface, casting to string will read the entire response and give us a JSON string.

        return match($responseFormat) {
            ResponseFormatEnum::JSON       => $json,
            ResponseFormatEnum::ARRAY      => self::jsonToArray($json),
            ResponseFormatEnum::STDCLASS   => self::jsonToStdClass($json),
            ResponseFormatEnum::COLLECTION => self::jsonToCollection($json)
        };
    }

    /**
     * @param ResponseInterface|string $json
     * @return array
     */
    private static function jsonToArray (ResponseInterface|string $json): array
    {
        return Utils::jsonDecode((string)$json, true);
    }

    /**
     * @param ResponseInterface|string $json
     * @return array
     */
    private static function jsonToCollection(ResponseInterface|string $json): Collection
    {
        return new Collection(self::jsonToArray($json));
    }

    /**
     * @param ResponseInterface|string $json
     * @return \stdClass
     */
    private static function jsonToStdClass(ResponseInterface|string $json): \stdClass
    {
        return Utils::jsonDecode((string)$json, false);
    }
}

