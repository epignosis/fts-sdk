<?php

namespace Epignosis\Failure;

/**
 * Trait EpignosisSdkTrait
 *
 * This trait, provides to any exception, the basic exception functionality.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Failure
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Failure
 * @since       1.0.0-dev
 */
trait EpignosisSdkTrait
{
  /**
   * The list of failure messages.
   *
   * @default []
   * @since   1.0.0-dev
   * @var     array
   */
  protected static $_failureMessageList = [];

  /**
   * The additional failure information.
   *
   * @default []
   * @since   1.0.0-dev
   * @var     array
   */
  protected $_additionalFailureInformation = [];

  /**
   * The time (Unix Epoch Timestamp), at which the failure was occurred.
   *
   * @default 0
   * @since   1.0.0-dev
   * @var     int
   */
  protected $_timestamp = 0;


  /**
   * Returns the additional failure information.
   *
   * @return  array
   *
   * @since   1.0.0-dev
   */
  public function GetAdditionalFailureInformation()
  {
    return $this->_additionalFailureInformation;
  }

  /**
   * Returns the failure message of the requested failure code.
   *
   * @param   int $code
   *            - The failure code. (Required)
   *
   * @return  string
   *
   * @since   1.0.0-dev
   */
  public function GetFailureMessage($code)
  {
    return
      isset(self::$_failureMessageList[$code])
        ? self::$_failureMessageList[$code]
        : 'EXCEPTION_UNKNOWN';
  }

  /**
   * Returns the failure message list.
   *
   * @return  array
   *
   * @since   1.0.0-dev
   */
  public function GetFailureMessageList()
  {
    return self::$_failureMessageList;
  }

  /**
   * Returns the original exception.
   *
   * @return  \Exception
   *
   * @since   1.0.0-dev
   */
  public function GetOriginalException()
  {
    /** @var $originalException \Exception */
    $originalException = $this;

    while ($originalException->getPrevious()) {
      $originalException = $originalException->getPrevious();
    }

    return $originalException;
  }

  /**
   * Returns the time (Unix Epoch Timestamp), at which the failure was occurred.
   *
   * @return  int
   *
   * @since   1.0.0-dev
   */
  public function GetTimestamp()
  {
    return $this->_timestamp;
  }
}
