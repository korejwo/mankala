#!/usr/bin/env php
<?php

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use App\Socket\Chat;
use Ratchet\WebSocket\WsServer;

require dirname(__DIR__) . '/vendor/autoload.php';

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new Chat()
        )
    ),
    8080
);
$server->run();
