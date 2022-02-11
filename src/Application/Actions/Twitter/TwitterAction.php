<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Application\Actions\Action;

use Psr\Log\LoggerInterface;

use App\Application\Handlers\TwitterExceptionHandler;

abstract class TwitterAction extends Action
{

  protected TwitterOAuth $twitterOAuth;

  protected TwitterExceptionHandler $twitterExceptionHandler;

  public function __construct(
    LoggerInterface $logger,
    TwitterOAuth $twitterOAuth,
    TwitterExceptionHandler $twitterExceptionHandler
  ) {
    parent::__construct($logger);

    $this->twitterOAuth = $twitterOAuth;
    $this->twitterOAuth->setApiVersion('2');
    $this->exceptionHandler = $twitterExceptionHandler;
  }

  /**
   * Extract valid options from query params
   * @param array[] $options
   * @param string[] $keys
   * @return string[]
   */
  protected function sortParams(
    array $options
  ): array {

    // Initialise empty array to store parameters
    $params = [];

    // Iterate over list of option groups
    foreach($options as $k => $v) {

      // Retrieve parameters of current object type from request object
      $data = $this->selectParams($k);

      // Check if any parameters were retrieved from request object
      if(COUNT($data) > 0) {

        $p = $this->validateParams($v, $data);

        // Check if any valid parameters were found
        if(COUNT($p) > 0) {

          // Merge new parameters with existing array
          $params = array_merge($params, $p);
        }
      }
    }

    return $params;
  }

  private function selectParams($type) {
    // Retrieve params of supplied type from request object
    switch($type) {
      case 'query':
        return $this->request->getQueryParams();
      case 'body':
        return $this->request->getParsedBody();
      default:
        return [];
    }
  }

  private function validateParams(
    $keys,
    $params
  ) {

    // Filter $params for only parameters found in $keys
    $p = array_filter(
      $params,
      function($k) use ($keys) {
        return in_array($k, $keys);
      },
      ARRAY_FILTER_USE_KEY
    );

    return $p;
  }

}