<?php
declare(strict_types=1);

namespace Rgasch\TwitterClient\Helpers;

use GuzzleHttp\Utils;
use Illuminate\Support\Collection;
use Psr\Http\Message\ResponseInterface;


/**
 *
 */
class JsonHelper
{
    /**
     * @param ResponseInterface|string $json
     * @return array
     */
    public static function jsonToArray (ResponseInterface|string $json): array
    {
        return Utils::jsonDecode((string)$json, true);
    }

    /**
     * @param ResponseInterface|string $json
     * @return array
     */
    public static function jsonToCollection(ResponseInterface|string $json): Collection
    {
        return new Collection(Utils::jsonDecode((string)$json, true));
    }

    /**
     * @param ResponseInterface|string $json
     * @return \stdClass
     */
    public static function jsonToStdClass(ResponseInterface|string $json): \stdClass
    {
        return Utils::jsonDecode((string)$json, false);
    }

    /**
     * @param \stdClass $class
     * @return array
     */
    public static function stdClassToArray(\stdClass $class): array
    {
        return json_decode(json_encode($class), true);
    }
}

