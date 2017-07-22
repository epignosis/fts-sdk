<?php

namespace Epignosis\Server\Abstraction;

interface ServerInterface
{
  /**
   * @return  RequestInterface
   */
  public function GetRequestInterface();
}
