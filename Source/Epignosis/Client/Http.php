<?php

namespace Epignosis\Client;

use Epignosis\Client\Abstraction\ClientInterface;
use Epignosis\Client\Failure\Http as HttpClientException;

/**
 * Class Http
 *
 * The HTTP client.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Client
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Client
 * @since       1.0.0-dev
 */
class Http implements ClientInterface
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
   * @throws  HttpClientException
   *            - In case that is not possible to successfully complete, the creation
   *              operation.
   */
  public function Create(array $configuration, array $data = [])
  {
    echo '<pre>';
    print_r($configuration);
    echo '</pre>';
    return [];
  }

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
   * @throws  HttpClientException
   *            - In case that is not possible to successfully complete, the delete
   *              operation.
   */
  public function Delete(array $configuration, array $data = [])
  {
    return [];
  }

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
   * @throws  HttpClientException
   *            - In case that is not possible to successfully complete, the retrieval
   *              operation.
   */
  public function Retrieve(array $configuration, array $data = [])
  {
    return [];
  }

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
   * @throws  HttpClientException
   *            - In case that is not possible to successfully complete, the update
   *              operation.
   */
  public function Update(array $configuration, array $data = [])
  {
    return [];
  }
}
