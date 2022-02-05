<?php

declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    // This group is structured in the same format as the official Twitter API
    // In production, all Twitter API functions will be callable from the URI
    // Where the endpoint in the official documentation is appended to the URL
    // of this server. i.e. mywebsite.com/2/tweets
    $app->group('/2', function (Group $group) {

        require __DIR__ . '/routes/twitter.php';
    });
};
