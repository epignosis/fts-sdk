<?php

namespace Epignosis\Sdk\Abstraction;

use Epignosis\Sdk\Factory\Auth as AuthFactory;
use Epignosis\Sdk\Factory\Client as ClientFactory;
use Epignosis\Sdk\Factory\Logger as LoggerFactory;
use Epignosis\Sdk\Failure\Sdk as SdkException;

/**
 * Abstract Class AbstractSdk
 *
 * The abstract SDK class.
 *
 * @application Epignosis SDK
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
   * The configuration interface.
   *
   * @default null
   * @since   1.0.0-dev
   * @var     ConfigurationInterface
   */
  protected $_configurationInterface = null;

  /**
   * The logger factory.
   *
   * @default null
   * @since   1.0.0-dev
   * @var     LoggerFactory
   */
  protected $_loggerFactory = null;


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
      try {
        return $this->_authFactory->GetCached (
          $this->_configurationInterface->GetByKey('Auth.Type'),
          $this->_configurationInterface->GetByKey('Auth.Configuration')
        );
      } catch (\Exception $exception) {
        return $this->_authFactory->GetDefaultCached();
      }
    } catch (\Exception $exception) {
      throw new SdkException(SdkException::SDK_GET_AUTH_INTERFACE_FAILURE, $exception);
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
      try {
        return $this->_clientFactory->GetCached (
          $this->_configurationInterface->GetByKey('Client.Type'),
          $this->_configurationInterface->GetByKey('Client.Configuration')
        );
      } catch (\Exception $exception) {
        return $this->_clientFactory->GetDefaultCached();
      }
    } catch (\Exception $exception) {
      throw new SdkException(SdkException::SDK_GET_CLIENT_INTERFACE_FAILURE, $exception);
    }
  }

  protected function _GetDecodedResponse($data = null, array $optionList= [])
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
   * @throws  SdkException
   *            - In case that is not possible to return the logger interface.
   */
  protected function _GetLoggerInterface()
  {
    try {
      try {
        return $this->_factoryLogger->GetCached (
          $this->_configurationInterface->GetByKey('Logger.Type'),
          $this->_configurationInterface->GetByKey('Logger.Configuration')
        );
      } catch (\Exception $exception) {
        return $this->_factoryLogger->GetDefaultCached();
      }
    } catch (\Exception $exception) {
      throw new SdkException(SdkException::SDK_GET_LOGGER_INTERFACE_FAILURE, $exception);
    }
  }

  /**
   * Constructs the full-text search SDK.
   *
   * @param   AuthFactory $authFactory
   *            - The auth factory. (Required)
   *
   * @param   ClientFactory $clientFactory
   *            - The client factory. (Required)
   *
   * @param   LoggerFactory $loggerFactory
   *            - The logger factory. (Required)
   *
   * @param   ConfigurationInterface $configurationInterface
   *            - The configuration interface. (Required)
   *
   * @since   1.0.0-dev
   */
  public function __construct (
               AuthFactory $authFactory,
             ClientFactory $clientFactory,
             LoggerFactory $loggerFactory,
    ConfigurationInterface $configurationInterface)
  {
    $this->_authFactory = $authFactory;
    $this->_clientFactory = $clientFactory;
    $this->_loggerFactory = $loggerFactory;
    $this->_configurationInterface = $configurationInterface;
  }

  /**
   * Clears the log.
   *
   * @return  FullTextSearch
   *
   * @since   1.0.0-dev
   *
   * @throws  SdkException
   *            - In case that is not possible to clear the log.
   */
  public function ClearLog()
  {
    try {
      $this->_GetLoggerInterface()->ClearLog();
    } catch (\Exception $exception) {
      throw new SdkException(SdkException::SDK_CLEAR_LOG_FAILURE, $exception);
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
   * @throws  SdkException
   *            - In case that is not possible to configure the full-text search SDK.
   */
  public function Configure(array $configuration)
  {
    try {
      $this->_configurationInterface->Configure (
        $configuration + $this->_configurationSdk
      );
    } catch (\Exception $exception) {
      throw new SdkException (
        SdkException::SDK_CONFIGURE_FAILURE,
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
   * @throws  SdkException
   *            - In case that is not possible to return the log.
   */
  public function GetLog()
  {
    try {
      return $this->_GetLoggerInterface()->GetLog();
    } catch (\Exception $exception) {
      throw new SdkException(SdkException::SDK_GET_LOG_FAILURE, $exception);
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
   * @throws  SdkException
   *            - In case that is not possible to return the notification event.
   */
  public function GetNotificationEvent()
  {
    try {
      // @todo
      return [];
    } catch (\Exception $exception) {
      throw new SdkException (
        SdkException::SDK_GET_NOTIFICATION_EVENT_FAILURE, $exception
      );
    }
  }
}
