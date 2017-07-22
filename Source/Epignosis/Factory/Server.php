<?php

namespace Epignosis\Factory;

use Epignosis\Factory\Abstraction\FactoryInterface;
use Epignosis\Factory\Abstraction\FactoryTrait;
use Epignosis\Factory\Failure\Server as ServerException;

/**
 * Class Server
 *
 * The server factory class.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Factory
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Factory
 * @since       1.0.0-dev
 */
class Server implements FactoryInterface
{
  use FactoryTrait;


  /**
   * Returns a new instance of the requested server adapter.
   *
   * @param   string $adapter
   *            - The server adapter to return a new instance of it. (Required)
   *
   * @param   array $configuration
   *            - The configuration to be used. (Optional, [])
   *
   * @return  mixed
   *
   * @since   1.0.0-dev
   *
   * @throws  ServerException
   *            - In case that is not possible to return a new instance of the requested
   *              server adapter.
   */
  public function Get($adapter, $configuration = [])
  {
    try {
      $adapterClass = 'Epignosis\Server\\' . $adapter;

      return new $adapterClass($configuration);
    } catch (\Exception $exception) {
      throw new ServerException (
        ServerException::FACTORY_SERVER_FAILURE,
        $exception,
        ['Adapter' => $adapter, 'Configuration' => $configuration]
      );
    }
  }
}
