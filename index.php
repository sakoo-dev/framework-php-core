<?php

declare(strict_types=1);

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;

// Create Kernel

$server = new Server("0.0.0.0", 9501);

$server->set([
    'worker_num' => swoole_cpu_num() * 2,
    'daemonize' => false,
    'max_request' => 10000,
    'dispatch_mode' => 2,
    'debug_mode' => 0,
    'enable_coroutine' => true,
    'log_level' => \SWOOLE_LOG_TRACE,
]);

$server->on('request', function (Request $request, Response $response) {
    $response->header('Content-Type', 'text/html');
    $response->status(200);
    $response->end('Hello World!');
});

$server->on('start', function (Server $server) {
    echo "Swoole HTTP server started at http://127.0.0.1:9501\n";
//    echo "Worker processes: {$server->setting['worker_num']}\n";
});

$server->on('shutdown', function (Server $server) {
    echo "Swoole HTTP server shutdown at http://127.0.0.1:9501\n";
});

$server->start();
