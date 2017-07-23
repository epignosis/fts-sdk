<?php

namespace Epignosis\Server\Request;

use Epignosis\Server\Abstraction\RequestInterface;

/**
 * Class Http
 *
 * The HTTP request.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Server\Request
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Server\Request
 * @since       1.0.0-dev
 */
class Http implements RequestInterface
{
  /**
   * Returns the post parameter list.
   *
   * @return  array
   *
   * @since   1.0.0-dev
   */
  public function GetPostList()
  {
    return $_POST;
  }
}
