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
   * Returns the post parameter list.
   *
   * @return  array
   *
   * @since   1.0.0-dev
   */
  public function GetPostList();
}
