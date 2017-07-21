<?php

namespace Epignosis\Abstraction;

use Epignosis\Auth\Abstraction\AuthInterface;
use Epignosis\Client\Abstraction\ClientInterface;
use Epignosis\Decoder\Abstraction\DecoderInterface;
use Epignosis\Factory\Auth as AuthFactory;
use Epignosis\Factory\Client as ClientFactory;
use Epignosis\Failure\Sdk as SdkException;

/**
 * Abstract Class AbstractSdk
 *
 * The abstract SDK class.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Abstraction
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Abstraction
 * @since       1.0.0-dev
 */
abstract class AbstractSdk
{
  /**
   * The auth factory.
   *
   * @default null
   * @since   1.0.0-dev
   * @var     AuthFactory
   */
  protected $_authFactory = null;

  /**
   * The client factory.
   *
   * @default null
   * @since   1.0.0-dev
   * @var     ClientFactory
   */
  protected $_clientFactory = null;

  /**
   * The configuration.
   *
   * @default []
   * @since   1.0.0-dev
   * @var     array
   */
  protected $_configuration = [];

  /**
   * The decoder factory.
   *
   * @default null
   * @since   1.0.0-dev
   * @var     DecoderInterface
   */
  protected $_decoderFactory = null;


  /**
   * Returns the configuration of the full-text search document SDK and its service.
   *
   * @return  array
   *
   * @since   1.0.0-dev
   */
  abstract protected function _GetConfigurationSdkService();

  /**
   * Returns the auth interface configuration.
   *
   * @return  array
   *
   * @since   1.0.0-dev
   */
  private function _GetAuthInterfaceConfiguration()
  {
    if (isset($this->_configuration['Private']['Sdk']['Auth']['Type'])) {
      $configuration['Type'] = $this->_configuration['Private']['Sdk']['Auth']['Type'];
    }

    if (isset($this->_configuration['Public']['Auth']['Type'])) {
      $configuration['Type'] = $this->_configuration['Public']['Auth']['Type'];
    }

    $configuration['Configuration'] =
      (array) $this->_configuration['Public']['Auth']['Configuration'] +
      (array) $this->_configuration['Private']['Sdk']['Auth']['Configuration'];

    return $configuration;
  }

  /**
   * Returns the client interface configuration.
   *
   * @return  array
   *
   * @since   1.0.0-dev
   */
  private function _GetClientInterfaceConfiguration()
  {
    if (isset($this->_configuration['Private']['Sdk']['Client']['Type'])) {
      $configuration['Type'] = $this->_configuration['Private']['Sdk']['Client']['Type'];
    }

    if (isset($this->_configuration['Public']['Client']['Type'])) {
      $configuration['Type'] = $this->_configuration['Public']['Client']['Type'];
    }

    $configuration['Configuration'] =
      (array) $this->_configuration['Public']['Client']['Configuration'] +
      (array) $this->_configuration['Private']['Sdk']['Client']['Configuration'];

    return $configuration;
  }

  /**
   * Returns the end-point of the requested service action.
   *
   * @param   string $action
   *            - The action to return its end-point. (Required)
   *
   * @return  string
   *
   * @since   1.0.0-dev
   */
  private function _GetServiceActionEndPoint($action)
  {
    $serviceConfiguration = $this->_configuration['Private']['Service'];

    return rtrim (
      sprintf (
        '%s/%s/',
        rtrim($serviceConfiguration['BaseEndPoint'], '/'),
        trim($serviceConfiguration['ActionList'][$action]['Path'], '/')
      ),
      '/'
    );
  }

  /**
   * Returns whether the requested service action requires authentication, or not.
   *
   * @param   string $action
   *            - The action to return its auth requirement. (Required)
   *
   * @return  bool
   *
   * @since   1.0.0-dev
   */
  private function _ServiceActionRequiresAuth($action)
  {
    $serviceConfiguration = $this->_configuration['Private']['Service'];

    if (isset($serviceConfiguration['ActionList'][$action]['Auth']['Status'])) {
      return (bool) $serviceConfiguration['ActionList'][$action]['Auth']['Status'];
    }

    return $serviceConfiguration['Auth']['Status'];
  }

