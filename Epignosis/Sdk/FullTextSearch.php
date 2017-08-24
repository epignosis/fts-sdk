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
      'ResponseIndexKey' => 'Data'
    ],
    'Version' => [
      'Extra' => 'dev',
      'Major' => 2,
      'Minor' => 0,
      'Patch' => 0,
      'Release' => '2017-08-31'
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
    if (!$this->_SaveFile($filePath, $this->_DownloadServiceHypermediaFile())) {
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

    if (200 != $response['Status']) {
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
        $this->_configuration['Service']['Header']['Accept'],
        (int) $this->_configuration['Service']['Version'],
        strtolower($this->_configuration['Service']['Format'])
      ),
      'Accept-Language' =>  sprintf (
        $this->_configuration['Service']['Header']['AcceptLanguage'],
        strtolower($this->_configuration['Service']['Language'])
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

  private function _GetRandomStringSecure($length = 16)
  {
    if (!function_exists('openssl_random_pseudo_bytes')) {
      throw new \Exception('Function "openssl_random_pseudo_bytes" does not exist.');
    }

    do {
      $randomString = openssl_random_pseudo_bytes($length, $strong);
    } while (!$randomString || !$strong);

    return $randomString;
  }

  private function _GetResponseStatusCode(array $headerList = [])
  {
    foreach ($headerList as $header) {
      if (preg_match('#HTTP/[0-9\.]+\s+([0-9]+)#', $header, $match)) {
        return intval($match[1]);
      }
    }

    return null;
  }

  private function _GetServiceHypermediaFilePath()
  {
    $storageDirectory = dirname(dirname(__DIR__));

    if (!empty($this->_configuration['Service']['Storage']['FilePath'])) {
      $storageDirectory = $this->_configuration['Service']['Storage']['FilePath'];
    }

    $storageDirectory = rtrim($storageDirectory, '\/') . \DIRECTORY_SEPARATOR;
    $storageDirectory = str_replace(['\\', '/'], \DIRECTORY_SEPARATOR, $storageDirectory);

    return sprintf (
      '%sv%d.%s',
      $storageDirectory,
      (int) $this->_configuration['Service']['Version'],
      strtolower($this->_configuration['Service']['Format'])
    );
  }

  private function _ParseServiceHypermediaFile($filePath, $content)
  {
    $responseIndexKey = self::$_sdkInformation['Hypermedia']['ResponseIndexKey'];

    if ('JSON' == strtoupper($this->_configuration['Service']['Format'])) {
      $content = json_decode($content, true)[$responseIndexKey];
    }

    if (empty($content)) {
      $this->_DeleteFile($filePath);

      throw new \Exception (
        sprintf('Failed to parse the service hypermedia file. (%s)', $filePath)
      );
    }

    return $content;
  }

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
   * Signs a request.
   *
   * @param   string $entity
   *            - The entity to be used. (Required)
   *
   * @param   string $action
   *            - The action to be used. (Required)
   *
   * @param   array $headerList
   *            - The header list to be used. In this list, an extra header will be added.
   *              (Required)
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
   * Creates an account, on the full-text search service.
   *
   * @param   array $data
   *            - The acount data to be created. (Required)
   *
   * @return  array
   *
   * @since   2.0.0-dev
   *
   * @throws  \Exception
   *            - In case that is not possible to create the account.
   */
  public function AccountCreate(array $data)
  {
    list($endpoint, $data) = $this->_GetEndpointAndData (
      'PermissionPolicy', 'Push', $data
    );

    $headerList = $this->_GetHeaderList();

    if ($this->_AuthRequired('Account', 'Create')) {
      $this->_Sign('Account', 'Create', $headerList, $data);
    }

    return $this->_GetDecodedResponse($this->_RequestPost($endpoint, $headerList, $data));
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
   */
  public function Configure(array $configuration)
  {
    $this->_configuration = $configuration;

    return $this;
  }

  /**
   * De-indexes a single or multiple documents, from the full-text service.
   *
   * @param   array $data
   *            - The document(s) data to be de-indexed. (Required)
   *
   * @return  array
   *
   * @since   2.0.0-dev
   *
   * @throws  \Exception
   *            - In case that is not possible to de-index the document(s).
   */
  public function DocumentDeIndex(array $data)
  {
    list($endpoint, $data) = $this->_GetEndpointAndData (
      'PermissionPolicy', 'Push', $data
    );

    $headerList = $this->_GetHeaderList();

    if ($this->_AuthRequired('Document', 'DeIndex')) {
      $this->_Sign('Document', 'DeIndex', $headerList, $data);
    }

    return $this->_GetDecodedResponse (
      $this->_RequestDelete($endpoint, $headerList, $data)
    );
  }

  /**
   * Indexes a single or multiple documents, on the full-text service.
   *
   * @param   array $data
   *            - The document(s) data to be indexed. (Required)
   *
   * @return  array
   *
   * @since   2.0.0-dev
   *
   * @throws  \Exception
   *            - In case that is not possible to index the document(s).
   */
  public function DocumentIndex(array $data)
  {
    list($endpoint, $data) = $this->_GetEndpointAndData (
      'PermissionPolicy', 'Push', $data
    );

    $headerList = $this->_GetHeaderList();

    if ($this->_AuthRequired('Document', 'Index')) {
      $this->_Sign('Document', 'Index', $headerList, $data);
    }

    return $this->_GetDecodedResponse($this->_RequestPost($endpoint, $headerList, $data));
  }

  /**
   * Performs a search query for documents, on the full-text service.
   *
   * @param   array $data
   *            - The search query data to be used. (Required)
   *
   * @return  array
   *
   * @since   2.0.0-dev
   *
   * @throws  \Exception
   *            - In case that is not possible to perform a search query.
   */
  public function DocumentSearch(array $data)
  {
    list($endpoint, $data) = $this->_GetEndpointAndData (
      'PermissionPolicy', 'Push', $data
    );

    $headerList = $this->_GetHeaderList();

    if ($this->_AuthRequired('Document', 'Search')) {
      $this->_Sign('Document', 'Search', $headerList, $data);
    }

    return $this->_GetDecodedResponse($this->_RequestGet($endpoint, $headerList, $data));
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

  /**
   * Deletes a permission policy.
   *
   * @param   array $data
   *            - The permission policy data to be deleted. (Required)
   *
   * @return  array
   *
   * @since   2.0.0-dev
   *
   * @throws  \Exception
   *            - In case that is not possible to delete the permission policy.
   */
  public function PermissionPolicyDelete(array $data)
  {
    list($endpoint, $data) = $this->_GetEndpointAndData (
      'PermissionPolicy', 'Push', $data
    );

    $headerList = $this->_GetHeaderList();

    if ($this->_AuthRequired('PermissionPolicy', 'Delete')) {
      $this->_Sign('PermissionPolicy', 'Delete', $headerList, $data);
    }

    return $this->_GetDecodedResponse (
      $this->_RequestDelete($endpoint, $headerList, $data)
    );
  }

  /**
   * Pushes a permission policy. (Create / Update)
   *
   * @param   array $data
   *            - The permission policy data to be pushed. (Required)
   *
   * @return  array
   *
   * @since   2.0.0-dev
   *
   * @throws  \Exception
   *            - In case that is not possible to push the permission policy.
   */
  public function PermissionPolicyPush(array $data)
  {
    list($endpoint, $data) = $this->_GetEndpointAndData (
      'PermissionPolicy', 'Push', $data
    );

    $headerList = $this->_GetHeaderList();

    if ($this->_AuthRequired('PermissionPolicy', 'Push')) {
      $this->_Sign('PermissionPolicy', 'Push', $headerList, $data);
    }

    return $this->_GetDecodedResponse($this->_RequestPost($endpoint, $headerList, $data));
  }
}
