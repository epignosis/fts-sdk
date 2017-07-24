<?php

namespace Epignosis\Client\Failure;

/**
 * Class Http
 *
 * The HTTP client exception.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Client\Failure
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Client\Failure
 * @since       1.0.0-dev
 */
class Http extends Client
{
  /**
   * Used in case that is not possible to successfully complete, the creation operation.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const CLIENT_HTTP_CREATE_FAILURE = 4;

  /**
   * Used in case that the cURL PHP extension is not available.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const CLIENT_HTTP_EXTENSION_NOT_AVAILABLE = 1;

  /**
   * Used in case that is not possible to initialize the HTTP client.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const CLIENT_HTTP_INITIALIZATION_FAILURE = 2;

  /**
   * Used in case that is not possible to set an HTTP option.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const CLIENT_HTTP_SET_OPTION_FAILURE = 3;


  /**
   * Signature constructor.
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

    self::$_failureMessageList[self::CLIENT_HTTP_CREATE_FAILURE] =
      'CLIENT_HTTP_CREATE_FAILURE';

    self::$_failureMessageList[self::CLIENT_HTTP_EXTENSION_NOT_AVAILABLE] =
      'CLIENT_HTTP_EXTENSION_NOT_AVAILABLE';

    self::$_failureMessageList[self::CLIENT_HTTP_INITIALIZATION_FAILURE] =
      'CLIENT_HTTP_INITIALIZATION_FAILURE';

    self::$_failureMessageList[self::CLIENT_HTTP_SET_OPTION_FAILURE] =
      'CLIENT_HTTP_SET_OPTION_FAILURE';

    $this->_additionalFailureInformation = $additionalFailureInformation;

    parent::__construct($this->GetFailureMessage($code), $code, $exception);
  }
}
