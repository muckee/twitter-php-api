<?php

declare(strict_types=1);

namespace App\Domain\Twitter;

use JsonSerializable;

use App\Domain\Twitter\TwitterException\TwitterException;

abstract class Model implements JsonSerializable
{
  public function __construct()
  {
      if (!defined('static::AVAILABLE_PROPERTIES'))
      {
          throw new TwitterException('Constant AVAILABLE_PROPERTIES is not defined on subclass ' . get_class($this));
      }

      $props = $this->getAvailableProperties();
      for($i=0;$i<COUNT($props); $i++) {
        $prop = $props[$i];
        $this->{$prop} = null;
      }
  }

  abstract protected function getAvailableProperties(): array;

  /**
   * @param int $invalid
   */
  public function setByJson($json)
  {
    $props = $this->getAvailableProperties();

    for($i=0; $i<COUNT($props); $i++) {

      $property = $props[$i];

      if(property_exists($json, $property)) {
        $this->{$property} = $json->{$property};
      }
    }
  }

  // TODO: Either patch Intelephense or declare type
  // #[\ReturnTypeWillChange]
  public function jsonSerialize(): array
  {
    /**
     * Using this method to create a payload for the jsonSerialize()
     * function ensures that only metadata which is not null
     * will be displayed to the user.
     */

     // Define all possible valid Metadata property names
    $props = $this->getAvailableProperties();

    // Create empty array to store payload
    $payload = array();

    // Iterate over available properties
    foreach( $props as $v ) {

      // Check if property is not null
      if($this->{$v} !== null) {

        // Append property to payload array
        $payload[$v] = $this->{$v};
      }
    }

    return $payload;
  }
}