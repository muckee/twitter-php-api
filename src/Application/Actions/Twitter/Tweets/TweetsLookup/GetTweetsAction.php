<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\TweetsLookup;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

// Models
use App\Domain\Twitter\Model\Metadata;
use App\Domain\Twitter\Model\Tweet;
use App\Domain\Twitter\Model\TweetList;

class GetTweetsAction extends TweetsAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    // Define list of known query options for this action
    $options = [
      'query' => [
        'ids',
        'expansions',
        'media.fields',
        'place.fields',
        'poll.fields',
        'tweet.fields',
        'user.fields'
      ]
    ];

    $params = $this->sortParams($options);

    // Get tweet
    $response = $this->twitterOAuth->get(
      'tweets',
      $params);

    $status = $this->twitterOAuth->getLastHttpCode();

    if($this->exceptionHandler->handleErrors($status, $response)) {

      // Initialise empty array to store results
      $tweets = array();

      if(property_exists($response, 'data')) {

        // Iterate over resulting tweets
        foreach($response->data as $result) {
  
          $tweet = new Tweet();
          $tweet->setByJson($result);
  
          $tweets[] = $tweet;
        }
      }
  
      $meta = new Metadata();

      if(property_exists($response, 'meta')) {
        $meta->setByJson($response->meta);
      }

      $payload = new TweetList($tweets, $meta);

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    }
  }
}