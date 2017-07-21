<?php

namespace Epignosis\Auth;

use Epignosis\Auth\Abstraction\AuthInterface;
use Epignosis\Auth\Abstraction\AuthTrait;
use Epignosis\Auth\Failure\SignatureToken as SignatureTokenException;

/**
 * Class SignatureToken
 *
 * The signature-token auth.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Auth
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Auth
 * @since       1.0.0-dev
 */
class SignatureToken implements AuthInterface
{
  use AuthTrait;


  /**
   * Checks the availability of the requested function name.
   *
   * @param   string $functionName
   *            - The function name to be checked. (Required)
   *
   * @return  SignatureToken
   *
   * @since   1.0.0-dev
   *
   * @throws  SignatureTokenException
   *            - In case that the requested function name is not available.
   */
  private function _CheckFunctionAvailability($functionName)
  {
    if (!function_exists($functionName)) {
      throw new SignatureTokenException (
        SignatureTokenException::AUTH_ADAPTER_SIGNATURE_TOKEN_FUNCTION_NOT_EXIST,
        null,
        ['Function' => 'openssl_encrypt']
      );
    }

    return $this;
  }

  /**
   * Authenticates the request.
   *
   * @param   array $authInformation
   *            - The auth information to be used. (Required)
   *
   * @param   array $operationType
   *            - The operation type to be used. (Required)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  SignatureTokenException
   *            - In case that is not possible to authenticate the request.
   */
  public function AuthenticateRequest(array $authInformation, array $operationType)
  {
    $this->_CheckFunctionAvailability('openssl_encrypt');



    echo '<prE>'; print_r($authInformation); print_R($operationType); print_r($this);exit;

    return [];
  }
}
