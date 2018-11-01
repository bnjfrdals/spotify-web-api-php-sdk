#!/usr/bin/env php
<?php

require 'bootstrap.php';

use Bench1ps\Spotify\Authorization\Authorization;
use Bench1ps\Spotify\Session\SessionHandler;

$credentials = SpotifyExample::load();
$scopes = [
    'playlist-read-private',
    'playlist-read-collaborative',
    'playlist-modify-public',
    'playlist-modify-private',
    'streaming',
    'user-follow-modify',
    'user-follow-read',
    'user-library-read',
    'user-library-modify',
    'user-read-private',
    'user-read-birthdate',
    'user-read-email',
    'user-top-read'
];

$sessionHandler = new SessionHandler();
$authentication = new Authorization($credentials, $sessionHandler);
$query = $authentication->getAuthorizationQuery($scopes, true);

SpotifyExample::printSuccess('Call this URL to fetch an authorization code:');
SpotifyExample::printInfo($query);