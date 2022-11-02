<?php
declare(strict_types=1);

namespace Rgasch\TwitterClient\Resources\Base;

use GuzzleHttp\Client as Guzzle;
use Rgasch\TwitterClient\Enums\ResponseFormatEnum;

class BaseResource
{
    public function __construct(protected readonly Guzzle $apiClient, protected readonly ResponseFormatEnum $responseFormat) { }


    public function serializeParameters(array $parameters = []): string
    {
        $fields = [];
        if (!$parameters) {
            return '';
        }

        foreach ($parameters as $k => $v) {
            if (is_array($v)) {
                $fields[] = "{$k}=" . implode(',', $v);
            } else {
                $fields[] = "{$k}={$v}";
            }
        }

        return '?' . implode('&', $fields);
    }
}
