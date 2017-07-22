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
   * Authenticates the server request and returns its method type.
   *
   * @param   RequestInterface
   *            - The request interface. (Required)
   *
   * @return  string
   *
   * @since   1.0.0-dev
   *
   * @throws  AuthException
   *            - In case that is not possible to authenticate the server request.
   */
  public function AuthenticateServerRequest(RequestInterface $requestInterface);

  /**
   * Signs the request.
   *
   * @param   array $authInformation
   *            - The auth information to be used. (Required)
   *
   * @param   array $operationInformation
   *            - The operation information to be used. (Required)
   *
   * @param   array $data
   *            - The data to be signed. (Required)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  AuthException
   *            - In case that is not possible to sign the request.
   */
  public function GetSignedRequest (
    array $authInformation,
    array $operationInformation,
    array $data);
}
