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


use App\Application\Handlers\TwitterExceptionHandler;

use App\Domain\Twitter\TwitterRepository\TweetsRepository;
use App\Infrastructure\Remote\RemoteTwitterRepository\RemoteTweetsRepository;

use App\Domain\Twitter\TwitterRepository\UsersRepository;
use App\Infrastructure\Remote\RemoteTwitterRepository\RemoteUsersRepository;

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
        TwitterOAuth::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $twitterOAuthSettings = $settings->get('twitterOAuth');

            return new TwitterOAuth(...$twitterOAuthSettings);
        },
        'twitterExceptionHandler' => function () {

            return new TwitterExceptionHandler();
        },
        RemoteTwitterRepository::class => function (ContainerInterface $c) {
            return new TweetsRepository(
                $c->get('twitterOAuth'),
                $c->get('twitterExceptionHandler')
            );
        }
    ]);
};
