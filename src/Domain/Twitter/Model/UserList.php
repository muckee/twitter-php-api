<?php

declare(strict_types=1);

namespace App\Domain\Twitter\Model;

use App\Domain\Twitter\Model;

use App\Domain\Twitter\Model\User;
use App\Domain\Twitter\Model\Metadata;

class UserList extends Model
{
  const AVAILABLE_PROPERTIES = array(
    'users',
    'meta'
  );
  
  /**
   * @var User[] $users
   */
  protected ?array $users;
  
  /**
   * @var Metadata $meta
   */
  protected ?Metadata $meta;

  public function __construct(
    array $users,
    Metadata $meta
  ) {
    parent::__construct();

    $this->users = $users;
    $this->meta = $meta;
  }
  
  protected function getAvailableProperties(): array {
    return self::AVAILABLE_PROPERTIES;
  }
}