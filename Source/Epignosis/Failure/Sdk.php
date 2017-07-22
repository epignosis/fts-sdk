<?php

namespace Epignosis\Failure;

/**
 * Class Sdk
 *
 * The SDK exception.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Failure
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Failure
 * @since       1.0.0-dev
 */
class Sdk extends \Exception
{
  use EpignosisSdkTrait;


  /**
   * Used in case that is not possible to configure the SDK.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const SDK_CONFIGURE_FAILURE = 2;

  /**
   * Used in case that is not possible to return the auth interface.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const SDK_GET_AUTH_INTERFACE_FAILURE = 3;

  /**
   * Used in case that is not possible to return the client interface.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const SDK_GET_CLIENT_INTERFACE_FAILURE = 4;

  /**
   * Used in case that is not possible to return the information of the requested
   * notification event.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const SDK_GET_NOTIFICATION_EVENT_FAILURE = 6;

  /**
   * Used in case that is not possible to return the server interface.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const SDK_GET_SERVER_INTERFACE_FAILURE = 5;

  /**
   * Used in case that the PHP version is not supported (< 5.6.0).
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const SDK_REQUIREMENT_PHP_VERSION = 1;


  /**
   * Sdk constructor.
   *
   * @param   int $code
   *            - The failure code. (Required)
   *
   * @param   \Exception|null $exception
   *            - The previous exception (if any), used for the exception chaining.
   *              (Optional, null)
   *
   * @param   array $additionalFailureInformation
   *            - The additional failure information. (Optional, [])
   *
   * @since   1.0.0-dev
   */
  public function __construct (
               $code,
    \Exception $exception = null,
         array $additionalFailureInformation = [])
  {
    $this->_timestamp = time();

    self::$_failureMessageList[self::SDK_CONFIGURE_FAILURE] =
      'SDK_CONFIGURE_FAILURE';

    self::$_failureMessageList[self::SDK_GET_AUTH_INTERFACE_FAILURE] =
      'SDK_GET_AUTH_INTERFACE_FAILURE';

    self::$_failureMessageList[self::SDK_GET_CLIENT_INTERFACE_FAILURE] =
      'SDK_GET_CLIENT_INTERFACE_FAILURE';

    self::$_failureMessageList[self::SDK_GET_NOTIFICATION_EVENT_FAILURE] =
      'SDK_GET_NOTIFICATION_EVENT_FAILURE';

    self::$_failureMessageList[self::SDK_GET_SERVER_INTERFACE_FAILURE] =
      'SDK_GET_SERVER_INTERFACE_FAILURE';

    self::$_failureMessageList[self::SDK_REQUIREMENT_PHP_VERSION] =
      'SDK_REQUIREMENT_PHP_VERSION';

    $this->_additionalFailureInformation = $additionalFailureInformation;

    parent::__construct($this->GetFailureMessage($code), $code, $exception);
  }
}
