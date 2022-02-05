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
  public function getTweets(
    $params
  ): array {

    // Get tweet
    $statuses = $this->twitterOAuth->get(
      'tweets',
      $params);

    if($this->handleErrors($statuses)) {

      // Initialise empty array to store results
      $results = [];

      // Iterate over resulting tweets
      foreach($statuses->data as $result) {

        // Append tweet text to $results array
        array_push($results, $result->text);
      }

      return $results;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getTweet($id, $params): string
  {
    $uri = 'tweets' . '/' . $id;
    // Get tweet by ID
    $statuses = $this->twitterOAuth->get($uri, $params);

    if ($this->handleErrors($statuses)) {
      return $statuses->data->text;
    };

  }

  /**
   * {@inheritdoc}
   */
  public function createTweet($params): string
  {

    // Post new tweet
    $statuses = $this->twitterOAuth->post('tweets', $params, true);

    if ($this->handleErrors($statuses)) {
      return json_encode($statuses);
    };
  }

  /**
   * {@inheritdoc}
   */
  public function deleteTweet($id): string
  {
    $uri = 'tweets' . '/' . $id;

    // Delete tweet by ID
    $statuses = $this->twitterOAuth->delete(
      $uri
    );

    if ($this->handleErrors($statuses)) {

      // Convert bool to string
      return $statuses->data->deleted ? 'true' : 'false';

    };
  }

  /**
   * {@inheritdoc}
   */
  public function getUserTimeline($id, $params): string
  {
    $uri = 'users' . '/' . $id . '/' . 'tweets';

    // Delete tweet by ID
    $statuses = $this->twitterOAuth->get(
      $uri,
      $params
    );

    if ($this->handleErrors($statuses)) {
      // Convert bool to string
      return json_encode($statuses);
    };
  }

  /**
   * {@inheritdoc}
   */
  public function getUserMentionsTimeline($id, $params): string
  {
    // TODO: Refactor getUserTimeline and getUserMentionsTimeline into one function
    $uri = 'users' . '/' . $id . '/' . 'mentions';

    // Delete tweet by ID
    $statuses = $this->twitterOAuth->get(
      $uri,
      $params
    );

    if ($this->handleErrors($statuses)) {
      // Convert bool to string
      return json_encode($statuses);
    };
  }

  protected function handleErrors($statuses) {

    // Check if last HTTP request was successful
    if (
      $this->twitterOAuth->getLastHttpCode() == (200 || 201)
    ) {

      // Check for known errors
      if (property_exists($statuses, 'errors')) {

        $error = $statuses->errors[0];

        $msg = $this->getErrMsg($error);

        throw new TwitterException($msg);
      }

      return true;
  
    // If last HTTP request was unsuccessful
    } else {

      $msg = 'An unknown error occured.';

      // TODO: Implement logging for unknown errors
      // TODO: Hide result from user in production

      // Check for known errors
      if (property_exists($statuses, 'errors')) {

        $error = $statuses->errors[0];

        $msg = $this->getErrMsg($error);
      }
      throw new TwitterException($msg);

    }
  }

  protected function getErrMsg($error) {

    if(property_exists($error, 'detail')) {

      return $error->detail;
    }

    if(property_exists($error, 'message')) {

      return $error->message;
    }

    return 'An unknown error occured.';
  }
}