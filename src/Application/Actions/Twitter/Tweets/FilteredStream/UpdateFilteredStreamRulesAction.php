<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\FilteredStream;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

use App\Domain\Twitter\Model\Metadata;
use App\Domain\Twitter\Model\FilteredStreamRule;
use App\Domain\Twitter\Model\FilteredStreamRuleList;

class UpdateFilteredStreamRulesAction extends TweetsAction

{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    // Define valid query parameters
    $options = [
      'query' => [
        'dry_run'
      ],
      'body' => [
        'add',
        'add.value',
        'delete',
        'delete.ids',
        'add.tag'
      ]
    ];

    // Store valid query parameters in $params array
    $params = $this->sortParams($options);

    $uri = 'tweets' . '/' . 'search' . '/' . 'stream' . '/' . 'rules';

    $access_token = $this->twitterOAuth->oauth2(
      'oauth2/token',
      array('grant_type' => 'client_credentials')
    );
  
    $this->twitterOAuth->setBearer( $access_token->access_token );
  
    // Update filtered stream rules
    $response = $this->twitterOAuth->post( $uri, $params, true );

    $status = $this->twitterOAuth->getLastHttpCode();

    if ($this->exceptionHandler->handleErrors( $status, $response )) {
  
      // Initialise empty array to store list of existing rules
      $rules = array();

      if(property_exists($response, 'data')) {

        for($i=0;$i<COUNT($response->data); $i++) {

          $rule = new FilteredStreamRule();
          $rule->setByJson($response->data[$i]);
          $rules[] = $rule;
        }
      }
  
      $meta = new Metadata();
      $meta->setByJson($response->meta);
  
      $payload = new FilteredStreamRuleList( $rules, $meta );

      // Return response to user
      return $this
        ->respondWithData($payload)
        ->withHeader('Content-Type', 'application/json');
    };
  }
}