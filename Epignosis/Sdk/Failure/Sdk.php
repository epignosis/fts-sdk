<?php

namespace Epignosis\Sdk\Failure;

/**
 * Class Sdk
 *
 * The SDK exception.
 *
 * @application Epignosis SDK
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Sdk\Failure
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Sdk\Failure
 * @since       1.0.0-dev
 */
class Sdk extends \Exception
{
  use EpignosisSdkTrait;


  /**
   * Used in case that is not possible to successfully complete, the creation of the
   * requested document.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const SDK_GET_AUTH_INTERFACE_FAILURE = 1;

  /**
   * Used in case that is not possible to successfully complete, the deletion of the
   * requested document.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const SDK_GET_CLIENT_INTERFACE_FAILURE = 2;

  /**
   * Used in case that is not possible to successfully complete, the retrieval of the
   * requested document.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const SDK_GET_LOGGER_INTERFACE_FAILURE = 3;

  /**
   * Used in case that is not possible to successfully complete, the update of the
   * requested document.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const SDK_CLEAR_LOG_FAILURE = 4;

  const SDK_CONFIGURE_FAILURE = 5;
  const SDK_GET_LOG_FAILURE = 6;
  const SDK_GET_NOTIFICATION_EVENT_FAILURE = 7;


  /**
   * Document constructor.
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

    self::$_failureMessageList[self::FTS_CREATE_FAILURE] =
      'FTS_CREATE_FAILURE';

    self::$_failureMessageList[self::FTS_DELETE_FAILURE] =
      'FTS_DELETE_FAILURE';

    self::$_failureMessageList[self::FTS_RETRIEVE_FAILURE] =
      'FTS_RETRIEVE_FAILURE';

    self::$_failureMessageList[self::FTS_UPDATE_FAILURE] =
      'FTS_UPDATE_FAILURE';

    $this->_additionalFailureInformation = $additionalFailureInformation;

    parent::__construct($this->GetFailureMessage($code), $code, $exception);
  }
}
