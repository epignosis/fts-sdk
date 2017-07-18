<?php

namespace Epignosis\Clients\Abstraction;

use Epignosis\Clients\Failure\Client as ClientException;

/**
 * Interface ClientInterface
 *
 * The client interface.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Clients\Abstraction
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Clients\Abstraction
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
   * @param   array $optionList
   *            - The list of options to be used. (Optional, [])
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  ClientException
   *            - In case that is not possible to successfully complete, the HTTP/DELETE
   *              request.
   */
  public function Delete($url, array $data = [], array $optionList = []);

  /**
   * HTTP/GET
   *
   * @param   string $url
   *            - The HTTP url. (Required)
   *
   * @param   array $data
   *            - The data to be used. (Optional, [])
   *
   * @param   array $optionList
   *            - The list of options to be used. (Optional, [])
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  ClientException
   *            - In case that is not possible to successfully complete, the HTTP/GET
   *              request.
   */
  public function Get($url, array $data = [], array $optionList = []);

  /**
   * HTTP/POST
   *
   * @param   string $url
   *            - The HTTP url. (Required)
   *
   * @param   array $data
   *            - The data to be used. (Optional, [])
   *
   * @param   array $optionList
   *            - The list of options to be used. (Optional, [])
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  ClientException
   *            - In case that is not possible to successfully complete, the HTTP/POST
   *              request.
   */
  public function Post($url, array $data = [], array $optionList = []);

  /**
   * HTTP/PUT
   *
   * @param   string $url
   *            - The HTTP url. (Required)
   *
   * @param   array $data
   *            - The data to be used. (Optional, [])
   *
   * @param   array $optionList
   *            - The list of options to be used. (Optional, [])
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  ClientException
   *            - In case that is not possible to successfully complete, the HTTP/PUT
   *              request.
   */
  public function Put($url, array $data = [], array $optionList = []);
}
