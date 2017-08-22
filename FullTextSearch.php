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


  private function _Auth(array $configuration, array &$headerList, $body)
  {

  }

  private function _GetHeaderList (
    array $configuration,
          $entity,
          $action,
    array $data = [])
  {
    return [];
  }

  private function _GetBody(array $configuration, $entity, $action, array $data = [])
  {
    return null;
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

  }

  public function DocumentIndex(array $data)
  {

  }

  public function DocumentSearch(array $data)
  {

  }

  public function GetAccountStatusList()
  {

  }

  public function GetConfiguration()
  {
    return $this->_configuration;
  }

  public function GetDocumentSearchSourceOptionList()
  {

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

  }

  public function GetServiceHyperMediaAccount()
  {

  }

  public function GetServiceHyperMediaDocument()
  {

  }

  public function GetServiceHyperMediaPermissionPolicy()
  {

  }

  public function PermissionPolicyDelete(array $data)
  {

  }

  public function PermissionPolicyPush(array $data)
  {

  }
}
