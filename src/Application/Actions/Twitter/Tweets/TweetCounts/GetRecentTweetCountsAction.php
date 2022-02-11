<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\TweetCounts;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;
use App\Domain\Twitter\Model\Metadata;
// Models
use App\Domain\Twitter\Model\Tweet;
use App\Domain\Twitter\Model\TweetList;

class GetRecentTweetCountsAction extends TweetsAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {

    // Define list of known query options for this action
    $options = [
      'query' => [
        'end_time',
        'granularity',
        'since_id',
        'start_time',
        'until_id'
      ]
    ];

    $params = $this->sortParams($options);

    $uri = 'tweets' . '/' . 'counts' . '/' . 'recent';

    $response = $this->twitterOAuth->get($uri, $params);

    $status = $this->twitterOAuth->getLastHttpCode();

    if ($this->exceptionHandler->handleErrors($status, $response)) {

      // Initialise empty Tweets[] array
      $tweets = array();
      
      if(property_exists($response, 'data')) {
        // Iterate over results
        for($i=0;$i<COUNT($response->data);$i++) {
    
          $tweet = new Tweet();
          $tweet->setByJson($response->data[$i]);
    
          // Append Tweet object to $tweets array
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