<?php

declare(strict_types=1);

use Slim\Interfaces\RouteCollectorProxyInterface as Group;

use App\Application\Actions\Twitter\Tweets\HideReplies\HideReplyAction;

$group->put('/tweets/{tweet_id}/hidden', HideReplyAction::class);