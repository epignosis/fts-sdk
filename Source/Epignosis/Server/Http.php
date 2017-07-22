<?php

namespace Epignosis\Server;

use Epignosis\Server\Abstraction\RequestInterface;
use Epignosis\Server\Abstraction\ServerInterface;
use Epignosis\Server\Failure\Http as HttpServerException;

/**
 * Class Http
 *
 * The HTTP server.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Server
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Server
 * @since       1.0.0-dev
 */
class Http implements ServerInterface
{
  /**
   * The request interface.
   *
   * @default null
   * @since   1.0.0-dev
   * @var     RequestInterface
   */
  private $_requestInterface = null;


  /**
   * Returns the request interface.
   *
   * @return  RequestInterface
   *
   * @since   1.0.0-dev
   *
   * @throws  HttpServerException
   *            - In case that is not possible to return the HTTP request interface.
   */
  public function GetRequestInterface()
  {
    if (null == $this->_requestInterface) {
      try {
        $this->_requestInterface = new HttpRequest;
      } catch (\Exception $exception) {
        throw new HttpServerException (
          HttpServerException::SERVER_HTTP_GET_REQUEST_INTERFACE_FAILURE, $exception
        );
      }
    }

    return $this->_requestInterface;
  }
}
