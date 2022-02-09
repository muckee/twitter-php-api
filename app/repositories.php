<?php

declare(strict_types=1);

use DI\ContainerBuilder;

use App\Domain\Twitter\TwitterRepository\TweetsRepository;
use App\Infrastructure\Remote\Twitter\RemoteTwitterRepository\RemoteTweetsRepository;

use App\Domain\Twitter\TwitterRepository\UsersRepository;
use App\Infrastructure\Remote\Twitter\RemoteTwitterRepository\RemoteUsersRepository;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        TwitterRepository::class => \DI\autowire(RemoteTwitterRepository::class),
        TweetsRepository::class => \DI\autowire(RemoteTweetsRepository::class),
        UsersRepository::class => \DI\autowire(RemoteUsersRepository::class),
    ]);
};
