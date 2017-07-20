<?php

namespace Epignosis\Auth;

use Epignosis\Auth\Abstraction\AuthInterface;
use Epignosis\Auth\Failure\Signature as SignatureException;

/**
 * Class Signature
 *
 * The signature auth.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Auth
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Auth
 * @since       1.0.0-dev
 */
class Signature implements AuthInterface
{
  /**
   * Authenticates the request.
   *
   * @return  string
   *
   * @since   1.0.0-dev
   *
   * @throws  SignatureException
   *            - In case that is not possible to authenticate the request.
   */
  public function AuthenticateRequest()
  {
    return null;
  }
}
