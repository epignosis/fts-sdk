<?php

class FullTextSearch
{
  private $_configuration = [];

  private $_hyperMedia = [];

  private $_sdkInformation = [
    'Agent' => [
      'Epignosis/PHP_SDK; v{{VERSION_FULL}}'
    ],
    'Version' => [
      'Extra' => 'dev',
      'Major' => 2,
      'Minor' => 0,
      'Patch' => 0,
      'Release' => '2017-08-31'
    ]
  ];


  private function _Auth(array $configuration, array &$headerList, $body = null)
  {

  }

  private function _BuildHyperMedia(array $configuration)
  {
    $filePath = $this->_GetHyperMediaFilePath($configuration);

    if (!file_exists($filePath)) {
      if (!$this->_SaveFile($filePath, $this->_DownloadHyperMediaFile($configuration))) {
        throw new \Exception (
          sprintf('Failed to save the service hypermedia file. (%s)', $filePath)
        );
      }
    }

    $content = file_get_contents($filePath);

    if (false === $content) {
      $this->_DeleteFile($filePath);

      throw new \Exception (
        sprintf('Failed to read the service hypermedia file. (%s)', $filePath)
      );
    }

    $content = json_decode($content, true)['Data'];

    if (null === $content) {
      $this->_DeleteFile($filePath);

      throw new \Exception (
        sprintf('Failed to parse the service hypermedia file. (%s)', $filePath)
      );
    }

    $this->_hyperMedia = $content;

    return $this;
  }

  private function _DeleteFile($filePath)
  {
    unlink($filePath);

    return $this;
  }

