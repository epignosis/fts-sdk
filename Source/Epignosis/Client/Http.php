<?php

namespace Epignosis\Client;

use Epignosis\Client\Abstraction\ClientInterface;


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
   * @throws  ClientException
   *            - In case that is not possible to successfully complete, the creation
   *              operation.
   */
  public function Create(array $configuration, array $data = [])
  {

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
   * @throws  ClientException
   *            - In case that is not possible to successfully complete, the delete
   *              operation.
   */
  public function Delete(array $configuration, array $data = [])
  {

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
   * @throws  ClientException
   *            - In case that is not possible to successfully complete, the retrieval
   *              operation.
   */
  public function Retrieve(array $configuration, array $data = [])
  {

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
   * @throws  ClientException
   *            - In case that is not possible to successfully complete, the update
   *              operation.
   */
  public function Update(array $configuration, array $data = [])
  {

  }
}
