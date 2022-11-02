<?php

declare(strict_types=1);

namespace Rgasch\TwitterClient\Enums;

enum ResponseFormatEnum
{
    case ARRAY;
    case COLLECTION;
    case JSON;
    case STDCLASS;
}
