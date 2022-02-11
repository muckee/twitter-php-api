<?php

declare(strict_types=1);

use Slim\Interfaces\RouteCollectorProxyInterface as Group;

use App\Application\Actions\Twitter\Spaces\SpacesLookup\GetSpacesByIdAction;
use App\Application\Actions\Twitter\Spaces\SpacesLookup\GetSpaceByIdAction;
use App\Application\Actions\Twitter\Spaces\SpacesLookup\GetSpaceTweetsByIdAction;
use App\Application\Actions\Twitter\Spaces\SpacesLookup\GetSpaceBuyersByIdAction;
use App\Application\Actions\Twitter\Spaces\SpacesLookup\GetSpacesByCreatorIdAction;

use App\Application\Actions\Twitter\Spaces\SearchSpaces\SearchSpaces;

$group->get('/spaces', GetSpacesByIdAction::class);

$group->group('/spaces', function (Group $spaces) {

  $spaces->get('/search', SearchSpaces::class);

  $spaces->get('/by/creator_ids', GetSpacesByCreatorIdAction::class);

  $spaces->get('/{space_id}', GetSpaceByIdAction::class);

  $spaces->group('/{space_id}', function (Group $space) {

    $space->get('/tweets', GetSpaceTweetsByIdAction::class);

    $space->get('/buyers', GetSpaceBuyersByIdAction::class);
  });
});