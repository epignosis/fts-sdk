<?php

namespace Epignosis\Sdk\FullTextSearch\Failure;

use Epignosis\Failure\Sdk;

/**
 * Class Administration
 *
 * The administration FullTextSearch SDK exception.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Sdk\FullTextSearch\Failure
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Sdk\FullTextSearch\Failure
 * @since       1.0.0-dev
 */
class Administration extends Sdk
{
  /**
   * Used in case that is not possible to create the requested account(s).
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const SDK_FTS_ADMINISTRATION_ACCOUNT_CREATE_FAILURE = 7;


  /**
   * Document constructor.
   *
   * @param   int $code
   *            - The failure code. (Required)
   *
   * @param   \Exception|null $exception
   *            - The previous exception (if any), used for the exception chaining.
   *              (Optional, null)
   *
   * @param   array $additionalFailureInformation
   *            - The additional failure information. (Optional, [])
   *
   * @since   1.0.0-dev
   */
  public function __construct (
               $code,
    \Exception $exception = null,
         array $additionalFailureInformation = [])
  {
    $this->_timestamp = time();

    self::$_failureMessageList[self::SDK_FTS_DOCUMENT_CREATE_FAILURE] =
      'SDK_FTS_DOCUMENT_CREATE_FAILURE';

    self::$_failureMessageList[self::SDK_FTS_DOCUMENT_DELETE_FAILURE] =
      'SDK_FTS_DOCUMENT_DELETE_FAILURE';

    self::$_failureMessageList[self::SDK_FTS_DOCUMENT_SEARCH_FAILURE] =
      'SDK_FTS_DOCUMENT_SEARCH_FAILURE';

    self::$_failureMessageList[self::SDK_FTS_DOCUMENT_UPDATE_FAILURE] =
      'SDK_FTS_DOCUMENT_UPDATE_FAILURE';

    $this->_additionalFailureInformation = $additionalFailureInformation;

    parent::__construct($code, $exception, $additionalFailureInformation);
  }
}
