<?php

namespace Epignosis\Sdk;

/**
 * Class FullTextSearch
 *
 * The FullTextSearch PHP SDK.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Sdk
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Sdk
 * @since       2.0.0-dev
 */
class FullTextSearch
{
  /**
   * The configuration.
   *
   * @access  private
   * @default []
   * @since   2.0.0-dev
   * @var     array
   */
  private $_configuration = [];

  /**
   * The hypermedia information.
   *
   * @access  private
   * @default []
   * @since   2.0.0-dev
   * @var     array
   */
  private $_hypermedia = [];

  /**
   * The SDK's internal self information.
   *
   * @access  private
   * @since   2.0.0-dev
   * @var     array
   */
  private static $_sdkInformation = [
    'Agent' => 'Epignosis/FullTextSearch; PHP_SDK v%s',
    'Hypermedia' => [
      'Response' => [
        'IndexKey' => 'Data',
        'StatusCode' => 200
      ]
    ],
    'Service' => [
      'AcceptHeaderPattern' => 'application/vnd.epignosis.v%s+%s',
      'Format' => ['JSON']
    ],
    'Version' => [
      'Extra' => 'dev',
      'Major' => 2,
      'Minor' => 1,
      'Patch' => 1,
      'Release' => '2017-08-25'
    ]
  ];


  /**
   * FullTextSearch constructor.
   *
   * @param   array $configuration
   *            - The configuration to be used. (Required)
   *
   * @since   2.0.0-dev
   *
   * @throws  \Exception
   *            - In case that is not possible to build the service hypermedia file.
   */
  public function __construct(array $configuration)
  {
    $this->Configure($configuration)->_BuildHypermedia(false);
  }

  /**
   * Returns whether the requested action of the requested entity, requires
   * authentication, or not.
   *
   * @param   string $entity
   *            - The entity to be checked. (Required)
   *
   * @param   string $action
   *            - The action of the entity to be checked. (Required)
   *
   * @return  bool
   *
   * @since   2.0.0-dev
   */
  private function _AuthRequired($entity, $action)
  {
    return (bool) $this->_hypermedia[$entity][$action]['General']['AuthRequired'];
  }

  /**
   * Builds the hypermedia information.
   *
   * @param   bool $force
   *            - Whether to force the hypermedia information building, or not.
   *              (Optional, false)
   *
   * @return  FullTextSearch
   *
   * @since   2.0.0-dev
   *
   * @throws  \Exception
   *            - In case that is not possible to build the hypermedia information.
   */
  private function _BuildHypermedia($force = false)
  {
    $filePath = $this->_GetServiceHypermediaFilePath();

    if ($force || !file_exists($filePath)) {
      $this->_CreateServiceHypermediaFile($filePath);
    }

    $this->_hypermedia = $this->_ReadServiceHypermediaFile($filePath);

    return $this;
  }

  /**
   * Creates the service hypermedia file.
   *
   * @param   string $filePath
   *            - The path to the service hypermedia file. (Required)
   *
   * @return  FullTextSearch
   *
   * @since   2.0.0-dev
   *
   * @throws  \Exception
   *            - In case that is not possible to create the service hypermedia file.
   */
  private function _CreateServiceHypermediaFile($filePath)
  {
    $saved = $this->_SaveFile (
      $filePath,
      $this->_MinifyServiceHypermediaContent($this->_DownloadServiceHypermediaFile())
    );

    if (!$saved) {
      throw new \Exception (
        sprintf('Failed to save the service hypermedia file. (%s)', $filePath)
      );
    }

    return $this;
  }

  /**
   * Deletes the requested file.
   *
   * @param   string $filePath
   *            - The path to file to be deleted. (Required)
   *
   * @return  FullTextSearch
   *
   * @since   2.0.0-dev
   */
  private function _DeleteFile($filePath)
  {
    unlink($filePath);

    return $this;
  }

