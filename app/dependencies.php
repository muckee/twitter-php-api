<?php

declare(strict_types=1);

use Abraham\TwitterOAuth\TwitterOAuth;

use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $loggerSettings = $settings->get('logger');
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        'twitterOAuth' => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $twitterOAuthSettings = $settings->get('twitterOAuth');

            return new TwitterOAuth(...$twitterOAuthSettings);
        },
        TwitterOAuth::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $twitterOAuthSettings = $settings->get('twitterOAuth');

            return new TwitterOAuth(...$twitterOAuthSettings);
        },
        TwitterAction::class => function (ContainerInterface $c) {
            return new TwitterAction($c->get('twitterOAuth'));
        },
        RemoteTwitterRepository::class => function (ContainerInterface $c) {
            return new RemoteTwitterRepository($c->get('twitterOAuth'));
        }
    ]);
};
