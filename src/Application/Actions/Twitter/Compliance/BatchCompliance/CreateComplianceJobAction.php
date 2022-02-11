<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Compliance\BatchCompliance;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Compliance\ComplianceAction;

class CreateComplianceJobAction extends ComplianceAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $job_id = $this->args['job_id'];

    $options = [
      'body' => [
        'type',
        'name',
        'resumable'
      ]
    ];

    // Store valid query parameters in $params array
    $params = $this->sortParams($options);

    // Derive URI from query
    $uri = 'compliance' . '/' . 'jobs';

    /**
     * Returns a list of user who purchased a ticket to the requested Space.
     * You must authenticate the request using the Access Token of the creator of the requested Space.
     */
    $response = $this->twitterOAuth->post($uri, $params, true);

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {

      // TODO: Create List object

      // Return response to user
      return $this
        ->respondWithData($response)
        ->withHeader('Content-Type', 'application/json');
    }
  }
}