<?php

declare(strict_types=1);

namespace App\Domain\Twitter;

use JsonSerializable;

class Metadata implements JsonSerializable
{

  private ?string $sent;

  private ?string $next_token;

  private ?int $result_count;

  private ?int $changed;

  private ?int $not_changed;

  private ?int $valid;

  private ?int $invalid;

  public function __construct(
  ) {
    $this->sent = null;
    $this->next_token = null;
    $this->result_count = null;
    $this->changed = null;
    $this->not_changed = null;
    $this->valid = null;
    $this->invalid = null;
  }

  public function getSent(): string
  {
    return $this->sent;
  }

  public function setSent(string $sent)
  {
    $this->sent = $sent;
  }

  public function getNextToken(): string
  {
    return $this->next_token;
  }

  public function setNextToken($next_token)
  {
    $this->next_token = $next_token;
  }

  public function getResultCount(): int
  {
    return $this->result_count;
  }

  /**
   * @param int $result_count
   */
  public function setResultCount(int $result_count)
  {
    $this->result_count = $result_count;
  }

  public function getChanged(): int
  {
    return $this->changed;
  }

  /**
   * @param int $changed
   */
  public function setChanged(int $changed)
  {
    $this->changed = $changed;
  }

  public function getNotChanged(): int
  {
    return $this->not_changed;
  }

  /**
   * @param int $not_changed
   */
  public function setNotChanged(int $not_changed)
  {
    $this->not_changed = $not_changed;
  }

  public function getValid(): int
  {
    return $this->valid;
  }

  /**
   * @param int $valid
   */
  public function setValid(int $valid)
  {
    $this->valid = $valid;
  }

  public function getInvalid(): int
  {
    return $this->invalid;
  }

  /**
   * @param int $invalid
   */
  public function setInvalid(int $invalid)
  {
    $this->invalid = $invalid;
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
     $available_properties = array(
      'sent',
      'next_token',
      'result_count',
      'changed',
      'not_changed',
      'valid',
      'invalid'
    );

    // Create empty array to store payload
    $payload = array();

    // Iterate over available properties
    foreach( $available_properties as $v ) {

      // Check if property is not null
      if($this->{$v} != null) {

        // Append property to payload array
        $payload[$v] = $this->{$v};
      }
    }

    return $payload;
  }
}