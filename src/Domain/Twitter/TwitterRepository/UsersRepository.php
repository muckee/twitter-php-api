<?php

declare(strict_types=1);

namespace App\Domain\Twitter\TwitterRepository;

use App\Domain\Twitter\User;

interface UsersRepository
{
  /**
   * @param string[] $params
   * @return array
   */
  public function getUsersById(array $params): array;

  /**
   * @param string $user_id
   * @param string[] $params
   * @return User
   */
  public function getUserById(string $user_id, array $params): User;

  /**
   * @param string[] $params
   * @return array
   */
  public function getUsersByUsername(array $params): array;

  /**
   * @param string $username
   * @param string[] $params
   * @return User
   */
  public function getUserByUsername(string $username, array $params): User;

  /**
   * @param string[] $params
   * @return User
   */
  public function getAuthorizedUser(array $params): User;
}