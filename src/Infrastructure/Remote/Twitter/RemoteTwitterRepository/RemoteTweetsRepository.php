<?php

declare(strict_types=1);

namespace App\Infrastructure\Remote\Twitter\RemoteTwitterRepository;

use App\Domain\Twitter\TwitterRepository\TweetsRepository;

use App\Infrastructure\Remote\Twitter\RemoteTwitterRepository;

// Models
use App\Domain\Twitter\Tweet;
use App\Domain\Twitter\User;
use App\Domain\Twitter\TwitterList;
use App\Domain\Twitter\FilteredStream\FilteredStreamRule;
use App\Domain\Twitter\FilteredStream\FilteredStreamRuleSet;
use App\Domain\Twitter\Metadata;

class RemoteTweetsRepository extends RemoteTwitterRepository
                             implements TweetsRepository
{

  /**
   * {@inheritdoc}
   */
  public function getTweets(array $params): array
  {

    // Get tweet
    $tweets = $this->twitterOAuth->get(
      'tweets',
      $params);

    if($this->exceptionHandler->handleErrors($this->twitterOAuth->getLastHttpCode(), $tweets)) {

      // Initialise empty array to store results
      $results = [];

      // Iterate over resulting tweets
      foreach($tweets->data as $result) {

        $id = $result->id;
        $text = $result->text;
  
        $tweet = new Tweet($id, $text);

        // Append tweet text to $results array
        array_push($results, $tweet);
      }

      return $results;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getTweet(string $id, array $params): Tweet
  {
    $uri = 'tweets' . '/' . $id;
    // Get tweet by ID
    $result = $this->twitterOAuth->get($uri, $params);

    if ($this->exceptionHandler->handleErrors($this->twitterOAuth->getLastHttpCode(), $result)) {

      $id = $result->data->id;
      $text = $result->data->text;

      $tweet = new Tweet($id, $text);

      return $tweet;
    };

  }

  /**
   * {@inheritdoc}
   */
  public function createTweet(array $params): Tweet
  {

    // Post new tweet
    $result = $this->twitterOAuth->post('tweets', $params, true);

    if ($this->exceptionHandler->handleErrors($this->twitterOAuth->getLastHttpCode(), $result)) {

      $id = $result->data->id;
      $text = $result->data->text;

      $tweet = new Tweet($id, $text);

      return $tweet;
    };
  }

  /**
   * {@inheritdoc}
   */
  public function deleteTweet(string $id): string
  {
    $uri = 'tweets' . '/' . $id;

    // Delete tweet by ID
    $result = $this->twitterOAuth->delete($uri);

    if ($this->exceptionHandler->handleErrors($result)) {

      // Return string derived from bool value
      return $result->data->deleted ? 'true' : 'false';

    };
  }

  /**
   * {@inheritdoc}
   */
  public function getUserTimeline(string $id, array $params): array
  {
    $uri = 'users' . '/' . $id . '/' . 'tweets';

    // Delete tweet by ID
    $result = $this->twitterOAuth->get(
      $uri,
      $params
    );

    if ($this->exceptionHandler->handleErrors($this->twitterOAuth->getLastHttpCode(), $result)) {
      // Initialise empty Tweets[] array
      $tweets = array();
      
      // Iterate over results
      for($i=0;$i<COUNT($result->data);$i++) {

        // Create new Tweet object from each result
        $id = $result->data[$i]->id;
        $text = $result->data[$i]->text;
        $tweet = new Tweet($id, $text);

        // Append Tweet object to $tweets array
        $tweets[] = $tweet;
      }
      // Convert bool to string
      return $tweets;
    };
  }

  /**
   * {@inheritdoc}
   */
  public function getUserMentionsTimeline(string $id, array $params): array
  {
    $uri = 'users' . '/' . $id . '/' . 'mentions';

    // Delete tweet by ID
    $result = $this->twitterOAuth->get(
      $uri,
      $params
    );

    if ($this->exceptionHandler->handleErrors($this->twitterOAuth->getLastHttpCode(), $result)) {
      // Initialise empty Tweets[] array
      $tweets = array();
      
      // Iterate over results
      for($i=0;$i<COUNT($result->data);$i++) {

        // Create new Tweet object from each result
        $id = $result->data[$i]->id;
        $text = $result->data[$i]->text;
        $tweet = new Tweet($id, $text);

        // Append Tweet object to $tweets array
        $tweets[] = $tweet;
      }
      // Convert bool to string
      return $tweets;
    };
  }

  /**
   * {@inheritdoc}
   */
  public function searchRecentTweets(array $params): array
  {
    $uri = 'tweets' . '/' . 'search' . '/' . 'recent';
  
    // Search recent tweets
    $result = $this->twitterOAuth->get($uri, $params);
  
    if ($this->exceptionHandler->handleErrors($this->twitterOAuth->getLastHttpCode(), $result)) {
      // Initialise empty Tweets[] array
      $tweets = array();
      
      // Iterate over results
      for($i=0;$i<COUNT($result->data);$i++) {

        // Create new Tweet object from each result
        $id = $result->data[$i]->id;
        $text = $result->data[$i]->text;
        $tweet = new Tweet($id, $text);

        // Append Tweet object to $tweets array
        $tweets[] = $tweet;
      }
      // Convert bool to string
      return $tweets;
    };
  
  }

  /**
   * {@inheritdoc}
   */
  public function updateFilteredStreamRules(
    array $params
  ): FilteredStreamRuleSet {
  
    $accessToken = $this->twitterOAuth->oauth2(
      'oauth2/token',
      array('grant_type' => 'client_credentials')
    );

    $uri = 'tweets' . '/' . 'search' . '/' . 'stream' . '/' . 'rules';

    $this->twitterOAuth->setBearer( $accessToken->access_token );

    // Update filtered stream rules
    $result = $this->twitterOAuth->post( $uri, $params, true );
  
    if ($this->exceptionHandler->handleErrors( $this->twitterOAuth->getLastHttpCode(), $result )) {

      // Initialise empty array to store list of existing rules
      $rules = array();

      $summary = new Metadata();
      $summary->setSent($result->meta->sent);

      $ruleset = new FilteredStreamRuleSet( $rules, $summary );

      /**
       * Check if result contains data.
       * An 'add' POST request to this endpoint should return a result with both 'data' and 'meta' properties.
       * A 'delete' POST request to this endpoint should return a result with only a 'meta' property.
       */
      if( array_key_exists( 'add', $params ) ) {

        $ruleset->setSummaryChanged( $result->meta->summary->created );

        $ruleset->setSummaryNotChanged( $result->meta->summary->not_created );

        $ruleset->setSummaryValid( $result->meta->summary->valid );

        $ruleset->setSummaryInvalid( $result->meta->summary->invalid );

        $this->sortFilteredStreamRules($ruleset, $result->data);

        return $ruleset;
      }

      $ruleset->setSummaryChanged( $result->meta->summary->deleted );

      $ruleset->setSummaryNotChanged( $result->meta->summary->not_deleted );

      // Return rule set to user
      return $ruleset;
    };
  
  }

  /**
   * {@inheritdoc}
   */
  public function getFilteredStreamRules(
    array $params
  ): FilteredStreamRuleSet {
  
    $accessToken = $this->twitterOAuth->oauth2(
      'oauth2/token',
      array( 'grant_type' => 'client_credentials' )
    );

    $this->twitterOAuth->setBearer( $accessToken->access_token );

    $uri = 'tweets' . '/' . 'search' . '/' . 'stream' . '/' . 'rules';

    // Update filtered stream rules
    $result = $this->twitterOAuth->get( $uri, $params, true );
  
    if ($this->exceptionHandler->handleErrors($this->twitterOAuth->getLastHttpCode(), $result)) {

      $summary = new Metadata();
      $summary->setSent($result->meta->sent);
      $summary->setResultCount($result->meta->result_count);

      $ruleset = new FilteredStreamRuleSet(array(), $summary);

      $this->sortFilteredStreamRules($ruleset, $result->data);

      return $ruleset;
    };
  
  }

  /**
   * {@inheritdoc}
   */
  public function getFilteredStream( array $params ): string
  {
    /**
     * TODO: Periodically check for stream support in abraham/TwitterOAuth
     * library. When stream is supported, remove the following return
     * statement and the API should perform as expected.
     */
    return 'Stream is not supported by this API. It must be called directly from your application.';
  
    $accessToken = $this->twitterOAuth->oauth2(
      'oauth2/token',
      array( 'grant_type' => 'client_credentials' )
    );

    $this->twitterOAuth->setBearer( $accessToken->access_token );

    $uri = 'tweets' . '/' . 'search' . '/' . 'stream';

    // Update filtered stream rules
    $result = $this->twitterOAuth->get( $uri, $params, true );
  
    if ( $this->exceptionHandler->handleErrors( $this->twitterOAuth->getLastHttpCode(), $result ) ) {
      // Once TwitterOAuth supports streams, derive appropriate classes from $result
      return json_encode( $result );
    };
  
  }

  /**
   * Create list of FilteredStreamRule objects from JSON array.
   * @param FilteredStreamRuleSet $ruleset
   * @param array $data
   */
  private function sortFilteredStreamRules(
    FilteredStreamRuleSet $ruleset,
    array $data
  ) {
  
    // Iterate over rules found in $data
    for( $i=0; $i<COUNT( $data ); $i++ ) {

      // Check if current iteration contains properties required to create FilteredStreamRule
      $ruleData = $data[$i];
      if(
        property_exists($ruleData, 'id') &&
        property_exists($ruleData, 'value') &&
        property_exists($ruleData,'tag')
      ) {

        // Create new FilteredStreamRule object from rule data
        $rule = new FilteredStreamRule(
          $ruleData->id,
          $ruleData->value,
          $ruleData->tag
        );
  
        // Append FilteredStreamRule to $rules array
        $ruleset->addRule($rule);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getRetweetsByTweetId( string $tweet_id, array $params ): TwitterList
  {

    $uri = 'tweets' . '/' . $tweet_id . '/' . 'retweeted_by';

    // Update filtered stream rules
    $result = $this->twitterOAuth->get( $uri, $params );
  
    if ( $this->exceptionHandler->handleErrors( $this->twitterOAuth->getLastHttpCode(), $result ) ) {

      // Create Metadata object and store result metadata
      $meta = new Metadata();
      $meta->setResultCount($result->meta->result_count);
      $meta->setNextToken($result->meta->next_token);

      // Initialise empty array to store list of users
      $users = array();

      // Iterate over resulting list of users
      for( $i=0; $i<COUNT( $result->data ); $i++ ) {

        $userData = $result->data[$i];

        // Create new User object from user data
        $user = new User(
          $userData->id,
          $userData->name,
          $userData->username
        );

        // Append new User object to $users array
        $users[] = $user;
      }

      return new TwitterList($users, $meta);
      // return json_encode( $result );
    };
  
  }

  /**
   * {@inheritdoc}
   */
  public function createRetweet( string $user_id, array $params ): bool
  {

    $uri = 'users' . '/' . $user_id . '/' . 'retweets';

    // Update filtered stream rules
    $result = $this->twitterOAuth->post( $uri, $params, true );
  
    if ( $this->exceptionHandler->handleErrors( $this->twitterOAuth->getLastHttpCode(), $result ) ) {
      return $result->data->retweeted;
    };
  
  }

  /**
   * {@inheritdoc}
   */
  public function deleteRetweet( string $user_id, string $tweet_id ): bool
  {

    $uri = 'users' . '/' . $user_id . '/' . 'retweets' . '/' . $tweet_id;

    // Update filtered stream rules
    $result = $this->twitterOAuth->delete( $uri );
  
    if ($this->exceptionHandler->handleErrors( $this->twitterOAuth->getLastHttpCode(), $result )) {
      return $result->data->retweeted;
    };
  
  }

  /**
   * {@inheritdoc}
   */
  public function getLikingUsers( string $tweet_id, array $params ): TwitterList
  {

    $uri = 'tweets' . '/' . $tweet_id . '/' . 'liking_users';

    // Update filtered stream rules
    $result = $this->twitterOAuth->get( $uri, $params );
  
    if ( $this->exceptionHandler->handleErrors( $this->twitterOAuth->getLastHttpCode(), $result ) ) {

      // Create Metadata object from result
      $meta = new Metadata();
      $meta->setResultCount($result->meta->result_count);
      $meta->setNextToken($result->meta->next_token);

      // Create list of User objects from result
      $users = array();

      for( $i=0; $i<COUNT( $result->data ); $i++ ) {
        $userData = $result->data[$i];
        $users[] = new User(
          $userData->id,
          $userData->name,
          $userData->username
        );
      }

      return new TwitterList( $users, $meta );
    };
  
  }

  /**
   * {@inheritdoc}
   */
  public function getLikedTweets( string $user_id, array $params ): TwitterList
  {

    $uri = 'users' . '/' . $user_id . '/' . 'liked_tweets';

    // Update filtered stream rules
    $result = $this->twitterOAuth->get( $uri, $params );
  
    if ( $this->exceptionHandler->handleErrors( $this->twitterOAuth->getLastHttpCode(), $result ) ) {

      // Create Metadata object from result
      $meta = new Metadata();
      $meta->setResultCount($result->meta->result_count);
      $meta->setNextToken($result->meta->next_token);

      // Create list of Tweet objects from result
      $tweets = array();

      for( $i=0; $i<COUNT( $result->data ); $i++ ) {
        $tweetData = $result->data[$i];
        $tweets[] = new Tweet(
          $tweetData->id,
          $tweetData->text
        );
      }

      return new TwitterList($tweets, $meta);
    };
  
  }

  /**
   * {@inheritdoc}
   */
  public function likeTweet( string $user_id, array $params ): bool
  {

    $uri = 'users' . '/' . $user_id . '/' . 'likes';

    // Update filtered stream rules
    $result = $this->twitterOAuth->post( $uri, $params, true );

    if ( $this->exceptionHandler->handleErrors( $this->twitterOAuth->getLastHttpCode(), $result ) ) {
      return $result->data->liked;
    };
  
  }

  /**
   * {@inheritdoc}
   */
  public function deleteLikedTweet( string $id, string $tweetId ): bool
  {

    $uri = 'users' . '/' . $id . '/' . 'likes' . '/' . $tweetId;

    // Update filtered stream rules
    $result = $this->twitterOAuth->delete( $uri );

    if ( $this->exceptionHandler->handleErrors( $this->twitterOAuth->getLastHttpCode(), $result ) ) {
      return $result->data->liked;
    };
  
  }

  /**
   * {@inheritdoc}
   */
  public function hideReply( string $tweetId, array $params ): string
  {

    // TODO: Fix 'unauthorised' issue
    return 'This endpoint is not currently supported. Please contact the system administrator.';

    $uri = 'tweets' . '/' . $tweetId . '/' . 'hidden';

    $result = $this->twitterOAuth->put( $uri, $params, true );

    if ( $this->exceptionHandler->handleErrors( $this->twitterOAuth->getLastHttpCode(), $result ) ) {
      return json_encode( $result );
    };
  
  }
}