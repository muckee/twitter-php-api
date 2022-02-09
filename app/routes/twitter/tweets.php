<?php

declare(strict_types=1);

use Slim\Interfaces\RouteCollectorProxyInterface as Group;

use App\Application\Actions\Twitter\Tweets\TweetsLookup\GetTweetAction;
use App\Application\Actions\Twitter\Tweets\TweetsLookup\GetTweetsAction;

use App\Application\Actions\Twitter\Tweets\ManageTweets\CreateTweetAction;
use App\Application\Actions\Twitter\Tweets\ManageTweets\DeleteTweetAction;

use App\Application\Actions\Twitter\Tweets\SearchTweets\SearchRecentTweetsAction;

use App\Application\Actions\Twitter\Tweets\TweetCounts\GetRecentTweetCountsAction;

use App\Application\Actions\Twitter\Tweets\FilteredStream\UpdateFilteredStreamRulesAction;
use App\Application\Actions\Twitter\Tweets\FilteredStream\GetFilteredStreamRulesAction;
use App\Application\Actions\Twitter\Tweets\FilteredStream\GetFilteredStreamAction;

use App\Application\Actions\Twitter\Tweets\Retweets\RetweetsLookup\GetRetweetsByTweetIdAction;

use App\Application\Actions\Twitter\Tweets\Likes\LikesLookup\GetLikingUsersAction;

use App\Application\Actions\Twitter\Tweets\HideReplies\HideReplyAction;

/**
 * TODO: At the time of writing, Twitter API documentation
 * does not contain an API reference for 'Volume streams' endpoints.
 * Periodically check documentation for updates.
 * Once implemented, create relevant actions/repositories.
 */
  
/**
 * Retrieve a list of tweets by ID
 */
$group->get('/tweets', GetTweetsAction::class);

/**
 * Publish a new tweet
 */
$group->post('/tweets', CreateTweetAction::class);

$group->group('/tweets', function (Group $tweets) {

  /**
   * Receive a count of Tweets that match a query in the last 7 days
   * TODO: Add support for '/tweets/counts/all' in case of future academic use
   */
  $tweets->get('/counts/recent',
    GetRecentTweetCountsAction::class
  );
  
  /**
   * Retrieve a single tweet by ID
   */
  $tweets->get('/{tweet_id}',
    GetTweetAction::class
  );

  /**
   * Delete a tweet with specified ID
   */
  $tweets->delete('/{tweet_id}',
    DeleteTweetAction::class
  );
  
  $tweets->group('/{tweet_id}', function (Group $tweet) {

    /**
     * Retrieve list of users who have Retweeted a Tweet
     */
    $tweet->get('/retweeted_by',
      GetRetweetsByTweetIdAction::class
    );

    /**
     * Retrieve list of users who have Liked a Tweet
     */
    $tweet->get('/liking_users',
      GetLikingUsersAction::class
    );
  

    /**
     * Hide/unhide a tweet
     */
    $tweet->put('/hidden',
      HideReplyAction::class
    );
  });

  $tweets->group('/search', function (Group $search) {

    /**
     * Search for Tweets published in the last 7 days
     * TODO: Add support for /tweets/search/all in case of future academic use
     */
    $search->get('/recent',
      SearchRecentTweetsAction::class
    );
  
    /**
     * Connect to the stream
     */
    $search->get('/stream', 
      GetFilteredStreamAction::class
    );
  
    $search->group('/stream', function (Group $stream) {
  
      /**
       * Retrieve your stream's rules
       */
      $stream->get('/rules', 
        GetFilteredStreamRulesAction::class
      );
  
      /**
       * Add or delete rules from your stream
       */
      $stream->post('/rules', 
        UpdateFilteredStreamRulesAction::class
      );
    });
  });

});