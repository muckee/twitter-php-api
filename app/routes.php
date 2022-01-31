<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Actions\Twitter\UpdateTwitterAction;
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
    $app->group('/2', function (Group $group) {
        $group->post('/tweets', function (
            Request $request,
            Response $response
        ) {
            // Retrieve desired tweet text from POST request
            $queryParams = $request->getQueryParams();
            $text = $queryParams['text'];

            // Publish tweet
            $twitterOAuth = $this->get('twitterOAuth');
            $statuses = $twitterOAuth->post(
                "statuses/update",
                [
                    "status" => $text
                ]
            );

            // Derive tweet URI from response
            $payload = 'https://twitter.com/' .
                $statuses->user->id_str .
                '/status/' .
                $statuses->id_str;

            // Add tweet URI to response
            $response->getBody()->write($payload);

            // Return response to user
            return $response
                ->withHeader('Content-Type', 'text/html');
        });
    });
};
