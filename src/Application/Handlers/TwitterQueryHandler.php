<?php

declare(strict_types=1);

namespace App\Application\Handlers;

class TwitterQueryHandler
{

  /**
   * Filters $params for members with keys which exist in the $keys array
   * @param string[] $keys
   * @param string[] $params
   * @return string[] $params
   */
  public function sortQueries(
    $keys,
    $params
  ): array {

    /** TODO: Create class with hard-coded parameter keys as in below array.
     * When class is called, true or false can be set for each key. class is re-used for all twitter API calls.
     * class must contain function to return array of all keys which are marked as true.
     */

    // Retrieve values from $params only if the associated key exists in the $keys array
    $queries = array_filter(
      $params,
      function($k) use ($keys) {
        return in_array($k, $keys);
      },
      ARRAY_FILTER_USE_KEY
    );

    return $queries;
  }
}
