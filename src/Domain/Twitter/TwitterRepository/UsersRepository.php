<?php

declare(strict_types=1);

namespace App\Domain\Twitter\TwitterRepository;

use App\Domain\Twitter\User;
use App\Domain\Twitter\TwitterList;

interface UsersRepository
{
  /**
   * @param string[] $params
   * @return TwitterList
   */
  public function getUsersById(array $params): TwitterList;

  /**
   * @param string $user_id
   * @param string[] $params
   * @return User
   */
  public function getUserById(string $user_id, array $params): User;

  /**
   * @param string[] $params
   * @return TwitterList
   */
  public function getUsersByUsername(array $params): TwitterList;

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

  /**
   * @param string $user_id
   * @param string[] $params
   * @return TwitterList
   */
  public function getFollowingByUserId(string $user_id, array $params): TwitterList;

  /**
   * @param string $username
   * @param string[] $params
   * @return TwitterList
   */
  public function getFollowingByUsername(string $username, array $params): TwitterList;

  /**
   * @param string $user_id
   * @param string[] $params
   * @return TwitterList
   */
  public function getFollowersByUserId(string $user_id, array $params): TwitterList;

  /**
   * @param string $username
   * @param string[] $params
   * @return TwitterList
   */
  public function getFollowersByUsername(string $username, array $params): TwitterList;

  /**
   * @param string $user_id
   * @param string[] $params
   * @return string
   */
  public function followUser(string $user_id, array $params): string;

  /**
   * @param string $user_id
   * @param string $target_user_id
   * @return string
   */
  public function unfollowUser(string $user_id, string $target_user_id): string;

  /**
   * @param string $user_id
   * @param array $params
   * @return TwitterList
   */
  public function getBlockedUsers(string $user_id, array $params): TwitterList;

  /**
   * @param string $user_id
   * @param array $params
   * @return string
   */
  public function blockUser(string $user_id, array $params): string;

  /**
   * @param string $user_id
   * @param string $target_user_id
   * @return string
   */
  public function unblockUser(string $user_id, string $target_user_id): string;

  /**
   * @param string $user_id
   * @param array $params
   * @return TwitterList
   */
  public function getMutedUsers(string $user_id, array $params): TwitterList;

  /**
   * @param string $user_id
   * @param array $params
   * @return string
   */
  public function muteUser(string $user_id, array $params): string;

  /**
   * @param string $user_id
   * @param string $target_user_id
   * @return string
   */
  public function unmuteUser(string $user_id, string $target_user_id): string;
}