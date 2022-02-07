<?php

declare(strict_types=1);

namespace App\Infrastructure\Remote\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;

use App\Domain\Twitter\TwitterRepository;
use App\Domain\Twitter\TwitterException\TwitterException;

class RemoteTwitterRepository implements TwitterRepository
{

  protected TwitterOAuth $twitterOAuth;

  /**
   * @param TwitterOAuth $twitterOAuth
   */
  public function __construct(
    TwitterOAuth $twitterOAuth
  ) {
    $this->twitterOAuth = $twitterOAuth;
    $this->twitterOAuth->setApiVersion('2');
  }

  /**
   * {@inheritdoc}
   */
  public function getTweets(array $params): array
  {

    // Get tweet
    $tweets = $this->twitterOAuth->get(
      'tweets',
      $params);

    if($this->handleErrors($tweets)) {

      // Initialise empty array to store results
      $results = [];

      // Iterate over resulting tweets
      foreach($tweets->data as $result) {

        // Append tweet text to $results array
        array_push($results, $result->text);
      }

      return $results;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getTweet(string $id, array $params): string
  {
    $uri = 'tweets' . '/' . $id;
    // Get tweet by ID
    $tweet = $this->twitterOAuth->get($uri, $params);

    if ($this->handleErrors($tweet)) {
      return $statuses->data->text;
    };

  }

  /**
   * {@inheritdoc}
   */
  public function createTweet(array $params): string
  {

    // Post new tweet
    $result = $this->twitterOAuth->post('tweets', $params, true);

    if ($this->handleErrors($result)) {
      return json_encode($result);
    };
  }

  /**
   * {@inheritdoc}
   */
  public function deleteTweet(string $id): string
  {
    $uri = 'tweets' . '/' . $id;

    // Delete tweet by ID
    $result = $this->twitterOAuth->delete(
      $uri
    );

    if ($this->handleErrors($result)) {

      // Convert bool to string
      return $result->data->deleted ? 'true' : 'false';

    };
  }

  /**
   * {@inheritdoc}
   */
  public function getUserTimeline(string $id, array $params): string
  {
    $uri = 'users' . '/' . $id . '/' . 'tweets';

    // Delete tweet by ID
    $tweets = $this->twitterOAuth->get(
      $uri,
      $params
    );

    if ($this->handleErrors($tweets)) {
      // Convert bool to string
      return json_encode($tweets);
    };
  }

  /**
   * {@inheritdoc}
   */
  public function getUserMentionsTimeline(string $id, array $params): string
  {
    $uri = 'users' . '/' . $id . '/' . 'mentions';

    // Delete tweet by ID
    $tweets = $this->twitterOAuth->get(
      $uri,
      $params
    );

    if ($this->handleErrors($tweets)) {
      // Convert bool to string
      return json_encode($tweets);
    };
  }

  /**
   * {@inheritdoc}
   */
  public function searchRecentTweets(array $params): string
  {
    $uri = 'tweets' . '/' . 'search' . '/' . 'recent';
  
    // Search recent tweets
    $tweets = $this->twitterOAuth->get($uri, $params);
  
    if ($this->handleErrors($tweets)) {
      return json_encode($tweets);
    };
  
  }

  /**
   * {@inheritdoc}
   */
  public function updateFilteredStreamRules(array $params): string
  {
  
    $accessToken = $this->twitterOAuth->oauth2(
      'oauth2/token',
      array('grant_type' => 'client_credentials')
    );

    $uri = 'tweets' . '/' . 'search' . '/' . 'stream' . '/' . 'rules';

    $this->twitterOAuth->setBearer($accessToken->access_token);

    // Update filtered stream rules
    $result = $this->twitterOAuth->post($uri, $params, true);
  
    if ($this->handleErrors($result)) {
      return json_encode($result);
    };
  
  }

  /**
   * {@inheritdoc}
   */
  public function getFilteredStreamRules(array $params): string
  {
  
    $accessToken = $this->twitterOAuth->oauth2(
      'oauth2/token',
      array('grant_type' => 'client_credentials')
    );

    $this->twitterOAuth->setBearer($accessToken->access_token);

    $uri = 'tweets' . '/' . 'search' . '/' . 'stream' . '/' . 'rules';

    // Update filtered stream rules
    $result = $this->twitterOAuth->get($uri, $params, true);
  
    if ($this->handleErrors($result)) {
      return json_encode($result);
    };
  
  }

  /**
   * {@inheritdoc}
   */
  public function getFilteredStream(array $params): string
  {
    /**
     * TODO: Periodically check for stream support in abraham/TwitterOAuth
     * library. When stream is supported, remove the following return
     * statement and the API should perform as expected.
     */
    return 'Stream not supported. Contact system administrator.';
  
    $accessToken = $this->twitterOAuth->oauth2(
      'oauth2/token',
      array('grant_type' => 'client_credentials')
    );

    $this->twitterOAuth->setBearer($accessToken->access_token);

    $uri = 'tweets' . '/' . 'search' . '/' . 'stream';

    // Update filtered stream rules
    $result = $this->twitterOAuth->get($uri, $params, true);
  
    if ($this->handleErrors($result)) {
      return json_encode($result);
    };
  
  }

  /**
   * {@inheritdoc}
   */
  public function getRetweetsByUserId(string $id, array $params): string
  {

    $uri = 'tweets' . '/' . $id . '/' . 'retweeted_by';

    // Update filtered stream rules
    $result = $this->twitterOAuth->get($uri, $params);
  
    if ($this->handleErrors($result)) {
      return json_encode($result);
    };
  
  }

  /**
   * {@inheritdoc}
   */
  public function createRetweet(string $id, array $params): string
  {

    $uri = 'users' . '/' . $id . '/' . 'retweets';

    // Update filtered stream rules
    $result = $this->twitterOAuth->post($uri, $params, true);
  
    if ($this->handleErrors($result)) {
      return json_encode($result);
    };
  
  }

  /**
   * {@inheritdoc}
   */
  public function deleteRetweet(string $id, string $sourceTweetId): string
  {

    $uri = 'users' . '/' . $id . '/' . 'retweets' . '/' . $sourceTweetId;

    // Update filtered stream rules
    $result = $this->twitterOAuth->delete($uri);
  
    if ($this->handleErrors($result)) {
      return json_encode($result);
    };
  
  }

  /**
   * {@inheritdoc}
   */
  public function getLikingUsers(string $id, array $params): string
  {

    $uri = 'tweets' . '/' . $id . '/' . 'liking_users';

    // Update filtered stream rules
    $result = $this->twitterOAuth->get($uri, $params);
  
    if ($this->handleErrors($result)) {
      return json_encode($result);
    };
  
  }

  /**
   * {@inheritdoc}
   */
  public function getLikedTweets(string $id, array $params): string
  {

    $uri = 'users' . '/' . $id . '/' . 'liked_tweets';

    // Update filtered stream rules
    $result = $this->twitterOAuth->get($uri, $params);
  
    if ($this->handleErrors($result)) {
      return json_encode($result);
    };
  
  }

  /**
   * {@inheritdoc}
   */
  public function likeTweet(string $id, array $params): string
  {

    $uri = 'users' . '/' . $id . '/' . 'likes';

    // Update filtered stream rules
    $result = $this->twitterOAuth->post($uri, $params, true);

    if ($this->handleErrors($result)) {
      return json_encode($result);
    };
  
  }

  /**
   * {@inheritdoc}
   */
  public function deleteLikedTweet(string $id, string $tweetId): string
  {

    $uri = 'users' . '/' . $id . '/' . 'likes' . '/' . $tweetId;

    // Update filtered stream rules
    $result = $this->twitterOAuth->delete($uri);

    if ($this->handleErrors($result)) {
      return json_encode($result->data);
    };
  
  }

  /**
   * {@inheritdoc}
   */
  public function hideReply(string $tweetId, array $params): string
  {

    // TODO: Fix 'unauthorised' issue
    return 'This endpoint is not currently supported. Please contact the system administrator.';

    $uri = 'tweets' . '/' . $tweetId . '/' . 'hidden';

    $result = $this->twitterOAuth->put($uri, $params, true);

    if ($this->handleErrors($result)) {
      return json_encode($result);
    };
  
  }

  /**
   * Returns true if $statuses does not contain errors
   * @return bool
   */
  private function handleErrors($response): bool {
    // TODO: Cleanup/refactor handleErrors into new class once all errors are handled

    // Check if last HTTP request was successful
    if (
      $this->twitterOAuth->getLastHttpCode() == (200 || 201)
    ) {

      // Check for known errors
      if (property_exists($response, 'errors')) {

        $error = $response->errors[0];

        $msg = $this->getErrMsg($error);

        throw new TwitterException($msg);

      } else if (property_exists($response, 'status')) {

        if($response->status === (200 || 201)) {

          return true;

        } else {

          $msg = $this->getErrMsg($response);

          throw new TwitterException($msg);
        }
      }

      return true;
  
    // If last HTTP request was unsuccessful
    } else {

      $msg = 'An unknown error occured.';

      // TODO: Implement logging for unknown errors
      // TODO: Hide result from user in production

      // Check for known errors
      if (property_exists($response, 'errors')) {

        $error = $response->errors[0];

        $msg = $this->getErrMsg($error);
      }

      throw new TwitterException($msg);
    }
  }

  /**
   * Attempts to retrieve message from error
   * @return string
   */
  private function getErrMsg($error): string {

    // Check if error contains detail
    if(property_exists($error, 'detail')) {

      return $error->detail;
    }

    // Check if error has message
    if(property_exists($error, 'message')) {

      return $error->message;
    }

    // Check if error has title
    if(property_exists($error, 'title')) {

      // Create error message using title
      $msg = 'A \'' . $error->title . '\' error occured.';

      /**
       * The 'title' property of a twitter error object is not verbose.
       * Here we check if the error has a type, which is a reference
       * to relevant twitter documentation, in order to provide greater
       * context to the user.
       */
      if(property_exists($error, 'type')) {

        $msg = $msg . ' More info available at: ' . $error->type;
      }

      return $msg;
    }

    return 'An unknown error occured.';
  }
}