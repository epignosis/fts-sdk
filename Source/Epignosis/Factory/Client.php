<?php

namespace Epignosis\Factory;

use Epignosis\Factory\Abstraction\FactoryInterface;
use Epignosis\Factory\Abstraction\FactoryTrait;
use Epignosis\Factory\Failure\Client as ClientException;

/**
 * Class Client
 *
 * The client factory class.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Factory
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Factory
 * @since       1.0.0-dev
 */
class Client implements FactoryInterface
{
  use FactoryTrait;


  /**
   * Returns a new instance of the requested client adapter.
   *
   * @param   string $adapter
   *            - The client adapter to return a new instance of it. (Required)
   *
   * @param   array $configuration
   *            - The configuration to be used. (Optional, [])
   *
   * @return  mixed
   *
   * @since   1.0.0-dev
   *
   * @throws  ClientException
   *            - In case that is not possible to return a new instance of the requested
   *              client adapter.
   */
  public function Get($adapter, $configuration = [])
  {
    try {
      $adapterClass = 'Epignosis\Client\\' . $adapter;

      return new $adapterClass($configuration);
    } catch (\Exception $exception) {
      throw new ClientException (
        ClientException::FACTORY_CLIENT_FAILURE,
        $exception,
        ['Adapter' => $adapter, 'Configuration' => $configuration]
      );
    }
  }
}
