<?php

namespace Epignosis\Abstraction;

use Epignosis\Auth\Abstraction\AuthInterface;
use Epignosis\Client\Abstraction\ClientInterface;
use Epignosis\Server\Abstraction\ServerInterface;
use Epignosis\Factory\Auth as AuthFactory;
use Epignosis\Factory\Client as ClientFactory;
use Epignosis\Factory\Server as ServerFactory;
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
  private $_authFactory = null;

  /**
   * The client factory.
   *
   * @default null
   * @since   1.0.0-dev
   * @var     ClientFactory
   */
  private $_clientFactory = null;

  /**
   * The configuration.
   *
   * @default []
   * @since   1.0.0-dev
   * @var     array
   */
  private $_configuration = [];

  /**
   * The server factory.
   *
   * @default null
   * @since   1.0.0-dev
   * @var     ServerFactory
   */
  private $_serverFactory = null;


  /**
   * Returns the configuration of the full-text search document SDK and its service.
   *
   * @return  array
   *
   * @since   1.0.0-dev
   */
  abstract protected function _GetConfigurationSdkService();

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
  private function _GetAuthInterface()
  {
    try {
      return $this->_authFactory->GetCached (
        'Signature', $this->_configuration['Private']['Service']['Auth']
      );
    } catch (\Exception $exception) {
      throw new SdkException (
        SdkException::SDK_GET_AUTH_INTERFACE_FAILURE, $exception
      );
    }
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
    return
      (array) $this->_configuration['Public']['Client'] +
      (array) $this->_configuration['Private']['Sdk']['Client'];
  }

  /**
   * Returns the server interface.
   *
   * @return  ServerInterface
   *
   * @since   1.0.0-dev
   *
   * @throws  SdkException
   *            - In case that is not possible to return the server interface.
   */
  private function _GetServerInterface()
  {
    try {
      return $this->_serverFactory->GetCached('Http');
    } catch (\Exception $exception) {
      throw new SdkException (
        SdkException::SDK_GET_SERVER_INTERFACE_FAILURE, $exception
      );
    }
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
      return $this->_clientFactory->GetCached (
        'Http', $this->_GetClientInterfaceConfiguration()
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
   * @param   array $data
   *            - The data of the requested action. (Required)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   */
  protected function _GetConfigurationServiceAction($action, array $data)
  {
    $configuration = [
      'EndPoint' => $this->_GetServiceActionEndPoint($action),
      'HeaderList' => array_merge (
        $this->_configuration['Private']['Service']['HeaderList'],
        ['FTS-TIMESTAMP' => time()]
      )
    ];

    if ($this->_ServiceActionRequiresAuth($action)) {
      list($headerName, $headerValue) = $this->_GetAuthInterface()->GetSignedRequest (
        (array) $this->_configuration['Public']['Auth'],
        $this->_configuration['Private']['Service']['ActionList'][$action],
        ['Data' => $data, 'Action' => $configuration]
      );

      $configuration['HeaderList'][$headerName] = $headerValue;
    }

    return $configuration;
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
    $this->_serverFactory = new ServerFactory;

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
      'Public' => (array) $configuration
    ];

    return $this;
  }

  /**
   * Returns information regarding the requested notification event.
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  SdkException
   *            - In case that is not possible to return the information of the requested
   *              notification event.
   */
  public function GetNotificationEvent()
  {
    try {
      return $this->_GetServerInterface()->GetRequestInterface()->GetParameterList (
        $this->_GetAuthInterface()->AuthenticateServerRequest (
          $this->_GetServerInterface()->GetRequestInterface()
        )
      );
    } catch (\Exception $exception) {
      throw new SdkException (
        SdkException::SDK_GET_NOTIFICATION_EVENT_FAILURE, $exception
      );
    }
  }
}
