<?php

declare(strict_types=1);

use App\Application\Settings\Settings;
use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Logger;
use Dotenv\Dotenv;

return function (ContainerBuilder $containerBuilder) {

    // Initialise environment variables and define required variables
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $dotenv->required([
        'TWITTER_OAUTH_TOKEN',
        'TWITTER_OAUTH_TOKEN_SECRET',
        'TWITTER_ACCESS_TOKEN',
        'TWITTER_ACCESS_TOKEN_SECRET'
    ]);

    // Global Settings Object
    $containerBuilder->addDefinitions([
        SettingsInterface::class => function () {
            return new Settings([
                'displayErrorDetails' => true, // Should be set to false in production
                'logError'            => false,
                'logErrorDetails'     => false,
                'logger' => [
                    'name' => 'slim-app',
                    'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                    'level' => Logger::DEBUG,
                ],
                'twitterOAuth' => [
                    $_ENV['TWITTER_OAUTH_TOKEN'],
                    $_ENV['TWITTER_OAUTH_TOKEN_SECRET'],
                    $_ENV['TWITTER_ACCESS_TOKEN'],
                    $_ENV['TWITTER_ACCESS_TOKEN_SECRET']
                ]
            ]);
        }
    ]);
};
