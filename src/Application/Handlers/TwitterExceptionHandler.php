<?php

declare(strict_types=1);

namespace App\Application\Handlers;

use App\Domain\Twitter\TwitterException\TwitterException;

class TwitterExceptionHandler
{
  /**
   * Returns true if $statuses does not contain errors
   * @return bool
   */
  public function handleErrors( $status, $response ): bool {
    // TODO: Cleanup/refactor handleErrors into new class once all errors are handled

    // Check if last HTTP request was successful
    if (
      $status == ( 200 || 201 )
    ) {

      // TODO: Remove following debugging line in production
      // throw new TwitterException( json_encode($response) );

      // Check for known errors
      if ( property_exists( $response, 'errors' ) ) {

        $error = $response->errors[0];

        $msg = $this->getErrMsg( $error );

        throw new TwitterException( $msg );

      } else if ( property_exists( $response, 'status' ) ) {

        if( $response->status === ( 200 || 201 ) ) {

          return true;

        } else {

          $msg = $this->getErrMsg( $response );

          throw new TwitterException( $msg );
        }
      }

      return true;
  
    // If last HTTP request was unsuccessful
    } else {

      $msg = 'An unknown error occured.';

      // TODO: Implement logging for unknown errors
      // TODO: Hide result from user in production

      if ( property_exists( $response, 'errors' ) ) {

        $error = $response->errors[0];

        $msg = $this->getErrMsg( $error );
      }

      throw new TwitterException( $msg );
    }
  }

  /**
   * Attempts to retrieve message from error
   * @return string
   */
  public function getErrMsg( $error ): string {

    // Check if error contains detail
    if( property_exists( $error, 'detail' ) ) {

      return $error->detail;
    }

    // Check if error has message
    if( property_exists( $error, 'message' ) ) {

      return $error->message;
    }

    // Check if error has title
    if( property_exists( $error, 'title' ) ) {

      // Create error message using title
      $msg = 'A \'' . $error->title . '\' error occured.';

      /**
       * The 'title' property of a twitter error object is not verbose.
       * Here we check if the error has a type, which is a reference
       * to relevant twitter documentation, in order to provide greater
       * context to the user.
       */
      if( property_exists( $error, 'type' ) ) {

        $msg = $msg . ' More info available at: ' . $error->type;
      }

      return $msg;
    }

    return 'An unknown error occured.';
  }
}