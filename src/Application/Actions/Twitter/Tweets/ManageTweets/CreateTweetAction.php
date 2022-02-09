<?php

declare(strict_types=1);

namespace App\Application\Actions\Twitter\Tweets\ManageTweets;

use Psr\Http\Message\ResponseInterface as Response;

use App\Application\Actions\Twitter\Tweets\TweetsAction;

class CreateTweetAction extends TweetsAction
{
  /**
   * {@inheritdoc}
   */
  protected function action(): Response
  {
    $options = [
      'body' => [
        'direct_message_deep_link',
        'for_super_followers_only',
        'geo',
        'geo.place_id',
        'media',
        'media.media_ids',
        'media.tagged_user_ids',
        'poll',
        'poll.duration_minutes',
        'poll.options',
        'quote_tweet_id',
        'reply',
        'reply.exclude_reply_user_ids',
        'reply.in_reply_to_tweet_id',
        'reply_settings',
        'text'
      ]
    ];

    $params = $this->sortParams($options);

    // Create tweet
    $payload = $this->tweetsRepository->createTweet($params);

    // Return response to user
    return $this
      ->respondWithData($payload)
      ->withHeader('Content-Type', 'application/json');
  }
}