<?php

declare(strict_types=1);

namespace App\Infrastructure\Remote\Twitter\RemoteTwitterRepository;

use App\Domain\Twitter\Metadata;
use App\Domain\Twitter\TwitterList;
use App\Domain\Twitter\TwitterRepository\UsersRepository;

use App\Infrastructure\Remote\Twitter\RemoteTwitterRepository;

use App\Domain\Twitter\User;

class RemoteUsersRepository extends RemoteTwitterRepository
                            implements UsersRepository
{

  /**
   * {@inheritdoc}
   */
  public function getUsersById(
    array $params
  ): TwitterList {

    // Get tweet
    $response = $this->twitterOAuth->get(
      'users',
      $params
    );

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {

      // Initialise empty array to store results
      $results = [];

      // Iterate over resulting tweets
      foreach($response->data as $result) {
  
        $user = new User();
        $user->setByJson($result);
  
        $results[] = $user;
      }

      $meta = new Metadata();
      return new TwitterList($results, $meta);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getUserById(
    string $user_id,
    array $params
  ): User {

    $uri = 'users' . '/' . $user_id;
    // Get tweet
    $response = $this->twitterOAuth->get(
      $uri,
      $params
    );

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {
  
      $user = new User();
      $user->setByJson($response->data);
      return $user;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getUsersByUsername(
    array $params
  ): TwitterList {

    $uri = 'users' . '/' . 'by';

    // Get tweet
    $response = $this->twitterOAuth->get(
      $uri,
      $params
    );

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {

      // Initialise empty array to store results
      $results = [];

      // Iterate over resulting tweets
      foreach($response->data as $result) {
  
        $user = new User();
        $user->setByJson($result);

        $results[] = $user;
      }

      $meta = new Metadata();
      return new TwitterList($results, $meta);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getUserByUsername(
    string $username,
    array $params
  ): User {

    $uri = 'users' . '/' . 'by' . '/' . 'username' . '/' . $username;

    // Get tweet
    $result = $this->twitterOAuth->get(
      $uri,
      $params
    );

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $result)) {
  
      $user = new User();
      $user->setByJson($result);

      return $user;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getAuthorizedUser(
    array $params
  ): User {

    $uri = 'users' . '/' . 'me';

    // Get tweet
    $result = $this->twitterOAuth->get(
      $uri,
      $params
    );

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $result)) {
  
      $user = new User();
      $user->setByJson($result);

      return $user;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getFollowingByUserId(
    string $user_id,
    array $params
  ): TwitterList {

    $uri = 'users' . '/' . $user_id . '/' . 'following';

    // Get tweet
    $response = $this->twitterOAuth->get(
      $uri,
      $params
    );

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {

      // Initialise empty array to store results
      $results = [];

      // Iterate over resulting tweets
      foreach($response->data as $result) {
  
        $user = new User();
        $user->setByJson($result);

        $results[] = $user;
      }

      $meta = new Metadata();
      $meta->setByJson($response->meta);

      return new TwitterList($results, $meta);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getFollowingByUsername(
    string $username,
    array $params
  ): TwitterList {

    $uri = 'users' . '/' . 'by' . '/' . 'username' . '/' . $username . '/' . 'following';

    // Get tweet
    $response = $this->twitterOAuth->get(
      $uri,
      $params
    );

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {

      // Initialise empty array to store results
      $results = [];

      // Iterate over resulting tweets
      foreach($response->data as $result) {

        $user = new User();
        $user->setByJson($result);

        $results[] = $user;
      }

      $meta = new Metadata();
      $meta->setByJson($response->meta);

      return new TwitterList($results, $meta);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getFollowersByUserId(
    string $user_id,
    array $params
  ): TwitterList {

    $uri = 'users' . '/' . $user_id . '/' . 'followers';

    // Get tweet
    $response = $this->twitterOAuth->get(
      $uri,
      $params
    );

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {

      // Initialise empty array to store results
      $results = [];

      // Iterate over resulting tweets
      foreach($response->data as $result) {
  
        $user = new User();
        $user->setByJson($result);

        $results[] = $user;
      }

      $meta = new Metadata();
      $meta->setByJson($response->meta);

      return new TwitterList($results, $meta);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getFollowersByUsername(
    string $username,
    array $params
  ): TwitterList {

    $uri = 'users' . '/' . 'by' . '/' . 'username' . '/' . $username . '/' . 'followers';

    // Get tweet
    $response = $this->twitterOAuth->get(
      $uri,
      $params
    );

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {

      // Initialise empty array to store results
      $results = [];

      // Iterate over resulting tweets
      foreach($response->data as $result) {

        $user = new User();
        $user->setByJson($result);

        $results[] = $user;
      }

      $meta = new Metadata();
      $meta->setByJson($response->meta);

      return new TwitterList($results, $meta);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function followUser(
    string $user_id,
    array $params
  ): string {

    $uri = 'users' . '/' . $user_id . '/' . 'following';

    // Get tweet
    $response = $this->twitterOAuth->post(
      $uri,
      $params,
      true
    );

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {

      return json_encode($response->data);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function unfollowUser(
    string $user_id,
    string $target_user_id
  ): string {

    $uri = 'users' . '/' . $user_id . '/' . 'following' . '/' . $target_user_id;

    // Get tweet
    $response = $this->twitterOAuth->delete($uri);

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {

      // TODO: Include response data as properties in Metadata class and return Metadata object to user
      return json_encode($response->data);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getBlockedUsers(
    string $user_id,
    array $params
  ): TwitterList {

    $uri = 'users' . '/' . $user_id . '/' . 'blocking';

    // Get tweet
    $response = $this->twitterOAuth->get($uri, $params);

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {

      // Initialise empty array to store results
      $results = [];

      // Iterate over resulting tweets
      foreach($response->data as $result) {
  
        $user = new User();
        $user->setByJson($result);

        $results[] = $user;
      }

      $meta = new Metadata();
      $meta->setByJson($response->meta);

      return new TwitterList($results, $meta);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function blockUser(
    string $user_id,
    array $params
  ): string {

    $uri = 'users' . '/' . $user_id . '/' . 'blocking';

    // Get tweet
    $response = $this->twitterOAuth->post($uri, $params, true);

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {

      // TODO: Include response data as properties in Metadata class and return Metadata object to user
      return json_encode($response->data);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function unblockUser(
    string $user_id,
    string $target_user_id
  ): string {

    $uri = 'users' . '/' . $user_id . '/' . 'blocking' . '/' . $target_user_id;

    // Get tweet
    $response = $this->twitterOAuth->delete($uri);

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {

      // TODO: Include response data as properties in Metadata class and return Metadata object to user
      return json_encode($response->data);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getMutedUsers(
    string $user_id,
    array $params
  ): TwitterList {

    $uri = 'users' . '/' . $user_id . '/' . 'muting';

    // Get tweet
    $response = $this->twitterOAuth->get($uri, $params);

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {
      // Initialise empty array to store results
      $results = [];

      if(property_exists($response, 'data')) {
        // Iterate over resulting tweets
        foreach($response->data as $result) {
    
          $user = new User();
          $user->setByJson($result);
  
          $results[] = $user;
        }
      }

      $meta = new Metadata();
      $meta->setByJson($response->meta);

      return new TwitterList($results, $meta);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function muteUser(
    string $user_id,
    array $params
  ): string {

    $uri = 'users' . '/' . $user_id . '/' . 'muting';

    // Get tweet
    $response = $this->twitterOAuth->post($uri, $params, true);

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {

      // TODO: Include response data as properties in Metadata class and return Metadata object to user
      return json_encode($response->data);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function unmuteUser(
    string $user_id,
    string $target_user_id
  ): string {

    $uri = 'users' . '/' . $user_id . '/' . 'muting' . '/' . $target_user_id;

    // Get tweet
    $response = $this->twitterOAuth->delete($uri);

    $status = $this->twitterOAuth->getLastHttpCode();
    if($this->exceptionHandler->handleErrors($status, $response)) {

      // TODO: Include response data as properties in Metadata class and return Metadata object to user
      return json_encode($response->data);
    }
  }
}