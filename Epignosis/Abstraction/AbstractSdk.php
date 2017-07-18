<?php

namespace Epignosis\Sdk\Abstraction;

use Epignosis\Auth\Abstraction\AuthInterface;
use Epignosis\Client\Abstraction\ClientInterface;
use Epignosis\Configuration\Abstraction\ConfigurationInterface;
use Epignosis\Decoder\Abstraction\DecoderInterface;
use Epignosis\Logger\Abstraction\LoggerInterface;
use Epignosis\Factory\Auth as AuthFactory;
use Epignosis\Factory\Client as ClientFactory;
use Epignosis\Factory\Logger as LoggerFactory;
use Epignosis\Failure\AbstractSdk as AbstractSdkException;

/**
 * Abstract Class AbstractSdk
 *
 * The abstract SDK class.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Sdk\Abstraction
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Sdk\Abstraction
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
   * The SDK configuration
   *
   * @default []
   * @since   1.0.0-dev
   * @var     array
   */
  protected $_configurationSdk = [];

  /**
   * The configuration interface.
   *
   * @default null
   * @since   1.0.0-dev
   * @var     ConfigurationInterface
   */
  protected $_configurationInterface = null;

  /**
   * The decoder factory.
   *
   * @default null
   * @since   1.0.0-dev
   * @var     DecoderInterface
   */
  protected $_decoderFactory = null;

  /**
   * The logger factory.
   *
   * @default null
   * @since   1.0.0-dev
   * @var     LoggerFactory
   */
  protected $_loggerFactory = null;


  protected function _GetConfigurationService($type, $operation)
  {
    $private = sprintf('Service.%s.Private.%s', $type, $operation);
    $public = sprintf('Service.%s.Public', $type);

    return
      $this->_configurationInterface->GetFromKey($private) +
      $this->_configurationInterface->GetFromKey($public);
  }

  abstract protected function _PrepareSdk();

  /**
   * Returns the auth interface.
   *
   * @return  AuthInterface
   *
   * @since   1.0.0-dev
   *
   * @throws  AbstractSdkException
   *            - In case that is not possible to return the auth interface.
   */
  protected function _GetAuthInterface()
  {
    try {
      try {
        return $this->_authFactory->GetCached (
          $this->_configurationInterface->GetFromKey('Auth.Type'),
          $this->_configurationInterface->GetFromKey('Auth.Configuration')
        );
      } catch (\Exception $exception) {
        return $this->_authFactory->GetDefaultCached();
      }
    } catch (\Exception $exception) {
      throw new AbstractSdkException (
        AbstractSdkException::SDK_GET_AUTH_INTERFACE_FAILURE, $exception
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
   * @throws  AbstractSdkException
   *            - In case that is not possible to return the client interface.
   */
  protected function _GetClientInterface()
  {
    try {
      try {
        return $this->_clientFactory->GetCached (
          $this->_configurationInterface->GetFromKey('Client.Type'),
          $this->_configurationInterface->GetFromKey('Client.Configuration')
        );
      } catch (\Exception $exception) {
        return $this->_clientFactory->GetDefaultCached();
      }
    } catch (\Exception $exception) {
      throw new AbstractSdkException (
        AbstractSdkException::SDK_GET_CLIENT_INTERFACE_FAILURE, $exception
      );
    }
  }

  protected function _GetDecodedResponse($data = null, array $optionList = [])
  {
    return [];
  }

  /**
   * Returns the logger interface.
   *
   * @return  LoggerInterface
   *
   * @since   1.0.0-dev
   *
   * @throws  AbstractSdkException
   *            - In case that is not possible to return the logger interface.
   */
  protected function _GetLoggerInterface()
  {
    try {
      try {
        return $this->_factoryLogger->GetCached (
          $this->_configurationInterface->GetFromKey('Logger.Type'),
          $this->_configurationInterface->GetFromKey('Logger.Configuration')
        );
      } catch (\Exception $exception) {
        return $this->_factoryLogger->GetDefaultCached();
      }
    } catch (\Exception $exception) {
      throw new AbstractSdkException (
        AbstractSdkException::SDK_GET_LOGGER_INTERFACE_FAILURE, $exception
      );
    }
  }

  /**
   * Constructs the full-text search SDK.
   *
   * @param   ConfigurationInterface $configurationInterface
   *            - The configuration interface. (Required)
   *
   * @since   1.0.0-dev
   */
  public function __construct(ConfigurationInterface $configurationInterface)
  {
    $this->_authFactory = new AuthFactory;
    $this->_clientFactory = new ClientFactory;
    $this->_loggerFactory = new LoggerFactory;
    $this->_configurationInterface = $configurationInterface;
  }

  /**
   * Clears the log.
   *
   * @return  AbstractSdk
   *
   * @since   1.0.0-dev
   *
   * @throws  AbstractSdkException
   *            - In case that is not possible to clear the log.
   */
  public function ClearLog()
  {
    try {
      $this->_GetLoggerInterface()->ClearLog();
    } catch (\Exception $exception) {
      throw new AbstractSdkException (
        AbstractSdkException::SDK_CLEAR_LOG_FAILURE, $exception
      );
    }

    return $this;
  }

  /**
   * Configures the full-text search SDK.
   *
   * @param   array $configuration
   *            - The configuration to be used. (Required)
   *
   * @return  AbstractSdk
   *
   * @since   1.0.0-dev
   *
   * @throws  AbstractSdkException
   *            - In case that is not possible to configure the full-text search SDK.
   */
  public function Configure(array $configuration)
  {
    try {
      $this->_configurationInterface->Configure (
        $this->_GetSdkConfiguration() + $configuration
      );
    } catch (\Exception $exception) {
      throw new AbstractSdkException (
        AbstractSdkException::SDK_CONFIGURE_FAILURE,
        $exception,
        ['Configuration' => $configuration]
      );
    }

    return $this;
  }

  /**
   * Returns the log.
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  AbstractSdkException
   *            - In case that is not possible to return the log.
   */
  public function GetLog()
  {
    try {
      return $this->_GetLoggerInterface()->GetLog();
    } catch (\Exception $exception) {
      throw new AbstractSdkException (
        AbstractSdkException::SDK_GET_LOG_FAILURE, $exception
      );
    }
  }

  /**
   * Returns the the full-text search service notification event. DO NOT try to get any of
   * these notification events, without using this method, unless you know what you are
   * doing.
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  AbstractSdkException
   *            - In case that is not possible to return the notification event.
   */
  public function GetNotificationEvent()
  {
    try {
      $this->_GetAuthInterface()->AuthenticateServerResponse();


      return []; // @todo
    } catch (\Exception $exception) {
      throw new AbstractSdkException (
        AbstractSdkException::SDK_GET_NOTIFICATION_EVENT_FAILURE, $exception
      );
    }
  }
}
