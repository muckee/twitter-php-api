<?php

declare(strict_types=1);

use Slim\Interfaces\RouteCollectorProxyInterface as Group;

use App\Application\Actions\Twitter\Tweets\FilteredStream\UpdateFilteredStreamRulesAction;
use App\Application\Actions\Twitter\Tweets\FilteredStream\GetFilteredStreamRulesAction;
use App\Application\Actions\Twitter\Tweets\FilteredStream\GetFilteredStreamAction;

$group->group('/tweets/search', function (Group $search) {

  $search->group('/stream', function (Group $stream) {

    /**
     * Add or delete rules from your stream
     */
    $stream->post('/rules', 
      UpdateFilteredStreamRulesAction::class
    );

    /**
     * Retrieve your stream's rules
     */
    $stream->get('/rules', 
      GetFilteredStreamRulesAction::class
    );
  });

  /**
   * Connect to the stream
   */
  $search->get('/stream', 
    GetFilteredStreamAction::class
  );
});