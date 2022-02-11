<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\Likes\LikesLookup;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

use App\Domain\Twitter\Model\User;
use App\Domain\Twitter\Model\Metadata;
use App\Domain\Twitter\Model\UserList;

class GetLikingUsersAction extends TweetsAction
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

    $uri = 'tweets' . '/' . $tweet_id . '/' . 'liking_users';

    // Update filtered stream rules
    $response = $this->twitterOAuth->get( $uri, $params );

    $status = $this->twitterOAuth->getLastHttpCode();

    if ( $this->exceptionHandler->handleErrors( $status, $response ) ) {
  
      // Create list of User objects from response
      $users = array();
  
      if(property_exists($response, 'data')) {
        for( $i=0; $i<COUNT( $response->data ); $i++ ) {
    
          $user = new User();
          $user->setByJson($response->data[$i]);
    
          $users[] = $user;
        }
      }
  
      $meta = new Metadata();
      $meta->setByJson($response->meta);
  
      $payload = new UserList( $users, $meta );

      // Return data to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    };
  }
}