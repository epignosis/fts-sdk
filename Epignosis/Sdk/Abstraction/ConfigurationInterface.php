<?php

namespace Epignosis\Sdk\Abstraction;

use Epignosis\Sdk\Failure\Configuration as ConfigurationException;

/**
 * Interface ConfigurationInterface
 *
 * The configuration interface.
 *
 * @application Epignosis SDK
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Sdk\Abstraction
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Sdk\Abstraction
 * @since       1.0.0-dev
 */
interface ConfigurationInterface
{
  /**
   * Returns the value of the requested configuration key.
   *
   * @param   string $key
   *            - The key to return its value. (Required)
   *
   * @return  mixed
   *
   * @since   1.0.0-dev
   *
   * @throws  ConfigurationException
   *            - In case that is not possible to return the value of the requested
   *              configuration key.
   */
  public function GetByKey($key);
}
