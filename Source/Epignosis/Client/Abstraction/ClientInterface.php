<?php

namespace Epignosis\Client\Abstraction;

use Epignosis\Client\Failure\Client as ClientException;

/**
 * Interface ClientInterface
 *
 * The client interface.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Client\Abstraction
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Client\Abstraction
 * @since       1.0.0-dev
 */
interface ClientInterface
{
  /**
   * Performs a creation operation.
   *
   * @param   array $configuration
   *            - The configuration to be used. (Required)
   *
   * @param   array $data
   *            - The data to be used. (Optional, [])
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  ClientException
   *            - In case that is not possible to successfully complete the operation.
   */
  public function Create(array $configuration, array $data = []);

  /**
   * Performs a delete operation.
   *
   * @param   array $configuration
   *            - The configuration to be used. (Required)
   *
   * @param   array $data
   *            - The data to be used. (Optional, [])
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  ClientException
   *            - In case that is not possible to successfully complete the operation.
   */
  public function Delete(array $configuration, array $data = []);

  /**
   * Performs a retrieval operation.
   *
   * @param   array $configuration
   *            - The configuration to be used. (Required)
   *
   * @param   array $data
   *            - The data to be used. (Optional, [])
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  ClientException
   *            - In case that is not possible to successfully complete the operation.
   */
  public function Retrieve(array $configuration, array $data = []);

  /**
   * Performs an update operation.
   *
   * @param   array $configuration
   *            - The configuration to be used. (Required)
   *
   * @param   array $data
   *            - The data to be used. (Optional, [])
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  ClientException
   *            - In case that is not possible to successfully complete the operation.
   */
  public function Update(array $configuration, array $data = []);
}
