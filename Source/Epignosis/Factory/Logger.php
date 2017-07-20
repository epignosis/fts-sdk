<?php

namespace Epignosis\Factory;

use Epignosis\Factory\Abstraction\FactoryInterface;
use Epignosis\Factory\Abstraction\FactoryTrait;
use Epignosis\Factory\Failure\Logger as LoggerException;

/**
 * Class Logger
 *
 * The logger factory class.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Factory
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Factory
 * @since       1.0.0-dev
 */
class Logger implements FactoryInterface
{
  use FactoryTrait;


  /**
   * Logger constructor.
   */
  public function __construct()
  {
    $this->_adapterDefault = 'Memory';
  }

  /**
   * Returns a new instance of the requested logger adapter.
   *
   * @param   string $adapter
   *            - The logger adapter to return a new instance of it. (Required)
   *
   * @param   array $configuration
   *            - The configuration to be used. (Optional, [])
   *
   * @return  mixed
   *
   * @since   1.0.0-dev
   *
   * @throws  LoggerException
   *            - In case that is not possible to return a new instance of the requested
   *              logger adapter.
   */
  public function Get($adapter, $configuration = [])
  {
    try {
      $adapterClass = 'Epignosis\Logger\\' . $adapter;

      return new $adapterClass($configuration);
    } catch (\Exception $exception) {
      throw new LoggerException (
        LoggerException::FACTORY_LOGGER_FAILURE,
        $exception,
        ['Adapter' => $adapter, 'Configuration' => $configuration]
      );
    }
  }
}
