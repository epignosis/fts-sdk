<?php

namespace Epignosis\Logger;

use Epignosis\Logger\Abstraction\LoggerInterface;
use Epignosis\Logger\Failure\Logger as LoggerException;

/**
 * Class Memory
 *
 * The memory logger.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Logger
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Logger
 * @since       1.0.0-dev
 */
class Memory implements LoggerInterface
{
  /**
   * The log repository.
   *
   * @default []
   * @since   1.0.0-dev
   * @var     array
   */
  private $_log = [];


  /**
   * Clears the log.
   *
   * @return  LoggerInterface
   *
   * @since   1.0.0-dev
   *
   * @throws  LoggerException
   *            - In case that is not possible to clear the log.
   */
  public function ClearLog()
  {
    $this->_log = [];

    return $this;
  }

  /**
   * Returns the log.
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  LoggerException
   *            - In case that is not possible to return the log.
   */
  public function GetLog()
  {
    return $this->_log;
  }

  /**
   * Logs the requested message.
   *
   * @param   string $message
   *            - The message to be logged. (Required)
   *
   * @param   bool $success
   *            - Whether it is a successful log message, or not. (Optional, true)
   *
   * @param   bool $sensitive
   *            - Whether the requested message is sensitive, or not. (Optional, false)
   *
   * @return  LoggerInterface
   *
   * @since   1.0.0-dev
   *
   * @throws  LoggerException
   *            - In case that is not possible to log the requested information.
   */
  public function Log($message, $success = true, $sensitive = false)
  {
    $this->_log[] = [
      'Message' => $message,
      'Sensitive' => (bool) $sensitive,
      'Success' => (bool) $success
    ];

    return $this;
  }
}
