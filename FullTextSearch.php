<?php

class FullTextSearch
{
  private $_configuration = [];

  private $_error = [];

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

  private function _GetBody(array $configuration, $entity, $action, array $data = [])
  {
    return null;
  }

  private function _GetHeaderList (
    array $configuration,
          $entity,
          $action,
    array $data = [])
  {
    return [];
  }

  private function _GetHyperMedia(array $path = [])
  {
    return [];
  }

  private function _RequestDelete (
    array $configuration,
    array $headerList = [],
          $body = null)
  {
    return [];
  }

  private function _RequestGet (
    array $configuration,
    array $headerList = [],
          $body = null)
  {
    return [];
  }

  private function _RequestPost (
    array $configuration,
    array $headerList = [],
          $body = null)
  {
    return [];
  }

  private function _RequireAuth($entity, $action)
  {
    return true;
  }

  public function __construct(array $configuration = [])
  {
    $this->Configure($configuration);
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

  public function GetError()
  {
    return $this->_error;
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
