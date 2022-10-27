<?php
declare(strict_types=1);

namespace Rgasch\TwitterClient\Interfaces;

/**
 *
 */
interface TokenDatabaseUpdateInterface
{
    public static function updateToken(int $userID, string $token, \DateTime $expiresAt): void;
}