<?php

namespace Epignosis\Server\Abstraction;

/**
 * Interface RequestInterface
 *
 * The request interface.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Server\Abstraction
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Server\Abstraction
 * @since       1.0.0-dev
 */
interface RequestInterface
{
  /**
   * Returns the parameter list of the request source. If the requested source does not
   * exist or it is equal to null, an empty array list will be returned.
   *
   * @param   string $source
   *            - The source to return its parameter list. (Optional, null)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   */
  public function GetParameterList($source = null);
}
