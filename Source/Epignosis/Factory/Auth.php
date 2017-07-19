<?php

namespace Epignosis\Factory;

use Epignosis\Factory\Abstraction\FactoryInterface;
use Epignosis\Factory\Abstraction\FactoryTrait;
use Epignosis\Factory\Failure\Auth as AuthException;

/**
 * Class Auth
 *
 * The auth factory class.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Factory
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Factory
 * @since       1.0.0-dev
 */
class Auth implements FactoryInterface
{
  use FactoryTrait;


  /**
   * Auth constructor.
   */
  public function __construct()
  {
    $this->_adapterDefault = 'Memory';
  }

  /**
   * Returns a new instance of the requested auth adapter.
   *
   * @param   string $adapter
   *            - The auth adapter to return a new instance of it. (Required)
   *
   * @param   array $configuration
   *            - The configuration to be used. (Required)
   *
   * @return  mixed
   *
   * @since   1.0.0-dev
   *
   * @throws  AuthException
   *            - In case that is not possible to return a new instance of the requested
   *              auth adapter.
   */
  public function Get($adapter, array $configuration = [])
  {
    try {
      $adapterClass = 'Epignosis\Auth\\' . $adapter;

      return new $adapterClass($configuration);
    } catch (\Exception $exception) {
      throw new AuthException (
        AuthException::FACTORY_AUTH_FAILURE,
        $exception,
        ['Adapter' => $adapter, 'Configuration' => $configuration]
      );
    }
  }
}
