<?php

declare(strict_types=1);

use Slim\Interfaces\RouteCollectorProxyInterface as Group;

use App\Application\Actions\Twitter\Tweets\Timelines\GetUserTimelineAction;
use App\Application\Actions\Twitter\Tweets\Timelines\GetUserMentionsTimelineAction;

use App\Application\Actions\Twitter\Tweets\Retweets\CreateRetweetAction;
use App\Application\Actions\Twitter\Tweets\Retweets\DeleteRetweetAction;

use App\Application\Actions\Twitter\Tweets\Likes\GetLikedTweetsAction;
use App\Application\Actions\Twitter\Tweets\Likes\LikeTweetAction;
use App\Application\Actions\Twitter\Tweets\Likes\DeleteLikedTweetAction;

use App\Application\Actions\Twitter\Users\UsersLookup\GetUsersByIdAction;
use App\Application\Actions\Twitter\Users\UsersLookup\GetUserByIdAction;
use App\Application\Actions\Twitter\Users\UsersLookup\GetUsersByUsernameAction;
use App\Application\Actions\Twitter\Users\UsersLookup\GetUserByUsernameAction;
use App\Application\Actions\Twitter\Users\UsersLookup\GetAuthorizedUserAction;

$group->get('/users', GetUsersByIdAction::class);

$group->group('/users', function (Group $users) {

  $users->get('/me', GetAuthorizedUserAction::class);

  $users->get('/by', GetUsersByUsernameAction::class);

  $users->get('/by/username/{username}', GetUserByUsernameAction::class);

  $users->get('/{user_id}', GetUserByIdAction::class);

  // Get a list of tweets based on a CSV string of tweet IDs
  $users->group('/{user_id}', function (Group $user) {

    /**
     * Returns most recent tweets composed by a specified user ID
     */
    $user->get('/tweets', GetUserTimelineAction::class);

    /**
     * Returns most recent tweets mentioning a specified user ID
     */
    $user->get('/mentions', GetUserMentionsTimelineAction::class);

    /**
     * Allows a user ID to Retweet a Tweet
     */
    $user->post('/retweets', CreateRetweetAction::class);

    /**
     * Allows a user ID to undo a Retweet
     */
    $user->delete('/retweets/{source_tweet_id}', DeleteRetweetAction::class);

    $user->get('/liked_tweets', GetLikedTweetsAction::class);

    $user->post('/likes', LikeTweetAction::class);

    $user->delete('/likes/{tweet_id}', DeleteLikedTweetAction::class);
  });
});