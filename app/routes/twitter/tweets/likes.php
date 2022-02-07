<?php

declare(strict_types=1);

use Slim\Interfaces\RouteCollectorProxyInterface as Group;

use App\Application\Actions\Twitter\Tweets\Likes\GetLikingUsersAction;
use App\Application\Actions\Twitter\Tweets\Likes\GetLikedTweetsAction;
use App\Application\Actions\Twitter\Tweets\Likes\LikeTweetAction;
use App\Application\Actions\Twitter\Tweets\Likes\DeleteLikedTweetAction;

$group->get('/tweets/{id}/liking_users', GetLikingUsersAction::class);

$group->group('/users/{id}', function(Group $id) {

  $id->get('/liked_tweets', GetLikedTweetsAction::class);

  $id->post('/likes', LikeTweetAction::class);

  $id->delete('/likes/{tweet_id}', DeleteLikedTweetAction::class);

});