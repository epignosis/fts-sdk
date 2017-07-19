<?php

namespace Epignosis\Helper\Configuration;

use Epignosis\Helper\Configuration\Failure\Configuration as ConfigurationException;

/**
 * Class Configuration
 *
 * The configuration.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Helper\Configuration
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Helper\Configuration
 * @since       1.0.0-dev
 */
class Configuration
{
  /**
   * The configuration repository.
   *
   * @default []
   * @since   1.0.0-dev
   * @var     array
   */
  private $_configurationRepository = [];


  /**
   * Configures the implemented object.
   *
   * @param   array $configuration
   *            - The configuration to be used. (Required)
   *
   * @return  Configuration
   *
   * @since   1.0.0-dev
   *
   * @throws  ConfigurationException
   *            - In case that is not possible to configure the implemented object.
   */
  public function Configure(array $configuration)
  {
    $this->_configurationRepository = $configuration;

    return $this;
  }

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
  public function GetFromKey($key)
  {
    if (isset($this->_configurationRepository[$key])) {
      return $this->_configurationRepository[$key];
    }

    return null;
  }
}
