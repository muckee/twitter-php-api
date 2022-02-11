<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\Timelines;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

// Models
use App\Domain\Twitter\Model\Metadata;
use App\Domain\Twitter\Model\Tweet;
use App\Domain\Twitter\Model\TweetList;

class GetUserMentionsTimelineAction extends TweetsAction
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

      $uri = 'users' . '/' . $user_id . '/' . 'mentions';

      // Delete tweet by ID
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
        return $this->respondWithData(
                      $payload
                    )->withHeader(
                      'Content-Type', 'application/json'
                    );
      };
    }
}