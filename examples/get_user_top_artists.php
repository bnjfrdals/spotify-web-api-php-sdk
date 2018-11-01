#!/usr/bin/env php
<?php

require 'bootstrap.php';

use Bench1ps\Spotify\API\API;
use Bench1ps\Spotify\Session\SessionHandler;
use Bench1ps\Spotify\Session\Session;
use Bench1ps\Spotify\Exception\SpotifyException;

$nbArtists = 10;
$offset = 0;
$timeRange = API::RANGE_LONG;

try {
    $credentials = SpotifyExample::load();
    $sessionHandler = new SessionHandler();
    $sessionHandler->addSession(new Session('foobar', $credentials['access_token'], '', 3600));

    $client = new API($sessionHandler);
    $result = $client->getCurrentUserTopArtists($nbArtists, $offset, $timeRange);

    SpotifyExample::printSuccess(sprintf('Found %d top artists (%s):', count($result->items), $timeRange));
    SpotifyExample::printList($result->items, function (stdClass $artist) {
        return sprintf('%s (%s)', $artist->name, $artist->external_urls->spotify);
    });
} catch (SpotifyException $e) {
    SpotifyExample::printException($e);
}
