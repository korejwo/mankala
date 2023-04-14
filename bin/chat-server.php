#!/usr/bin/env php
<?php

use Ratchet\Http\HttpServer;
use Ratchet\Http\OriginCheck;
use Ratchet\Server\IoServer;
use App\Socket\Chat;
use Ratchet\WebSocket\WsServer;

require dirname(__DIR__) . '/vendor/autoload.php';

$checkedApp = new OriginCheck(new Chat(), ['http://mankala.local']);
$ws = new WsServer($checkedApp);

$server = IoServer::factory(
    new HttpServer(
        $ws
    ),
    8080
);
$server->run();
