<?php

declare(strict_types=1);

use App\Domain\Twitter\TwitterRepository;
use App\Infrastructure\Remote\Twitter\RemoteTwitterRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        TwitterRepository::class => \DI\autowire(RemoteTwitterRepository::class),
    ]);
};
