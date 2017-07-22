<?php

namespace Epignosis\Server\Abstraction;

use Epignosis\Server\Failure\Server as ServerException;

/**
 * Interface ServerInterface
 *
 * The server interface.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Server\Abstraction
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Server\Abstraction
 * @since       1.0.0-dev
 */
interface ServerInterface
{
  /**
   * Returns the request interface.
   *
   * @return  RequestInterface
   *
   * @since   1.0.0-dev
   *
   * @throws  ServerException
   *            - In case that is not possible to return the request interface.
   */
  public function GetRequestInterface();
}
