<?php

namespace Epignosis\Auth\Abstraction;

use Epignosis\Auth\Failure\Auth as AuthException;

/**
 * Interface AuthInterface
 *
 * The auth interface.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Auth\Abstraction
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Auth\Abstraction
 * @since       1.0.0-dev
 */
interface AuthInterface
{
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
   * @throws  AuthException
   *            - In case that is not possible to authenticate the request.
   */
  public function AuthenticateRequest(array $authInformation);
}
