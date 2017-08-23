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
   *            - The configuration to be used. (Optional, [])
   *
   * @since   2.0.0-dev
   *
   * @throws  \Exception
   *            - In case that is not possible to build the service hypermedia file.
   */
  public function __construct(array $configuration = [])
  {
    $this->Configure($configuration)->_BuildHypermedia();
  }

  private function _BuildHypermedia()
  {
    $filePath = $this->_GetHypermediaFilePath();

    $this->_CreateHypermediaFile($filePath, false);

    $this->_hypermedia = $this->_ReadHypermediaFile($filePath);

    return $this;
  }

  private function _CreateHypermediaFile($filePath, $force = false)
  {
    if ($force || !file_exists($filePath)) {
      if (!$this->_SaveFile($filePath, $this->_DownloadHypermediaFile())) {
        throw new \Exception (
          sprintf('Failed to save the service hypermedia file. (%s)', $filePath)
        );
      }
    }
  }

  private function _DeleteFile($filePath)
  {
    unlink($filePath);

    return $this;
  }

  private function _DownloadHypermediaFile()
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

  private function _GetArrayToString(array $array = [])
  {
    $string = null;

    foreach ($array as $key => $value) {
      $string .= $key . (is_array($value) ? $this->_GetArrayToString($value) : $value);
    }

    return $string;
  }

  private function _GetDecodedResponse(array $response = [])
  {
    if ('JSON' == strtoupper($this->_configuration['Service']['Format'])) {
      return json_decode($response['Body'], true);
    }

    return $response['Body'];
  }

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

  private function _GetHypermediaFilePath()
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

  private function _GetSortedArray(array $array = [])
  {
    ksort($array);

    foreach ($array as $key => $value) {
      if (is_array($value)) {
        $array[$key] = $this->_GetSortedArray($value);
      }
    }

    return $array;
  }

  private function _ReadHypermediaFile($filePath)
  {
    $content = file_get_contents($filePath);

    if (false === $content) {
      $this->_DeleteFile($filePath);

      throw new \Exception (
        sprintf('Failed to read from the service hypermedia file. (%s)', $filePath)
      );
    }

    $responseIndexKey = self::$_sdkInformation['Hypermedia']['ResponseIndexKey'];

    if ('JSON' == strtoupper($this->_configuration['Service']['Format'])) {
      $content = json_decode($content, true)[$responseIndexKey];
    } else {
      // Do nothing ..
    }

    if (empty($content)) {
      $this->_DeleteFile($filePath);

      throw new \Exception (
        sprintf('Failed to parse the service hypermedia file. (%s)', $filePath)
      );
    }

    return $content;
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

  private function _RequestGet($url, array $headerList = [])
  {
    $optionList = [
      'http' => [
        'header' => $this->_GetHeaderListToString($headerList)
      ]
    ];

    return $this->_Request($url, $optionList);
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

  private function _SaveFile($filePath, $fileContent)
  {
    $filePathDirectory = dirname($filePath);

    if (!file_exists($filePathDirectory)) {
      $mode = $this->_configuration['Service']['Storage']['Mode'];

      if (!mkdir($filePathDirectory, $mode, true)) {
        return false;
      }
    }

    return file_put_contents($filePath, $fileContent, \LOCK_EX);
  }

  /**
   * Signs a request.
   *
   * @param   $entity
   *            - The entity to be used. (Required)
   *
   * @param   $action
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
          $this->_GetArrayToString($this->_GetSortedArray($data)),
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
   *            - The acount's data to be created. (Required)
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
    $headerList = $this->_GetHeaderList();

    if ($this->_hypermedia['Account']['Create']['General']['AuthRequired']) {
      $this->_Sign('Account', 'Create', $headerList, $data);
    }

    return $this->_GetDecodedResponse (
      $this->_RequestPost (
        $this->_hypermedia['Account']['Create']['Request']['EndPoint']['Single'],
        $headerList,
        $data
      )
    );
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
    $headerList = $this->_GetHeaderList();

    if ($this->_hypermedia['Document']['DeIndex']['General']['AuthRequired']) {
      $this->_Sign('Document', 'DeIndex', $headerList, $data);
    }

    return $this->_GetDecodedResponse (
      $this->_RequestDelete (
        1 < count($data)
          ? $this->_hypermedia['Document']['DeIndex']['Request']['EndPoint']['Multiple']
          : $this->_hypermedia['Document']['DeIndex']['Request']['EndPoint']['Single'],
        $headerList,
        $data
      )
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
    $headerList = $this->_GetHeaderList();

    if ($this->_hypermedia['Document']['Index']['General']['AuthRequired']) {
      $this->_Sign('Document', 'Index', $headerList, $data);
    }

    return $this->_RequestPost($headerList);
  }

  public function DocumentSearch(array $data)
  {
    $headerList = $this->_GetHeaderList();

    if ($this->_hypermedia['Document']['Search']['General']['AuthRequired']) {
      $this->_Sign('Document', 'Search', $headerList, $data);
    }

    return $this->_RequestGet($headerList);
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
    return
      $this->_hypermedia
        ['Document']
        ['Search']
        ['Request']
        ['ParameterList']
        ['Source']
        ['List'];
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

  public function PermissionPolicyDelete(array $data)
  {
    $headerList = $this->_GetHeaderList();

    if ($this->_hypermedia['PermissionPolicy']['Delete']['General']['AuthRequired']) {
      $this->_Sign('PermissionPolicy', 'Delete', $headerList, $data);
    }

    return $this->_RequestDelete($headerList);
  }

  public function PermissionPolicyPush(array $data)
  {
    $headerList = $this->_GetHeaderList();

    if ($this->_hypermedia['PermissionPolicy']['Push']['General']['AuthRequired']) {
      $this->_Sign('PermissionPolicy', 'Push', $headerList, $data);
    }

    return $this->_RequestPost($headerList);
  }
}
