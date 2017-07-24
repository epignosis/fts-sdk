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
  private function _Execute($http, array $configuration)
  {
    $httpContent = curl_exec($http);

    if (false === $httpContent) {
      throw new HttpClientException (
        HttpClientException::CLIENT_HTTP_CREATE_FAILURE,
        null,
        ['Error' => ['Code' => curl_errno($http), 'Message' => curl_error($http)]
      );
    }

    $httpStatus = curl_getinfo($http, CURLINFO_HTTP_CODE);

    curl_close($http);

    if (!in_array($httpStatus, $configuration['Response']['SuccessCode'])) {
      throw new HttpClientException (
        HttpClientException::CLIENT_HTTP_CREATE_FAILURE,
        null,
        ['Response' => ['Code' => $httpStatus]]
      );
    }

    return $this->_GetResponseContentDecoded (
      $httpContent, $configuration['HeaderList']['Accept']
    );
  }

  private function _GetHttp()
  {
    $http = curl_init();

    if (false === $http) {
      throw new HttpClientException (
        HttpClientException::CLIENT_HTTP_INITIALIZATION_FAILURE
      );
    }

    return $http;
  }

  private function _GetResponseContentDecoded($content, $httpHeaderAccept)
  {
    return [];
  }

  private function _SetOptionList($http, array $optionList)
  {
    foreach ($optionList as $key => $value) {
      if (false == curl_setopt($http, $key, $value)) {
        throw new HttpClientException (
          HttpClientException::CLIENT_HTTP_SET_OPTION_FAILURE,
          null,
          ['Option' => ['Key' => $key, 'Value' => $value]]
        );
      }
    }
  }

  /**
   * Http constructor.
   *
   * @since   1.0.0-dev
   *
   * @throws  HttpClientException
   *            - In case that the cURL PHP extension is not available.
   */
  public function __construct()
  {
    if (!extension_loaded('curl')) {
      throw new HttpClientException (
        HttpClientException::CLIENT_HTTP_EXTENSION_NOT_AVAILABLE,
        null,
        ['Extension' => 'curl']
      );
    }
  }

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
    $http = $this->_GetHttp();

    $this->_SetOptionList (
      $http,
      [
        CURLOPT_URL => $configuration['EndPoint'],
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_TIMEOUT => $configuration['Request']['Timeout'],
        CURLOPT_HTTPHEADER => $configuration['HeaderList']
      ]
    );

    $response = $this->_Execute($http, $configuration);

    curl_close($http);

    return $response;
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