  /**
   * Downloads the service hypermedia file.
   *
   * @return  string
   *
   * @since   2.0.0-dev
   *
   * @throws  \Exception
   *            - In case that is not possible to download the service hypermedia file.
   */
  private function _DownloadServiceHypermediaFile()
  {
    $response = $this->_RequestOptions (
      $this->_configuration['Service']['BaseEndpoint'], $this->_GetHeaderList()
    );

    $invalidResponseStatusCode =
      self::$_sdkInformation['Hypermedia']['Response']['StatusCode'] !=
      $response['Status'];

    if ($invalidResponseStatusCode) {
      throw new \Exception (
        sprintf (
          'Failed to download the service hypermedia file. (%s)', $response['Url']
        )
      );
    }

    return $response['Body'];
  }

  /**
   * Sorts the requested array, by key in ascending mode.
   *
   * @param   array $array
   *            - The array to be sorted. (Required)
   *
   * @return  array
   *
   * @since   2.0.0-dev
   */
  private function _GetArraySorted(array $array)
  {
    ksort($array);

    foreach ($array as $key => $value) {
      if (is_array($value)) {
        $array[$key] = $this->_GetArraySorted($value);
      }
    }

    return $array;
  }

  /**
   * Converts the requested array into a string.
   *
   * @param   array $array
   *            - The array to be converted. (Required)
   *
   * @return  string
   *
   * @since   2.0.0-dev
   */
  private function _GetArrayToString(array $array)
  {
    $string = null;

    foreach ($array as $key => $value) {
      $string .= $key . (is_array($value) ? $this->_GetArrayToString($value) : $value);
    }

    return $string;
  }

