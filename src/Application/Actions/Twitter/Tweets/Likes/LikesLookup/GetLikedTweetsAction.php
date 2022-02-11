<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\Likes\LikesLookup;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

use App\Domain\Twitter\Model\Tweet;
use App\Domain\Twitter\Model\Metadata;
use App\Domain\Twitter\Model\TweetList;

class GetLikedTweetsAction extends TweetsAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {

    $user_id = $this->args['user_id'];

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

    $uri = 'users' . '/' . $user_id . '/' . 'liked_tweets';

    // Update filtered stream rules
    $response = $this->twitterOAuth->get( $uri, $params );

    $status = $this->twitterOAuth->getLastHttpCode();

    if ( $this->exceptionHandler->handleErrors( $status, $response ) ) {
  
      // Create list of Tweet objects from response
      $tweets = array();
  
      if(property_exists($response, 'data')) {
        for( $i=0; $i<COUNT( $response->data ); $i++ ) {
    
          $tweet = new Tweet();
          $tweet->setByJson($response->data[$i]);
    
          $tweets[] = $tweet;
        }
      }
  
      $meta = new Metadata();
      $meta->setByJson($response->meta);
  
      $payload = new TweetList($tweets, $meta);

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    };
  }
}