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
   * HTTP/DELETE
   *
   * @param   string $url
   *            - The HTTP url. (Required)
   *
   * @param   array $data
   *            - The data to be used. (Optional, [])
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  ClientException
   *            - In case that is not possible to successfully complete, the HTTP/DELETE
   *              request.
   */
  public function Delete($url, array $data = []);

  /**
   * HTTP/GET
   *
   * @param   string $url
   *            - The HTTP url. (Required)
   *
   * @param   array $data
   *            - The data to be used. (Optional, [])
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  ClientException
   *            - In case that is not possible to successfully complete, the HTTP/GET
   *              request.
   */
  public function Get($url, array $data = []);

  /**
   * HTTP/POST
   *
   * @param   string $url
   *            - The HTTP url. (Required)
   *
   * @param   array $data
   *            - The data to be used. (Optional, [])
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  ClientException
   *            - In case that is not possible to successfully complete, the HTTP/POST
   *              request.
   */
  public function Post($url, array $data = []);

  /**
   * HTTP/PUT
   *
   * @param   string $url
   *            - The HTTP url. (Required)
   *
   * @param   array $data
   *            - The data to be used. (Optional, [])
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  ClientException
   *            - In case that is not possible to successfully complete, the HTTP/PUT
   *              request.
   */
  public function Put($url, array $data = []);
}
