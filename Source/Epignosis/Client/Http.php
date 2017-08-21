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
   * Returns the requested array data, into a URL (raw encoded).
   *
   * @param   array $data
   *            - The data to be used. (Optional, [])
   *
   * @param   string $prefix
   *            - The parameter prefix. Primarily used by the internal recursion.
   *              (Optional, null)
   *
   * @return  string
   *
   * @since   1.0.0-dev
   */
  private function _ArrayToUrl(array $data = [], $prefix = null)
  {
    $query = [];

    foreach ($data as $key => $value) {
      if (is_array($value)) {
        $query[] = $this->_ArrayToUrl($value, $key);
      } else {
        if ($prefix) {
          $query[] = sprintf('%s[%s]=%s', $prefix, $key, rawurlencode($value));
        } else {
          $query[] = sprintf('%s=%s', $key, rawurlencode($value));
        }
      }
    }

    return implode('&', $query);
  }

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
    $httpResponse = curl_exec($http);

    if (false === $httpResponse) {
      throw new HttpClientException (
        HttpClientException::CLIENT_HTTP_OPERATION_FAILURE,
        null,
        [
          'Error' => [
            'Code' => curl_errno($http),
            'Message' => curl_error($http),
            'Type' => 'Network'
          ]
        ]
      );
    }

    return $this->_GetResponseContentDecoded($httpResponse);
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
    if (false == curl_setopt_array($http, $optionList)) {
      throw new HttpClientException (
        HttpClientException::CLIENT_HTTP_SET_OPTION_FAILURE,
        null,
        ['OptionList' => $optionList]
      );
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
   *            - In case that a required PHP function is not available.
   */
  public function __construct(array $configuration = [])
  {
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
          ['Function' => $function]
        );
      }
    }

    $this->_configuration = $configuration;
  }

  /**
   * Performs a create/update operation.
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
        \CURLOPT_CONNECTTIMEOUT => $this->_configuration['Timeout.Connect'],
        \CURLOPT_HTTPHEADER => $this->_GetHttpHeaderList($configuration['HeaderList']),
        \CURLOPT_POST => true,
        \CURLOPT_POSTFIELDS => ['Data' => json_encode($data)],
        \CURLOPT_RETURNTRANSFER => true,
        \CURLOPT_TIMEOUT => $this->_configuration['Timeout.Execute'],
        \CURLOPT_URL => $configuration['HeaderList']['FTS-ENDPOINT']
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
    $http = $this->_GetHttp();

    $optionList = [
      \CURLOPT_CONNECTTIMEOUT => $this->_configuration['Timeout.Connect'],
      \CURLOPT_CUSTOMREQUEST => 'DELETE',
      \CURLOPT_HTTPHEADER => $this->_GetHttpHeaderList($configuration['HeaderList']),
      \CURLOPT_RETURNTRANSFER => true,
      \CURLOPT_TIMEOUT => $this->_configuration['Timeout.Execute'],
      \CURLOPT_URL => $configuration['HeaderList']['FTS-ENDPOINT']
    ];

    if (!empty($data)) {
      $optionList[\CURLOPT_POSTFIELDS] = json_encode($data);
    }

    $this->_SetOptionList($http, $optionList);

    $response = $this->_Execute($http);

    curl_close($http);

    return $response;
  }

  /**
   * Performs a get operation.
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
  public function Get(array $configuration, array $data = [])
  {
    $http = $this->_GetHttp();

    $this->_SetOptionList (
      $http,
      [
        \CURLOPT_CONNECTTIMEOUT => $this->_configuration['Timeout.Connect'],
        \CURLOPT_HTTPHEADER => $this->_GetHttpHeaderList($configuration['HeaderList']),
        \CURLOPT_RETURNTRANSFER => true,
        \CURLOPT_TIMEOUT => $this->_configuration['Timeout.Execute'],
        \CURLOPT_URL => sprintf (
          '%s?%s',
          $configuration['HeaderList']['FTS-ENDPOINT'],
          $this->_ArrayToUrl($data)
        )
      ]
    );

    $response = $this->_Execute($http);

    curl_close($http);

    return $response;
  }
}