  private function _DownloadHyperMediaFile(array $configuration)
  {
    $response = $this->_RequestOptions (
      $configuration['Service']['BaseEndpoint'], $configuration
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

  private function _GetBody(array $configuration, $entity, $action, array $data = [])
  {
    return serialize([$configuration, $entity, $action, $data]);
  }

  private function _GetHeaderList (
    array $configuration,
          $entity,
          $action,
    array $data = [])
  {
    return [$configuration, $entity, $action, $data];
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

  private function _GetHyperMediaFilePath(array $configuration)
  {
    $storageDirectory = __DIR__;

    if (!empty($configuration['Service']['Storage']['FilePath'])) {
      $storageDirectory = rtrim($configuration['Service']['Storage']['FilePath'], '\/');
    }

    $storageDirectory = rtrim($storageDirectory, '\/') . \DIRECTORY_SEPARATOR;
    $storageDirectory = str_replace(['\\', '/'], \DIRECTORY_SEPARATOR, $storageDirectory);

    return sprintf (
      '%sv%d.%s',
      $storageDirectory,
      (int) $configuration['Service']['Version'],
      strtolower($configuration['Service']['Format'])
    );
  }

  private function _GetAcceptanceHeaderString(array $configuration)
  {
    return
      sprintf (
        'Accept: %s',
        sprintf (
          $configuration['Service']['Header']['Accept'],
          (int) $configuration['Service']['Version'],
          strtolower($configuration['Service']['Format'])
        )
      ) .
      "\n" .
      sprintf (
        'Accept-Language: %s',
        sprintf (
          $configuration['Service']['Header']['AcceptLanguage'],
          strtolower($configuration['Service']['Language'])
        )
      ) .
      "\n";
  }

  private function _Request($url, array $configuration, array $optionList = [])
  {
    $optionList['http']['ignore_errors'] = true;

    $optionList['http']['header'] =
      rtrim($optionList['http']['header']) .
      $this->_GetAcceptanceHeaderString($configuration);

    $responseCode = null;
    $response = file_get_contents($url, false, stream_context_create($optionList));

    foreach ($http_response_header as $header) {
      if (preg_match('#HTTP/[0-9\.]+\s+([0-9]+)#', $header, $match)) {
        $responseCode = intval($match[1]);
      }
    }

    return ['Body' => $response, 'Status' => $responseCode, 'Url' => $url];
  }

  private function _RequestDelete (
    array $configuration,
    array $headerList = [],
          $body = null)
  {
    return $this->_Request([$configuration, $headerList, $body]);
  }

  private function _RequestGet(array $configuration, array $headerList = [])
  {
    return $this->_Request([$configuration, $headerList]);
  }

  private function _RequestOptions($url, array $configuration)
  {
    return $this->_Request($url, $configuration, ['http' => ['method' => 'OPTIONS']]);
  }

  private function _RequestPost (
    array $configuration,
    array $headerList = [],
          $body = null)
  {
    return $this->_Request([$configuration, $headerList, $body]);
  }

  private function _RequireAuth($entity, $action)
  {
    return true;
  }

  private function _SaveFile($filePath, $fileContent)
  {
    $filePathDirectory = dirname($filePath);

    if (!file_exists($filePathDirectory)) {
      $mode = substr(sprintf('%o', fileperms(dirname($filePathDirectory))), -4);

      if (!mkdir($filePathDirectory, $mode, true)) {
        return false;
      }
    }

    return file_put_contents($filePath, $fileContent);
  }

  public function __construct(array $configuration = [])
  {
    $this->_BuildHyperMedia($configuration)->Configure($configuration);
  }

  public function AccountCreate(array $data)
  {
    $headerList = $this->_GetHeaderList (
      $this->_configuration, 'Account', 'Create', $data
    );

    $body = $this->_GetBody (
      $this->_configuration, 'Account', 'Create', $data
    );

    if ($this->_RequireAuth('Account', 'Create')) {
      $this->_Auth($this->_configuration, $headerList, $body);
    }

    return $this->_RequestPost($this->_configuration, $headerList, $body);
  }

  public function Configure(array $configuration)
  {
    $this->_configuration = $configuration;

    return $this;
  }

  public function DocumentDeIndex(array $data)
  {
    $headerList = $this->_GetHeaderList (
      $this->_configuration, 'Document', 'DeIndex', $data
    );

    $body = $this->_GetBody (
      $this->_configuration, 'Document', 'DeIndex', $data
    );

    if ($this->_RequireAuth('Document', 'DeIndex')) {
      $this->_Auth($this->_configuration, $headerList, $body);
    }

    return $this->_RequestDelete($this->_configuration, $headerList, $body);
  }

  public function DocumentIndex(array $data)
  {
    $headerList = $this->_GetHeaderList (
      $this->_configuration, 'Document', 'Index', $data
    );

    $body = $this->_GetBody (
      $this->_configuration, 'Document', 'Index', $data
    );

    if ($this->_RequireAuth('Document', 'Index')) {
      $this->_Auth($this->_configuration, $headerList, $body);
    }

    return $this->_RequestPost($this->_configuration, $headerList, $body);
  }

  public function DocumentSearch(array $data)
  {
    $headerList = $this->_GetHeaderList (
      $this->_configuration, 'Document', 'Search', $data
    );

    if ($this->_RequireAuth('Document', 'Search')) {
      $this->_Auth($this->_configuration, $headerList);
    }

    return $this->_RequestGet($this->_configuration, $headerList);
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

  public function GetSdkInformation()
  {
    return $this->_sdkInformation;
  }

  public function GetSdkVersion()
  {
    return $this->_sdkInformation['Version'];
  }

  public function GetSdkVersionFull()
  {
    return sprintf (
      '%d.%d.%d-%s (%s)',
      $this->_sdkInformation['Version']['Major'],
      $this->_sdkInformation['Version']['Minor'],
      $this->_sdkInformation['Version']['Patch'],
      $this->_sdkInformation['Version']['Extra'],
      $this->_sdkInformation['Version']['Release']
    );
  }

  public function GetServiceHyperMedia()
  {
    return $this->_GetHyperMedia();
  }

  public function GetServiceHyperMediaAccount()
  {
    return $this->_GetHyperMedia(['Account']);
  }

  public function GetServiceHyperMediaDocument()
  {
    return $this->_GetHyperMedia(['Document']);
  }

  public function GetServiceHyperMediaPermissionPolicy()
  {
    return $this->_GetHyperMedia(['PermissionPolicy']);
  }

  public function PermissionPolicyDelete(array $data)
  {
    $headerList = $this->_GetHeaderList (
      $this->_configuration, 'PermissionPolicy', 'Delete', $data
    );

    $body = $this->_GetBody (
      $this->_configuration, 'PermissionPolicy', 'Delete', $data
    );

    if ($this->_RequireAuth('PermissionPolicy', 'Delete')) {
      $this->_Auth($this->_configuration, $headerList, $body);
    }

    return $this->_RequestDelete($this->_configuration, $headerList, $body);
  }

  public function PermissionPolicyPush(array $data)
  {
    $headerList = $this->_GetHeaderList (
      $this->_configuration, 'PermissionPolicy', 'Push', $data
    );

    $body = $this->_GetBody (
      $this->_configuration, 'PermissionPolicy', 'Push', $data
    );

    if ($this->_RequireAuth('PermissionPolicy', 'Push')) {
      $this->_Auth($this->_configuration, $headerList, $body);
    }

    return $this->_RequestPost($this->_configuration, $headerList, $body);
  }
}
