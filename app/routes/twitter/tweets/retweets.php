<?php

declare(strict_types=1);

use Slim\Interfaces\RouteCollectorProxyInterface as Group;

use App\Application\Actions\Twitter\Tweets\Retweets\GetRetweetsByTweetIdAction;
use App\Application\Actions\Twitter\Tweets\Retweets\CreateRetweetAction;
use App\Application\Actions\Twitter\Tweets\Retweets\DeleteRetweetAction;



$group->get('/tweets/{id}/retweeted_by', GetRetweetsByTweetIdAction::class);

$group->group('/users/{id}', function(Group $id) {

  $id->post('/retweets', CreateRetweetAction::class);

  $id->delete('/retweets/{source_tweet_id}', DeleteRetweetAction::class);
});