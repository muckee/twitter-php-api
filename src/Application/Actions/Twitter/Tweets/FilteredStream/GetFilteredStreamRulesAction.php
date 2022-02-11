<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\FilteredStream;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

use App\Domain\Twitter\Model\Metadata;
use App\Domain\Twitter\Model\FilteredStreamRule;
use App\Domain\Twitter\Model\FilteredStreamRuleList;

class GetFilteredStreamRulesAction extends TweetsAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
      // Define valid query parameters
      $options = [
        'query' => [
          'ids'
        ]
      ];
  
      // Store valid query parameters in $params array
      $params = $this->sortParams($options);

      $uri = 'tweets' . '/' . 'search' . '/' . 'stream' . '/' . 'rules';

      $accessToken = $this->twitterOAuth->oauth2(
        'oauth2/token',
        array( 'grant_type' => 'client_credentials' )
      );
    
      $this->twitterOAuth->setBearer( $accessToken->access_token );
    
      // Update filtered stream rules
      $response = $this->twitterOAuth->get( $uri, $params, true );
      
      $status = $this->twitterOAuth->getLastHttpCode();

      if ($this->exceptionHandler->handleErrors($status, $response)) {

        $rules = array();
    
        if(property_exists($response, 'data')) {

          for($i=0;$i<COUNT($response->data);$i++) {

            $rule = new FilteredStreamRule();

            $rule->setByJson($response->data[$i]);

            $rules[] = $rule;
          }
        }
    
        $meta = new Metadata();
        $meta->setByJson($response->meta);
    
        $payload = new FilteredStreamRuleList($rules, $meta);

        // Return response to user
        return $this
          ->respondWithData($payload)
          ->withHeader('Content-Type', 'application/json');
      };
    }
}