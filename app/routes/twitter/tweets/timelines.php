<?php

declare(strict_types=1);

use Slim\Interfaces\RouteCollectorProxyInterface as Group;

use App\Application\Actions\Twitter\Tweets\Timelines\GetUserTimelineAction;
use App\Application\Actions\Twitter\Tweets\Timelines\GetUserMentionsTimelineAction;

// Get a list of tweets based on a CSV string of tweet IDs
$group->group('/users/{id}', function (Group $usersId) {

  /**
   * Returns most recent tweets composed by a specified user ID
   */
  $usersId->get('/tweets', GetUserTimelineAction::class);

  /**
   * Returns most recent tweets mentioning a specified user ID
   */
  $usersId->get('/mentions', GetUserMentionsTimelineAction::class);

});