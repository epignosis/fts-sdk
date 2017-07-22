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
   * Used in case that the requested function name is not available.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const AUTH_SIGNATURE_FUNCTION_NOT_EXIST = 1;

  /**
   * Used in case that the requested crypto key, is not valid.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const AUTH_SIGNATURE_KEY_CRYPTO_NOT_VALID = 2;


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

    self::$_failureMessageList[self::AUTH_SIGNATURE_FUNCTION_NOT_EXIST] =
      'AUTH_SIGNATURE_FUNCTION_NOT_EXIST';

    self::$_failureMessageList[self::AUTH_SIGNATURE_KEY_CRYPTO_NOT_VALID] =
      'AUTH_SIGNATURE_KEY_CRYPTO_NOT_VALID';

    $this->_additionalFailureInformation = $additionalFailureInformation;

    parent::__construct($this->GetFailureMessage($code), $code, $exception);
  }
}
