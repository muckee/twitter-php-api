<?php

declare(strict_types=1);

use Abraham\TwitterOAuth\TwitterOAuth;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

use App\Application\Settings\SettingsInterface;

use App\Application\Handlers\TwitterQueryHandler;

use App\Infrastructure\Remote\RemoteTwitterRepository;

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
        'twitterQueryHandler' => function (ContainerInterface $c) {
            return new TwitterQueryHandler();
        },
        TwitterOAuth::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $twitterOAuthSettings = $settings->get('twitterOAuth');

            return new TwitterOAuth(...$twitterOAuthSettings);
        },
        TwitterAction::class => function (ContainerInterface $c) {
            $twitterOAuth = $c->get('twitterOAuth');

            return new TwitterAction($twitterOAuth);
        },
        RemoteTwitterRepository::class => function (ContainerInterface $c) {
            return new TwitterRepository($c->get('twitterOAuth'));
        }
    ]);
};
