<?php

namespace Epignosis\Factory\Abstraction;

use Epignosis\Factory\Failure\Factory as FactoryException;

/**
 * Interface FactoryInterface
 *
 * The factory interface.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Factory\Abstraction
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Factory\Abstraction
 * @since       1.0.0-dev
 */
trait FactoryTrait
{
  /**
   * The default adapter.
   *
   * @default null
   * @since   1.0.0-dev
   * @var     string
   */
  private $_adapterDefault = null;

  /**
   * The adapter registry.
   *
   * @default []
   * @since   1.0.0-dev
   * @var     array
   */
  private $_adapterRegistry = [];


  /**
   * Returns a cached instance of the requested adapter.
   *
   * @param   string $adapter
   *            - The adapter to return a cached instance of it. (Required)
   *
   * @param   array $configuration
   *            - The configuration to be used. (Required)
   *
   * @return  mixed
   *
   * @since   1.0.0-dev
   *
   * @throws  FactoryException
   *            - In case that is not possible to return a cached instance of the
   *              requested adapter.
   */
  public function GetCached($adapter, array $configuration = [])
  {
    if (!isset($this->_adapterRegistry[$adapter])) {
      $this->_adapterRegistry[$adapter] = $this->Get($adapter, $configuration);
    }

    return $this->_adapterRegistry[$adapter];
  }

  /**
   * Returns a cached instance of the default adapter.
   *
   * @param   array $configuration
   *            - The configuration to be used. (Required)
   *
   * @return  mixed
   *
   * @since   1.0.0-dev
   *
   * @throws  FactoryException
   *            - In case that is not possible to return a cached instance of the default
   *              adapter.
   */
  public function GetCachedDefault(array $configuration = [])
  {
    return $this->GetCached($this->_adapterDefault, $configuration);
  }

  /**
   * Returns a new instance of the default adapter.
   *
   * @param   array $configuration
   *            - The configuration to be used. (Required)
   *
   * @return  mixed
   *
   * @since   1.0.0-dev
   *
   * @throws  FactoryException
   *            - In case that is not possible to return a new instance of the default
   *              adapter.
   */
  public function GetDefault(array $configuration = [])
  {
    return $this->Get($this->_adapterDefault, $configuration);
  }
}
