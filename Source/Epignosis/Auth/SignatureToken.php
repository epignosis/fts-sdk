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
   * Authenticates the request.
   *
   * @param   array $authInformation
   *            - The auth information to be used. (Required)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  SignatureTokenException
   *            - In case that is not possible to authenticate the request.
   */
  public function AuthenticateRequest(array $authInformation)
  {
    echo '<prE>'; print_R($this);exit;
    return [];
  }
}
