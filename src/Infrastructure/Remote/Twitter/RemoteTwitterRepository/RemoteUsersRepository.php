<?php

declare(strict_types=1);

namespace App\Infrastructure\Remote\Twitter\RemoteTwitterRepository;

use App\Domain\Twitter\TwitterRepository\UsersRepository;

use App\Infrastructure\Remote\Twitter\RemoteTwitterRepository;

use App\Domain\Twitter\User;

class RemoteUsersRepository extends RemoteTwitterRepository
                            implements UsersRepository
{

  /**
   * {@inheritdoc}
   */
  public function getUsersById(array $params): array
  {

    // Get tweet
    $users = $this->twitterOAuth->get(
      'users',
      $params
    );

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $users)) {

      // Initialise empty array to store results
      $results = [];

      // Iterate over resulting tweets
      foreach($users->data as $result) {

        $id = $result->id;
        $name = $result->name;
        $username = $result->username;
  
        $user = new User($id, $name, $username);

        // Append user text to $results array
        array_push($results, $user);
      }

      return $results;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getUserById(string $user_id, array $params): User
  {

    $uri = 'users' . '/' . $user_id;
    // Get tweet
    $user = $this->twitterOAuth->get(
      $uri,
      $params
    );

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $user)) {
      return new User(
        $user->data->id,
        $user->data->name,
        $user->data->username
      );
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getUsersByUsername(array $params): array
  {

    $uri = 'users' . '/' . 'by';

    // Get tweet
    $users = $this->twitterOAuth->get(
      $uri,
      $params
    );

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $users)) {

      // Initialise empty array to store results
      $results = [];

      // Iterate over resulting tweets
      foreach($users->data as $result) {

        $id = $result->id;
        $name = $result->name;
        $username = $result->username;
  
        $user = new User($id, $name, $username);

        // Append user text to $results array
        array_push($results, $user);
      }

      return $results;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getUserByUsername(string $username, array $params): User
  {

    $uri = 'users' . '/' . 'by' . '/' . 'username' . '/' . $username;

    // Get tweet
    $result = $this->twitterOAuth->get(
      $uri,
      $params
    );

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $result)) {

        $id = $result->data->id;
        $name = $result->data->name;
        $username = $result->data->username;
  
        return new User($id, $name, $username);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getAuthorizedUser(array $params): User
  {

    $uri = 'users' . '/' . 'me';

    // Get tweet
    $result = $this->twitterOAuth->get(
      $uri,
      $params
    );

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $result)) {

        $id = $result->data->id;
        $name = $result->data->name;
        $username = $result->data->username;
  
        return new User($id, $name, $username);
    }
  }
}