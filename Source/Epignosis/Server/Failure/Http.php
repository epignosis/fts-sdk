<?php

namespace Epignosis\Server\Failure;

/**
 * Class Http
 *
 * The HTTP server exception.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Server\Failure
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Server\Failure
 * @since       1.0.0-dev
 */
class Http extends Server
{
  /**
   * Used in case that is not possible to return the HTTP request interface.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const SERVER_HTTP_GET_REQUEST_INTERFACE_FAILURE = 1;


  /**
   * Http constructor.
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

    self::$_failureMessageList[self::SERVER_HTTP_GET_REQUEST_INTERFACE_FAILURE] =
      'SERVER_HTTP_GET_REQUEST_INTERFACE_FAILURE';

    $this->_additionalFailureInformation = $additionalFailureInformation;

    parent::__construct($this->GetFailureMessage($code), $code, $exception);
  }
}
