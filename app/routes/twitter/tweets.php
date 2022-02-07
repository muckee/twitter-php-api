<?php

declare(strict_types=1);

require __DIR__ . '/tweets/tweets-lookup.php';

require __DIR__ . '/tweets/manage-tweets.php';

require __DIR__ . '/tweets/timelines.php';

require __DIR__ . '/tweets/search-tweets.php';

require __DIR__ . '/tweets/tweet-counts.php';

require __DIR__ . '/tweets/filtered-stream.php';

/**
 * TODO: At the time of writing, Twitter API documentation
 * does not contain an API reference for 'Volume streams' endpoints.
 * Periodically check documentation for updates.
 * Once implemented, uncomment following line and create relevant actions/repositories.
 */
// require __DIR__ . '/tweets/volume-streams.php';

require __DIR__ . '/tweets/retweets.php';

require __DIR__ . '/tweets/likes.php';

require __DIR__ . '/tweets/hide-replies.php';