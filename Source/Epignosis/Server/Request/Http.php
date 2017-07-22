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
   * Returns the parameter list of the requested source. If the requested source does not
   * exist or it is equivalent to null, an empty array list will be returned.
   *
   * @param   string $source
   *            - The source to return its parameter list. (Optional, null)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   */
  public function GetParameterList($source = null)
  {
    return [];
  }
}
