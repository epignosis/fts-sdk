<?php

namespace Epignosis\Auth\Failure;

/**
 * Class Signature
 *
 * The signature auth exception.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Auth\Failure
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Auth\Failure
 * @since       1.0.0-dev
 */
class Signature extends Auth
{
  /**
   * Used in case that a required function is not available.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const AUTH_SIGNATURE_FUNCTION_NOT_AVAILABLE = 1;


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

    self::$_failureMessageList[self::AUTH_SIGNATURE_FUNCTION_NOT_AVAILABLE] =
      'AUTH_SIGNATURE_FUNCTION_NOT_AVAILABLE';

    $this->_additionalFailureInformation = $additionalFailureInformation;

    parent::__construct($this->GetFailureMessage($code), $code, $exception);
  }
}
