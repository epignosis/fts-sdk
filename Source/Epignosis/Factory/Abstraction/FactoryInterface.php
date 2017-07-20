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
interface FactoryInterface
{
  /**
   * Returns a new instance of the requested adapter.
   *
   * @param   string $adapter
   *            - The adapter to return a new instance of it. (Required)
   *
   * @param   array $configuration
   *            - The configuration to be used. (Optional, [])
   *
   * @return  mixed
   *
   * @since   1.0.0-dev
   *
   * @throws  FactoryException
   *            - In case that is not possible to return a new instance of the requested
   *              adapter.
   */
  public function Get($adapter, $configuration = []);

  /**
   * Returns a cached instance of the requested adapter.
   *
   * @param   string $adapter
   *            - The adapter to return a cached instance of it. (Required)
   *
   * @param   array $configuration
   *            - The configuration to be used. (Optional, [])
   *
   * @return  mixed
   *
   * @since   1.0.0-dev
   *
   * @throws  FactoryException
   *            - In case that is not possible to return a cached instance of the
   *              requested adapter.
   */
  public function GetCached($adapter, $configuration = []);

  /**
   * Returns a cached instance of the default adapter.
   *
   * @param   array $configuration
   *            - The configuration to be used. (Optional, [])
   *
   * @return  mixed
   *
   * @since   1.0.0-dev
   *
   * @throws  FactoryException
   *            - In case that is not possible to return a cached instance of the default
   *              adapter.
   */
  public function GetCachedDefault($configuration = []);

  /**
   * Returns a new instance of the default adapter.
   *
   * @param   array $configuration
   *            - The configuration to be used. (Optional, [])
   *
   * @return  mixed
   *
   * @since   1.0.0-dev
   *
   * @throws  FactoryException
   *            - In case that is not possible to return a new instance of the default
   *              adapter.
   */
  public function GetDefault($configuration = []);
}
