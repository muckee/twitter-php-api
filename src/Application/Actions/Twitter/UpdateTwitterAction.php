<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter;

use Psr\Http\Message\ResponseInterface as Response;

class UpdateTwitterAction extends TwitterAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        // Retrieve desired tweet text from POST request
        $queryParams = $this->request->getQueryParams();
        $text = $queryParams['text'];

        $payload = $this->twitterRepository->createTweet($text);

        // Return response to user
        return $this
            ->respondWithData(json_encode($payload))
            ->withHeader('Content-Type', 'application/json');
    }
}