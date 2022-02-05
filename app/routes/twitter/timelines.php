<?php

declare(strict_types=1);

use Slim\Interfaces\RouteCollectorProxyInterface as Group;

use App\Application\Actions\Twitter\Timelines\GetUserTimelineAction;
use App\Application\Actions\Twitter\Timelines\GetUserMentionsTimelineAction;

// Get a list of tweets based on a CSV string of tweet IDs
$group->group('/users/{id}', function (Group $usersId) {

  $usersId->get('/tweets',
    GetUserTimelineAction::class
  );

  $usersId->get('/mentions',
    GetUserMentionsTimelineAction::class
  );

});