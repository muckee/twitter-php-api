<?php

declare(strict_types=1);

namespace App\Infrastructure\Remote\Twitter;

// TODO: Create duplicate status exception class
// use App\Domain\Twitter\DuplicateStatusException;
use App\Domain\Twitter\TwitterRepository;

use Abraham\TwitterOAuth\TwitterOAuth;

class RemoteTwitterRepository implements TwitterRepository
{
    protected TwitterOAuth $twitterOAuth;

    /**
     * @param TwitterOAuth $twitterOAuth
     */
    public function __construct(TwitterOAuth $twitterOAuth)
    {
      $this->twitterOAuth = $twitterOAuth;
    }

    /**
     * {@inheritdoc}
     */
    public function createTweet($text): string
    {

      // Post status using Abraham\TwitterOAuth package
      $statuses = $this->twitterOAuth->post(
        "statuses/update",
        [
            "status" => $text
        ]
      );
 
      // Check for errors
      if($statuses->errors) {
        // TODO: Create 'cannot perform write actions' error and throw here
        return $statuses->errors[0]->message;
      }

      // Derive tweet URI from response
      $tweetUri = 'https://twitter.com/' .
                  $statuses->user->id_str .
                  '/status/' .
                  $statuses->id_str;

      return $tweetUri;
    }
}