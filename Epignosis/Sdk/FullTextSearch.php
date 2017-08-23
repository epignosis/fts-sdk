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
      'IndexKey' => [
        'Success' => 'Data'
      ]
    ],
    'Version' => [
      'Extra' => 'dev',
      'Major' => 2,
      'Minor' => 0,
      'Patch' => 0,
      'Release' => '2017-MM-DD'
    ]
  ];


  public function __construct(array $configuration = [])
  {
    $this->Configure($configuration)->_BuildHypermedia();
  }

  private function _Auth($entity, $action, array &$headerList, array $data = [])
  {
    if (!function_exists('openssl_random_pseudo_bytes')) {
      throw new \Exception('Function "openssl_random_pseudo_bytes" does not exist.');
    }

    do {
      $randomToken = openssl_random_pseudo_bytes(16, $strong);
    } while (!$randomToken || !$strong);

    $authConfiguration = $this->_GetHypermedia([$entity, $action, 'General', 'Auth']);
    $keyList = $this->_configuration['Auth']['Key'];

    $headerList[$authConfiguration['Signature']['Name']] = sprintf (
      '%s;%s;%s',
      $keyList['Public'][$operationInformation['OperationType']],
      base64_encode($randomToken),
      base64_encode (
        hash_hmac (
          $this->_authConfiguration['HashAlgorithm'],
          $this->_GetArrayToString($this->_GetSortedArray($data)),
          $randomToken . $keyList['Private'][$operationInformation['OperationType']],
          true
        )
      )
    );

    return $this;
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

    $successIndexKey = self::$_sdkInformation['Hypermedia']['IndexKey']['Success'];

    if (!isset($response['Body'][$successIndexKey])) {
      throw new \Exception (
        sprintf (
          'Failed to download the service hypermedia file. (%s)', $response['Url']
        )
      );
    }

    return $response['Body'];
  }

  private function _GetArrayToString(array $array)
  {
    $string = null;

    foreach ($array as $key => $value) {
      $string .= $key . (is_array($value)) ? $this->_GetArrayToString($value) : $value;
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

  private function _GetHypermedia(array $path = [])
  {
    if (empty($path)) {
      return $this->_hypermedia;
    }

    // @todo Optimize ..
    $hypermediaSection = $this->_hypermedia;

    foreach ($path as $sectionKey) {
      $hypermediaSection = $hypermediaSection[$sectionKey];
    }

    return $hypermediaSection;
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
        sprintf('Failed to read the service hypermedia file. (%s)', $filePath)
      );
    }

    $successIndexKey = self::$_sdkInformation['Hypermedia']['IndexKey']['Success'];

    if ('JSON' == strtoupper($this->_configuration['Service']['Format'])) {
      $content = json_decode($content, true)[$successIndexKey];
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

  private function _RequestDelete($url, array $headerList = [])
  {
    $optionList = [
      'http' => [
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

  private function _RequestPost($url, array $headerList = [])
  {
    $optionList = [
      'http' => [
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

  public function AccountCreate(array $data)
  {
    $headerList = $this->_GetHeaderList();

    if ($this->_GetHypermedia(['Account', 'Create', 'General', 'AuthRequired'])) {
      $this->_Auth('Account', 'Create', $headerList, $data);
    }

    return $this->_GetDecodedResponse (
      $this->_RequestPost (
        $this->_GetHypermedia(['Account', 'Create', 'Request', 'EndPoint', 'Single']),
        $headerList
      )
    );
  }

  public function Configure(array $configuration)
  {
    $this->_configuration = $configuration;

    return $this;
  }

  public function DocumentDeIndex(array $data)
  {
    $headerList = $this->_GetHeaderList();

    if ($this->_GetHypermedia(['Document', 'DeIndex', 'General', 'AuthRequired'])) {
      $this->_Auth('Document', 'DeIndex', $headerList, $data);
    }

    return $this->_RequestDelete($headerList);
  }

  public function DocumentIndex(array $data)
  {
    $headerList = $this->_GetHeaderList();

    if ($this->_GetHypermedia(['Document', 'Index', 'General', 'AuthRequired'])) {
      $this->_Auth('Document', 'Index', $headerList, $data);
    }

    return $this->_RequestPost($headerList);
  }

  public function DocumentSearch(array $data)
  {
    $headerList = $this->_GetHeaderList();

    if ($this->_GetHypermedia(['Document', 'Search', 'General', 'AuthRequired'])) {
      $this->_Auth('Document', 'Search', $headerList, $data);
    }

    return $this->_RequestGet($headerList);
  }

  public function GetAccountCreateStatusList()
  {
    return $this->_GetHypermedia ([
      'Account', 'Create', 'Request', 'ParameterList', 'Status', 'List'
    ]);
  }

  public function GetConfiguration()
  {
    return $this->_configuration;
  }

  public function GetDocumentSearchSourceOptionList()
  {
    return $this->_GetHypermedia ([
      'Document', 'Search', 'Request', 'ParameterList', 'Source', 'List'
    ]);
  }

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

  public function GetSdkVersionFull()
  {
    return sprintf (
      '%s (%s)', $this->GetSdkVersion(), self::$_sdkInformation['Version']['Release']
    );
  }

  public function PermissionPolicyDelete(array $data)
  {
    $headerList = $this->_GetHeaderList();

    if ($this->_GetHypermedia(['PermissionPolicy', 'Delete', 'General', 'AuthRequired']))
    {
      $this->_Auth('PermissionPolicy', 'Delete', $headerList, $data);
    }

    return $this->_RequestDelete($headerList);
  }

  public function PermissionPolicyPush(array $data)
  {
    $headerList = $this->_GetHeaderList();

    if ($this->_GetHypermedia(['PermissionPolicy', 'Push', 'General', 'AuthRequired'])) {
      $this->_Auth('PermissionPolicy', 'Push', $headerList, $data);
    }

    return $this->_RequestPost($headerList);
  }
}
