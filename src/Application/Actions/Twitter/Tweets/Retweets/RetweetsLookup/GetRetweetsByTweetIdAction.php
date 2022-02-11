<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\Retweets\RetweetsLookup;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

use App\Domain\Twitter\Model\User;
use App\Domain\Twitter\Model\Metadata;
use App\Domain\Twitter\Model\UserList;

class GetRetweetsByTweetIdAction extends TweetsAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $tweet_id = $this->args['tweet_id'];

    $options = [
      'query' => [
        'expansions',
        'max_results',
        'media.fields',
        'pagination_token',
        'place.fields',
        'poll.fields',
        'tweet.fields',
        'user.fields'
      ]
    ];

    $params = $this->sortParams($options);

    $uri = 'tweets' . '/' . $tweet_id . '/' . 'retweeted_by';

    // Update filtered stream rules
    $response = $this->twitterOAuth->get( $uri, $params );

    $status = $this->twitterOAuth->getLastHttpCode();
    if ( $this->exceptionHandler->handleErrors( $status, $response ) ) {
  
      // Initialise empty array to store list of users
      $users = array();

      if(property_exists($response, 'data')) {

        // Iterate over response data
        for( $i=0; $i<COUNT( $response->data ); $i++ ) {
    
          $user = new User();
          $user->setByJson($response->data[$i]);
    
          // Append new User object to $users array
          $users[] = $user;
        }
      }
  
      $meta = new Metadata();
      $meta->setByJson($response->meta);
    
      $payload = new UserList($users, $meta);

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    };
  }
}