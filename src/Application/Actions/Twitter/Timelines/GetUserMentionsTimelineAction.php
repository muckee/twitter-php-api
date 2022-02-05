<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Timelines;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\TwitterAction;

class GetUserMentionsTimelineAction extends TwitterAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {

       // Define list of known query options for this action
      $options = [
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
      ];

      $params = $this->sortQueryParams($options);

      // Retrieve ID argument from request
      $id = $this->args['id'];

      // Retrieve user timeline from Twitter API
      $payload = $this->twitterRepository->getUserMentionsTimeline(
        $id,
        $params
      );

      // Return response to user
      // TODO: Create models for all JSON responses in order to properly declare types
      return $this->respondWithData(
                    json_decode($payload)
                  )->withHeader(
                    'Content-Type', 'application/json'
                  );
    }
}