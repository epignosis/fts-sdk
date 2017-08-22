<?php

class FullTextSearch
{
  private $_configuration = [];

  private $_hyperMedia = [];

  private static $_sdkInformation = [
    'Agent' => 'Epignosis/PHP_SDK; v%s',
    'HyperMedia' => [
      'IndexKey' => [
        'Data' => 'Data'
      ]
    ],
    'Version' => [
      'Extra' => 'dev',
      'Major' => 2,
      'Minor' => 0,
      'Patch' => 0,
      'Release' => '2017-08-31'
    ]
  ];


  public function __construct(array $configuration = [])
  {
    $this->Configure($configuration)->_BuildHyperMedia();
  }

  private function _Auth($entity, $action, array &$headerList)
  {
    if (!function_exists('openssl_random_pseudo_bytes')) {
      throw new \Exception('Function "openssl_random_pseudo_bytes" does not exist.');
    }

    do {
      $randomToken = openssl_random_pseudo_bytes(16, $strong);
    } while (!$randomToken || !$strong);

    $authConfiguration = $this->_GetHyperMedia([$entity, $action, 'General', 'Auth']);
    $keyList = $this->_configuration['Auth']['Key'];

    $signature = sprintf (
      '%s;%s;%s',
      $keyList['Public'][$operationInformation['OperationType']],
      base64_encode($randomToken),
      base64_encode (
        hash_hmac (
          $this->_authConfiguration['HashAlgorithm'],
          serialize($this->_GetSortedArray($data)),
          $randomToken .
          $keyList['Private'][$operationInformation['OperationType']],
          true
        )
      )
    );

    $headerList[$authConfiguration['Signature']['Name']] = $signature;

    return $this;
  }

  private function _BuildHyperMedia()
  {
    $filePath = $this->_GetHyperMediaFilePath();

    $this->_CreateHyperMediaFile($filePath, false);

    $this->_hyperMedia = $this->_ReadHyperMediaFile($filePath);

    return $this;
  }

  private function _CreateHyperMediaFile($filePath, $force = false)
  {
    if ($force || !file_exists($filePath)) {
      if (!$this->_SaveFile($filePath, $this->_DownloadHyperMediaFile())) {
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

  private function _DownloadHyperMediaFile()
  {
    $response = $this->_RequestOptions (
      $this->_configuration['Service']['BaseEndpoint'], $this->_GetHeaderList()
    );

    if (200 != $response['Status'] || isset($response['Body']['Error'])) {
      throw new \Exception (
        sprintf (
          'Failed to download the service hypermedia file. (%s)', $response['Url']
        )
      );
    }

    return $response['Body'];
  }

  private function _GetDecodedResponse(array $response = [])
  {
    if ('JSON' == strtoupper($this->_configuration['Service']['Format'])) {
      return json_decode($response['Body'], true);
    }

    return $response['Body'];
  }

  private function _GetHeaderList($entity = null, $action = null, array $data = [])
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

  private function _GetHyperMedia(array $path = [])
  {
    if (empty($path)) {
      return $this->_hyperMedia;
    }

    $hyperMediaSection = $this->_hyperMedia;

    foreach ($path as $sectionKey) {
      $hyperMediaSection = $hyperMediaSection[$sectionKey];
    }

    return $hyperMediaSection;
  }

  private function _GetHyperMediaFilePath()
  {
    $storageDirectory = __DIR__;

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

  private function _GetSortedArray(array $data = [])
  {
    ksort($data);

    foreach ($data as $key => $value) {
      if (is_array($value)) {
        $data[$key] = $this->_GetSortedArray($value);
      }
    }

    return $data;
  }

  private function _ReadHyperMediaFile($filePath)
  {
    $content = file_get_contents($filePath);

    if (false === $content) {
      $this->_DeleteFile($filePath);

      throw new \Exception (
        sprintf('Failed to read the service hypermedia file. (%s)', $filePath)
      );
    }

    $dataIndexKey = self::$_sdkInformation['HyperMedia']['IndexKey']['Data'];

    if ('JSON' == strtoupper($this->_configuration['Service']['Format'])) {
      $content = json_decode($content, true)[$dataIndexKey];
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
    $headerList = $this->_GetHeaderList('Account', 'Create', $data);

    if ($this->_GetHyperMedia(['Account', 'Create', 'General', 'AuthRequired'])) {
      $this->_Auth('Account', 'Create', $headerList);
    }

    echo '<pre>'; print_r($headerList);exit;

    return $this->_GetDecodedResponse (
      $this->_RequestPost (
        $this->_GetHyperMedia(['Account', 'Create', 'Request', 'EndPoint', 'Single']),
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
    $headerList = $this->_GetHeaderList('Document', 'DeIndex', $data);

    if ($this->_GetHyperMedia(['Document', 'DeIndex', 'General', 'AuthRequired'])) {
      $this->_Auth('Document', 'DeIndex', $headerList);
    }

    return $this->_RequestDelete($headerList);
  }

  public function DocumentIndex(array $data)
  {
    $headerList = $this->_GetHeaderList('Document', 'Index', $data);

    if ($this->_GetHyperMedia(['Document', 'Index', 'General', 'AuthRequired'])) {
      $this->_Auth('Document', 'Index', $headerList);
    }

    return $this->_RequestPost($headerList);
  }

  public function DocumentSearch(array $data)
  {
    $headerList = $this->_GetHeaderList('Document', 'Search', $data);

    if ($this->_GetHyperMedia(['Document', 'Search', 'General', 'AuthRequired'])) {
      $this->_Auth('Document', 'Search', $headerList);
    }

    return $this->_RequestGet($headerList);
  }

  public function GetAccountCreateStatusList()
  {
    return $this->_GetHyperMedia ([
      'Account', 'Create', 'Request', 'ParameterList', 'Status', 'List'
    ]);
  }

  public function GetConfiguration()
  {
    return $this->_configuration;
  }

  public function GetDocumentSearchSourceOptionList()
  {
    return $this->_GetHyperMedia ([
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
    $headerList = $this->_GetHeaderList('PermissionPolicy', 'Delete', $data);

    if ($this->_GetHyperMedia(['PermissionPolicy', 'Delete', 'General', 'AuthRequired']))
    {
      $this->_Auth('PermissionPolicy', 'Delete', $headerList);
    }

    return $this->_RequestDelete($headerList);
  }

  public function PermissionPolicyPush(array $data)
  {
    $headerList = $this->_GetHeaderList('PermissionPolicy', 'Push', $data);

    if ($this->_GetHyperMedia(['PermissionPolicy', 'Push', 'General', 'AuthRequired'])) {
      $this->_Auth('PermissionPolicy', 'Push', $headerList);
    }

    return $this->_RequestPost($headerList);
  }
}
