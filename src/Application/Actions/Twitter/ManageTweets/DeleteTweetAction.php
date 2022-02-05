<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\ManageTweets;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\TwitterAction;

class DeleteTweetAction extends TwitterAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
      $id = $this->args['id'];

      $payload = $this->twitterRepository->deleteTweet($id);

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    }
}