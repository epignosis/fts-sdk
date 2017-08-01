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
   * The HTTP client configuration.
   *
   * @default []
   * @since   1.0.0-dev
   * @var     array
   */
  private $_configuration = [];


  /**
   * Executes the requested HTTP operation.
   *
   * @param   resource $http
   *            - The HTTP resource handler. (Required)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  HttpClientException
   *            - In case that is not possible to execute the requested HTTP operation.
   */
  private function _Execute($http)
  {
    $httpContent = curl_exec($http);

    if (false === $httpContent) {
      throw new HttpClientException (
        HttpClientException::CLIENT_HTTP_OPERATION_FAILURE,
        null,
        ['Error' => ['Code' => curl_errno($http), 'Message' => curl_error($http)]]
      );
    }

    return $this->_GetResponseContentDecoded($httpContent);
  }

  /**
   * Returns the HTTP resource handler.
   *
   * @return  resource
   *
   * @since   1.0.0-dev
   *
   * @throws  HttpClientException
   *            - In case that is not possible to initialize the HTTP resource handler.
   */
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

  /**
   * Returns the formatted HTTP header list.
   *
   * @param   mixed $httpHeaderList
   *            - The HTTP header list to be formatted. (Optional, null)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   */
  private function _GetHttpHeaderList($httpHeaderList = null)
  {
    $_httpHeaderList = [];

    foreach ($httpHeaderList as $httpHeaderName => $httpHeaderValue) {
      $_httpHeaderList[] = trim(sprintf('%s: %s', $httpHeaderName, $httpHeaderValue));
    }

    return $_httpHeaderList;
  }

  /**
   * Returns the decoded response content. Only JSON is supported so far.
   *
   * @param   string $content
   *            - The content to be decoded. (Required)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  HttpClientException
   *            - In case that is not possible to return the decoded response content.
   */
  private function _GetResponseContentDecoded($content)
  {
    $responseContentDecoded = json_decode($content, true, 512, \JSON_BIGINT_AS_STRING);

    if (false === $responseContentDecoded || !is_array($responseContentDecoded)) {
      throw new HttpClientException (
        HttpClientException::CLIENT_HTTP_RESPONSE_DECODING_PROCESS_FAILURE,
        null,
        ['Response' => ['Content' => $content]]
      );
    }

    return $responseContentDecoded;
  }

  /**
   * Set the HTTP option list.
   *
   * @param   resource $http
   *            - The HTTP resource handler. (Required)
   *
   * @param   array $optionList
   *            - The option list to be set. (Required)
   *
   * @return  Http
   *
   * @since   1.0.0-dev
   *
   * @throws  HttpClientException
   *            - In case that is not possible to set an HTTP option.
   */
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

    return $this;
  }

  /**
   * Http constructor.
   *
   * @param   array $configuration
   *            - The configuration to be used. (Optional, [])
   *
   * @since   1.0.0-dev
   *
   * @throws  HttpClientException
   *            - In case that a required function is not available.
   */
  public function __construct(array $configuration = [])
  {
    /** @noinspection SpellCheckingInspection */
    $functionList = [
      'curl_close',
      'curl_errno', 'curl_error', 'curl_exec',
      'curl_init',
      'curl_setopt'
    ];

    foreach ($functionList as $function) {
      if (!function_exists($function)) {
        throw new HttpClientException (
          HttpClientException::CLIENT_HTTP_FUNCTION_NOT_AVAILABLE,
          null,
          ['Extension' => $function]
        );
      }
    }

    $this->_configuration = $configuration;
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
   *            - In case that is not possible to successfully complete the operation.
   */
  public function Create(array $configuration, array $data = [])
  {
    $http = $this->_GetHttp();

    $this->_SetOptionList (
      $http,
      [
        CURLOPT_URL => $configuration['HeaderList']['EPIGNOSIS-ENDPOINT'],
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => ['Data' => json_encode($data)],
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_TIMEOUT => $this->_configuration['Timeout'],
        CURLOPT_HTTPHEADER => $this->_GetHttpHeaderList($configuration['HeaderList'])
      ]
    );

    $response = $this->_Execute($http);

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
   *            - In case that is not possible to successfully complete the operation.
   */
  public function Delete(array $configuration, array $data = [])
  {
    return [];
  }

  /**
   * Performs a search operation.
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
   *            - In case that is not possible to successfully complete the operation.
   */
  public function Search(array $configuration, array $data = [])
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
   *            - In case that is not possible to successfully complete the operation.
   */
  public function Update(array $configuration, array $data = [])
  {
    return [];
  }
}
