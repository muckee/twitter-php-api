<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\Timelines;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

// Models
use App\Domain\Twitter\Model\Metadata;
use App\Domain\Twitter\Model\Tweet;
use App\Domain\Twitter\Model\TweetList;

class GetUserTimelineAction extends TweetsAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {

    // Retrieve ID argument from request
    $user_id = $this->args['user_id'];

      // Define list of known query options for this action
    $options = [
      'query' => [
        'end_time',
        'exclude',
        'expansions',
        'max_results',
        'media.fields',
        'pagination_token',
        'place.fields',
        'poll.fields',
        'since_id',
        'start_time',
        'tweet.fields',
        'until_id',
        'user.fields'
      ]
    ];

    $params = $this->sortParams($options);

    $uri = 'users' . '/' . $user_id . '/' . 'tweets';

    // Retrieve user timeline from Twitter API
    $response = $this->twitterOAuth->get(
      $uri,
      $params
    );

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
      // TODO: Create models for all JSON responses in order to properly declare types
      return $this->respondWithData(
                    $payload
                  )->withHeader(
                    'Content-Type', 'application/json'
                  );
    };
  }
}