  /**
   * Converts the requested array into a URL query.
   *
   * @param   array $array
   *            - The array to be converted. (Required)
   *
   * @param   string $prefix
   *            - Internal prefix to be used by the recursion. (Optional, null)
   *
   * @return  string
   *
   * @since   2.0.0-dev
   */
  private function _GetArrayToUrlQuery(array $data, $prefix = null)
  {
    $query = [];

    foreach ($data as $key => $value) {
      if (is_array($value)) {
        $query[] = $this->_GetArrayToUrlQuery($value, $key);
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
   * Returns the decoded requested response.
   *
   * @param   array $array
   *            - The response to be decoded. (Required)
   *
   * @return  mixed
   *
   * @since   2.0.0-dev
   */
  private function _GetDecodedResponse(array $response = [])
  {
    if ('JSON' == strtoupper($this->_configuration['Service']['Format'])) {
      return json_decode($response['Body'], true);
    }

    return $response['Body'];
  }

  /**
   * Returns the endpoint and the data of the requested action of the requested entity.
   *
   * @param   string $entity
   *            - The entity to be used. (Required)
   *
   * @param   string $action
   *            - The action of the entity to be used. (Required)
   *
   * @param   array $data
   *            - The data to be used. (Optional, [])
   *
   * @return  array
   *
   * @since   2.0.0-dev
   */
  private function _GetEndpointAndData($entity, $action, array $data = [])
  {
    $endpointList = $this->_hypermedia[$entity][$action]['Request']['EndpointList'];
    $parameterList = $this->_hypermedia[$entity][$action]['Request']['ParameterList'];

    if (isset($data[0]) || !isset($endpointList['Single'])) {
      $endpoint = $endpointList['Multiple'];
    } else {
      $parameterUrlList = [];

      foreach ($parameterList as $parameterName => $parameterAttributeList) {
        if (isset($parameterAttributeList['Endpoint'])) {
          $parameterUrlList[$parameterAttributeList['Endpoint']] = $data[$parameterName];

          unset($data[$parameterName]);
        }
      }

      ksort($parameterUrlList);

      $endpoint = sprintf (
        '%s/%s', rtrim($endpointList['Single'], '/'), implode('/', $parameterUrlList)
      );
    }

    return [$endpoint, $data];
  }

  /**
   * Returns the list of headers to be sent as part of the request.
   *
   * @return  array
   *
   * @since   2.0.0-dev
   */
  private function _GetHeaderList()
  {
    $headerList = [
      'Accept' => sprintf (
        self::$_sdkInformation['Service']['AcceptHeaderPattern'],
        (string) $this->_configuration['Service']['Version'],
        strtolower($this->_configuration['Service']['Format'])
      ),
      'Accept-Language' => strtolower (
        $this->_configuration['Service']['Language']
      ),
      'User-Agent' => sprintf (
        self::$_sdkInformation['Agent'], $this->GetSdkVersion()
      ),
      'X-Service-Timestamp' => time()
    ];

    $customUserAgent = $this->_configuration['Service']['Header']['UserAgent'];

    if (!empty($customUserAgent)) {
      if (1 != preg_match('~\R~u', $customUserAgent)) {
        $headerList['User-Agent'] = $customUserAgent;
      }
    }

    return $headerList;
  }

  /**
   * Converts the requested list of headers into a string.
   *
   * @param   array $headerList
   *            - The list of headers to be converted. (Required)
   *
   * @return  string
   *
   * @since   2.0.0-dev
   */
  private function _GetHeaderListToString(array $headerList = [])
  {
    $headerString = null;

    foreach ($headerList as $headerName => $headerValue) {
      $headerLine = sprintf('%s: %s', trim($headerName), trim($headerValue));

      if (1 != preg_match('~\R~u', $headerLine)) {
        $headerString .= sprintf("%s\r\n", $headerLine);
      }
    }

    return $headerString;
  }

  /**
   * Returns a securely produced random string, of a length equal to the requested.
   *
   * @param   int $length
   *            - The length of the random string to be produced. Must a positive integer.
   *              (Optional, 16)
   *
   * @return  string
   *
   * @since   2.0.0-dev
   *
   * @throws  \Exception
   *            - In case that is not possible to produce the random string.
   */
  private function _GetRandomStringSecure($length = 16)
  {
    if (!function_exists('openssl_random_pseudo_bytes')) {
      throw new \Exception('Function "openssl_random_pseudo_bytes" does not exist.');
    }

    $length = (int) $length;

    if (1 > $length) {
      throw new \Exception(sprintf('Invalid length (%d) requested.', $length));
    }

    do {
      $randomString = openssl_random_pseudo_bytes($length, $strong);
    } while (!$randomString || !$strong);

    return $randomString;
  }

  /**
   * Returns the request method, of the requested action of the requested entity.
   *
   * @param   string $entity
   *            - The entity to be used. (Required)
   *
   * @param   string $action
   *            - The action to be used. (Required)
   *
   * @return  null|string
   *
   * @since   2.1.0-dev
   */
  private function _GetRequestMethod($entity, $action)
  {
    if (empty($this->_hypermedia[$entity][$action]['Request']['Method'])) {
      return null;
    }

    return sprintf (
      '_Request%s',
      ucfirst(strtolower($this->_hypermedia[$entity][$action]['Request']['Method']))
    );
  }

  /**
   * Returns the status code from the requested list of headers.
   *
   * @param   array
   *            - The list of headers to be used. (Optional, [])
   *
   * @return  null|int
   *
   * @since   2.0.0-dev
   */
  private function _GetResponseStatusCode(array $headerList = [])
  {
    foreach ($headerList as $header) {
      if (preg_match('#HTTP/[0-9\.]+\s+([0-9]+)#', $header, $match)) {
        return (int) $match[1];
      }
    }

    return null;
  }

  /**
   * Returns the file path of the service hypermedia file.
   *
   * @return  string
   *
   * @since   2.0.0-dev
   */
  private function _GetServiceHypermediaFilePath()
  {
    $storageDirectory = dirname(dirname(__DIR__));

    if (!empty($this->_configuration['Service']['Storage']['FilePath'])) {
      $storageDirectory = $this->_configuration['Service']['Storage']['FilePath'];
    }

    $storageDirectory = rtrim($storageDirectory, '\/') . \DIRECTORY_SEPARATOR;
    $storageDirectory = str_replace(['\\', '/'], \DIRECTORY_SEPARATOR, $storageDirectory);

    return sprintf (
      '%sv%s.%s',
      $storageDirectory,
      (string) $this->_configuration['Service']['Version'],
      strtolower($this->_configuration['Service']['Format'])
    );
  }

  /**
   * Minifies the service hypermedia content.
   *
   * @param   string $content
   *            - The content to be minidied. (Optional, null)
   *
   * @return  string
   *
   * @since   2.1.0-dev
   */
  private function _MinifyServiceHypermediaContent($content = null)
  {
    $contentParsed = $this->_ParseServiceHypermediaContent($content);
    $contentMinified = [];

    foreach ($contentParsed as $entity => $contentEntity) {
      foreach ($contentEntity as $action => $contentEntityAction) {
        if (isset($contentEntityAction['General'])) {
          $contentEntityActionAuth = $contentEntityAction['General']['Auth'];

          $contentMinified[$entity][$action]['General'] = [
            'Auth' => [
              'Signature' => [
                'Hash' => [
                  'Algorithm' =>
                    $contentEntityActionAuth['Signature']['Hash']['Algorithm']
                ],
                'Name' => $contentEntityActionAuth['Signature']['Name']
              ]
            ],
            'AuthRequired' => $contentEntityAction['General']['AuthRequired'],
            'OperationType' => $contentEntityAction['General']['OperationType']
          ];
        }

        if (isset($contentEntityAction['Request'])) {
          $contentMinified[$entity][$action]['Request'] = [
            'EndpointList' => $contentEntityAction['Request']['EndpointList'],
            'Method' => $contentEntityAction['Request']['Method'],
            'ParameterList' => $contentEntityAction['Request']['ParameterList']
          ];
        }
      }
    }

    if ('JSON' == strtoupper($this->_configuration['Service']['Format'])) {
      return json_encode ([
        self::$_sdkInformation['Hypermedia']['Response']['IndexKey'] => $contentMinified
      ]);
    }

    return $content;
  }

  /**
   * Parses the service hypermedia content.
   *
   * @param   string $content
   *            - The content to be parsed. (Optional, null)
   *
   * @return  null|array
   *
   * @since   2.1.0-dev
   */
  private function _ParseServiceHypermediaContent($content = null)
  {
    $responseIndexKey = self::$_sdkInformation['Hypermedia']['Response']['IndexKey'];

    if ('JSON' == strtoupper($this->_configuration['Service']['Format'])) {
      return json_decode($content, true)[$responseIndexKey];
    }

    return null;
  }

  /**
   * Parses the service hypermedia file.
   *
   * @param   string $filePath
   *            - The path to the service hypermedia file. (Required)
   *
   * @param   string $content
   *            - The content to be parsed. (Optional, null)
   *
   * @return  array
   *
   * @since   2.0.0-dev
   *
   * @throws  \Exception
   *            - In case that is not possible to parse the service hypermedia file.
   */
  private function _ParseServiceHypermediaFile($filePath, $content = null)
  {
    $content = $this->_ParseServiceHypermediaContent($content);

    if (empty($content)) {
      $this->_DeleteFile($filePath);

      throw new \Exception (
        sprintf('Failed to parse the service hypermedia file. (%s)', $filePath)
      );
    }

    return $content;
  }

  /**
   * Reads the service hypermedia file.
   *
   * @param   string $filePath
   *            - The path to the service hypermedia file. (Required)
   *
   * @return  array
   *
   * @since   2.0.0-dev
   *
   * @throws  \Exception
   *            - In case that is not possible to read the service hypermedia file.
   */
  private function _ReadServiceHypermediaFile($filePath)
  {
    $content = file_get_contents($filePath);

    if (false === $content) {
      $this->_DeleteFile($filePath);

      throw new \Exception (
        sprintf('Failed to read from the service hypermedia file. (%s)', $filePath)
      );
    }

    return $this->_ParseServiceHypermediaFile($filePath, $content);
  }

  /**
   * Performs a request.
   *
   * @param   string $url
   *            - The URL to be requested. (Required)
   *
   * @param   array $optionList
   *            - The list of options to be requested. (Optional, [])
   *
   * @return  array
   *
   * @since   2.0.0-dev
   */
  private function _Request($url, array $optionList = [])
  {
    $optionList['http']['ignore_errors'] = true;
    $optionList['http']['protocol_version'] = '1.1';

    $response = file_get_contents($url, false, stream_context_create($optionList));

    if (false === $response || empty($http_response_header)) {
      return [
        'Body' => null,
        'Status' => null,
        'Url' => $url
      ];
    }

    return [
      'Body' => $response,
      'Status' => $this->_GetResponseStatusCode($http_response_header),
      'Url' => $url
    ];
  }

  /** @noinspection PhpUnusedPrivateMethodInspection */
  /**
   * Performs an HTTP DELETE request.
   *
   * @param   string $url
   *            - The URL to be requested. (Required)
   *
   * @param   array $headerList
   *            - The list of headers to be requested. (Optional, [])
   *
   * @param   array $data
   *            - The data to be requested. (Optional, [])
   *
   * @return  array
   *
   * @since   2.0.0-dev
   */
  private function _RequestDelete($url, array $headerList = [], array $data = [])
  {
    $optionList = [
      'http' => [
        'content' => http_build_query($data),
        'header' => $this->_GetHeaderListToString($headerList),
        'method' => 'DELETE'
      ]
    ];

    return $this->_Request($url, $optionList);
  }

  /** @noinspection PhpUnusedPrivateMethodInspection */
  /**
   * Performs an HTTP GET request.
   *
   * @param   string $url
   *            - The URL to be requested. (Required)
   *
   * @param   array $headerList
   *            - The list of headers to be requested. (Optional, [])
   *
   * @param   array $data
   *            - The data to be requested. (Optional, [])
   *
   * @return  array
   *
   * @since   2.0.0-dev
   */
  private function _RequestGet($url, array $headerList = [], array $data = [])
  {
    $optionList = [
      'http' => [
        'header' => $this->_GetHeaderListToString($headerList)
      ]
    ];

    return $this->_Request (
      sprintf('%s?%s', $url, $this->_GetArrayToUrlQuery($data)), $optionList
    );
  }

  /**
   * Performs an HTTP OPTIONS request.
   *
   * @param   string $url
   *            - The URL to be requested. (Required)
   *
   * @param   array $headerList
   *            - The list of headers to be requested. (Optional, [])
   *
   * @return  array
   *
   * @since   2.0.0-dev
   */
  private function _RequestOptions($url, array $headerList = [])
  {
    $optionList = [
      'http' => [
        'header' => $this->_GetHeaderListToString($headerList),
        'method' => 'OPTIONS'
      ]
    ];

    return $this->_Request($url, $optionList);
  }

  /** @noinspection PhpUnusedPrivateMethodInspection */
  /**
   * Performs an HTTP POST request.
   *
   * @param   string $url
   *            - The URL to be requested. (Required)
   *
   * @param   array $headerList
   *            - The list of headers to be requested. (Optional, [])
   *
   * @param   array $data
   *            - The data to be requested. (Optional, [])
   *
   * @return  array
   *
   * @since   2.0.0-dev
   */
  private function _RequestPost($url, array $headerList = [], array $data = [])
  {
    $optionList = [
      'http' => [
        'content' => http_build_query($data),
        'header' => $this->_GetHeaderListToString($headerList),
        'method' => 'POST'
      ]
    ];

    return $this->_Request($url, $optionList);
  }

  /**
   * Saves the requested content into the request file, and returns the operation result.
   *
   * @param   string $filePath
   *            - The path to file to save the content. (Required)
   *
   * @param   string $content
   *            - The content to be saved. (Required)
   *
   * @return  bool
   *
   * @since   2.0.0-dev
   */
  private function _SaveFile($filePath, $content)
  {
    $filePathDirectory = dirname($filePath);

    if (!file_exists($filePathDirectory)) {
      $mode = $this->_configuration['Service']['Storage']['Mode'];

      if (!mkdir($filePathDirectory, $mode, true)) {
        return false;
      }
    }

    if (false === file_put_contents($filePath, $content, \LOCK_EX)) {
      return false;
    }

    return true;
  }

  /**
   * Signs a request by appending the signature header into the requested list of headers
   * ($headerList).
   *
   * @param   string $entity
   *            - The entity to be used. (Required)
   *
   * @param   string $action
   *            - The action to be used. (Required)
   *
   * @param   array $headerList
   *            - The list of headers to be used. (Required)
   *
   * @param   array $data
   *            - The data to be used. (Optional, [])
   *
   * @return  FullTextSearch
   *
   * @since   2.0.0-dev
   *
   * @throws  \Exception
   *            - In case that is not possible to sign the request.
   */
  private function _Sign($entity, $action, array &$headerList, array $data = [])
  {
    $randomToken = $this->_GetRandomStringSecure(16);
    $authConfiguration = $this->_hypermedia[$entity][$action]['General']['Auth'];
    $operationType = $this->_hypermedia[$entity][$action]['General']['OperationType'];
    $keyList = $this->_configuration['Auth']['Key'];

    $headerList[$authConfiguration['Signature']['Name']] = sprintf (
      '%s;%s;%s',
      $keyList['Public'][$operationType],
      base64_encode($randomToken),
      base64_encode (
        hash_hmac (
          $authConfiguration['Signature']['Hash']['Algorithm'],
          $this->_GetArrayToString($this->_GetArraySorted($data)),
          $randomToken . $keyList['Private'][$operationType],
          true
        )
      )
    );

    return $this;
  }

  /**
   * Configures the SDK.
   *
   * @param   array $configuration
   *            - The configuration to be set. (Required)
   *
   * @return  FullTextSearch
   *
   * @since   2.0.0-dev
   *
   * @throws  \Exception
   *            - In case that the requested configuration, is not valid.
   */
  public function Configure(array $configuration)
  {
    if (isset($configuration['Service']['Format'])) {
      $validServiceFormat = in_array (
        strtoupper($configuration['Service']['Format']),
        self::$_sdkInformation['Service']['Format']
      );

      if (!$validServiceFormat) {
        throw new \Exception('Service format is not supported by this SDK.');
      }
    }

    $this->_configuration = $configuration;

    return $this;
  }

  /**
   * Executes the requested API operation.
   *
   * @param   string $entity
   *            - The entity to be used. (Required)
   *
   * @param   string $action
   *            - The action to be used. (Required)
   *
   * @param   array $data
   *            - The data to be used. (Optional, [])
   *
   * @since   2.1.0-dev
   *
   * @throws  \Exception
   *            - In case that is not possible to complete the requested API operation.
   */
  public function Execute($entity, $action, array $data = [])
  {
    list($endpoint, $data) = $this->_GetEndpointAndData($entity, $action, $data);

    $headerList = $this->_GetHeaderList();

    if ($this->_AuthRequired($entity, $action)) {
      $this->_Sign($entity, $action, $headerList, $data);
    }

    $requestMethod = $this->_GetRequestMethod($entity, $action);

    if (!method_exists($this, $requestMethod)) {
      throw new \Exception (
        sprintf('Entity "%s" with action "%s", does not exist.', $entity, $action)
      );
    }

    return $this->_GetDecodedResponse (
      $this->$requestMethod($endpoint, $headerList, $data)
    );
  }

  /**
   * Returns the configuration that is being used by the SDK.
   *
   * @return  array
   *
   * @since   2.0.0-dev
   */
  public function GetConfiguration()
  {
    return $this->_configuration;
  }

  /**
   * Returns the list of the available document search source options.
   *
   * @return  array
   *
   * @since   2.0.0-dev
   */
  public function GetDocumentSearchSourceOptionList()
  {
    $sourceOptionList =
      $this->_hypermedia
        ['Document']
        ['Search']
        ['Request']
        ['ParameterList']
        ['Source']
        ['List'];

    asort($sourceOptionList);

    return $sourceOptionList;
  }

  /**
   * Returns the SDK's version.
   *
   * @return  string
   *
   * @since   2.0.0-dev
   */
  public function GetSdkVersion()
  {
    return sprintf (
      '%d.%d.%d-%s',
      self::$_sdkInformation['Version']['Major'],
      self::$_sdkInformation['Version']['Minor'],
      self::$_sdkInformation['Version']['Patch'],
      self::$_sdkInformation['Version']['Extra']
    );
  }

  /**
   * Returns the SDK's full version.
   *
   * @return  string
   *
   * @since   2.0.0-dev
   */
  public function GetSdkVersionFull()
  {
    return sprintf (
      '%s (%s)', $this->GetSdkVersion(), self::$_sdkInformation['Version']['Release']
    );
  }

  /**
   * Returns the service hypermedia information.
   *
   * @return  array
   *
   * @since   2.0.0-dev
   */
  public function GetServiceHypermediaInformation()
  {
    return $this->_hypermedia;
  }
}
