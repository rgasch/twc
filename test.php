<?php

require_once('vendor/autoload.php');

$token = 'NUk1b2FENDBjbjlJbE1tMnRycGlVVnk2ZF9PTWFrV1FhUnpDRjAweEs0SlN2OjE2NjY3MDc5MzExMjg6MToxOmF0OjE';
$apiClient = new \Rgasch\TwitterClient\TwitterClient($token);
$t = $apiClient->tweets->get([1583205591219982336]);

dump ($t);

