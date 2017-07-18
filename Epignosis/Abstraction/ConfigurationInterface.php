<?php

namespace Epignosis\Sdk\Abstraction;

use Epignosis\Sdk\Failure\Configuration as ConfigurationException;

/**
 * Interface ConfigurationInterface
 *
 * The configuration interface.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Sdk\Abstraction
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Sdk\Abstraction
 * @since       1.0.0-dev
 */
interface ConfigurationInterface
{
  /**
   * Configures the implemented object.
   *
   * @param   array $configuration
   *            - The configuration to be used. (Required)
   *
   * @return  ConfigurationInterface
   *
   * @since   1.0.0-dev
   *
   * @throws  ConfigurationException
   *            - In case that is not possible to configure the implemented object.
   */
  public function Configure(array $configuration);

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