  /**
   * Returns the auth interface.
   *
   * @return  AuthInterface
   *
   * @since   1.0.0-dev
   *
   * @throws  SdkException
   *            - In case that is not possible to return the auth interface.
   */
  protected function _GetAuthInterface()
  {
    try {
      $authInterfaceConfiguration = $this->_GetAuthInterfaceConfiguration();

      if (isset($authInterfaceConfiguration['Type'])) {
        return $this->_authFactory->GetCached (
          $authInterfaceConfiguration['Type'],
          $authInterfaceConfiguration['Configuration']
        );
      }

      return $this->_authFactory->GetCachedDefault (
        $authInterfaceConfiguration['Configuration']
      );
    } catch (\Exception $exception) {
      throw new SdkException (
        SdkException::SDK_GET_AUTH_INTERFACE_FAILURE, $exception
      );
    }
  }

  /**
   * Returns the client interface.
   *
   * @return  ClientInterface
   *
   * @since   1.0.0-dev
   *
   * @throws  SdkException
   *            - In case that is not possible to return the client interface.
   */
  protected function _GetClientInterface()
  {
    try {
      $clientInterfaceConfiguration = $this->_GetClientInterfaceConfiguration();

      if (isset($clientInterfaceConfiguration['Type'])) {
        return $this->_clientFactory->GetCached (
          $clientInterfaceConfiguration['Type'],
          $clientInterfaceConfiguration['Configuration']
        );
      }

      return $this->_clientFactory->GetCachedDefault (
        $clientInterfaceConfiguration['Configuration']
      );
    } catch (\Exception $exception) {
      throw new SdkException (
        SdkException::SDK_GET_CLIENT_INTERFACE_FAILURE, $exception
      );
    }
  }

  /**
   * Returns the configuration of the requested service action.
   *
   * @param   string $action
   *            - The action to return its configuration. (Required)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   */
  protected function _GetConfigurationServiceAction($action)
  {
    $serviceConfiguration = $this->_configuration['Private']['Service'];
    $headerList = $serviceConfiguration['HeaderList'];
    $actionRequiresAuth = $this->_ServiceActionRequiresAuth($action);

    if ($actionRequiresAuth) {
      $headerList[$serviceConfiguration['Auth']['HeaderName']] =
        $this->_GetAuthInterface()->AuthenticateRequest();
    }

    return [
      'EndPoint' => $this->_GetServiceActionEndPoint($action),
      'HeaderList' => $headerList,
      'RequiresAuth' => $actionRequiresAuth
    ];
  }

  /**
   * AbstractSdk constructor.
   *
   * @param   array $configuration
   *            - The configuration to be used. (Optional, [])
   *
   * @since   1.0.0-dev
   *
   * @throws  SdkException
   *            - In case that the PHP version is not supported (< 5.6.0).
   */
  public function __construct(array $configuration = [])
  {
    if (version_compare(PHP_VERSION, '5.6.0', '<')) {
      throw new SdkException(SdkException::SDK_REQUIREMENT_PHP_VERSION);
    }

    $this->_authFactory = new AuthFactory;
    $this->_clientFactory = new ClientFactory;

    $this->Configure($configuration);
  }

  /**
   * Configures the referenced SDK.
   *
   * @param   array $configuration
   *            - The configuration to be used. (Required)
   *
   * @return  AbstractSdk
   *
   * @since   1.0.0-dev
   */
  public function Configure(array $configuration)
  {
    $this->_configuration = [
      'Private' => $this->_GetConfigurationSdkService(),
      'Public' => $configuration
    ];

    return $this;
  }
}
