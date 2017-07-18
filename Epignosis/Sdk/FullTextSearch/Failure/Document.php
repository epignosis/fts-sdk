<?php

namespace Epignosis\Sdk\FullTextSearch\Failure;

use Epignosis\Failure\EpignosisSdkTrait;

/**
 * Class Document
 *
 * The Document FullTextSearch SDK exception.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Sdk\FullTextSearch\Failure
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Sdk\FullTextSearch\Failure
 * @since       1.0.0-dev
 */
class Document extends \Exception
{
  use EpignosisSdkTrait;


  /**
   * Used in case that is not possible to successfully complete, the creation of the
   * requested document.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const FTS_CREATE_FAILURE = 1;

  /**
   * Used in case that is not possible to successfully complete, the deletion of the
   * requested document.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const FTS_DELETE_FAILURE = 2;

  /**
   * Used in case that is not possible to successfully complete, the retrieval of the
   * requested document.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const FTS_RETRIEVE_FAILURE = 3;

  /**
   * Used in case that is not possible to successfully complete, the update of the
   * requested document.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const FTS_UPDATE_FAILURE = 4;


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

    self::$_failureMessageList[self::FTS_CREATE_FAILURE] =
      'FTS_CREATE_FAILURE';

    self::$_failureMessageList[self::FTS_DELETE_FAILURE] =
      'FTS_DELETE_FAILURE';

    self::$_failureMessageList[self::FTS_RETRIEVE_FAILURE] =
      'FTS_RETRIEVE_FAILURE';

    self::$_failureMessageList[self::FTS_UPDATE_FAILURE] =
      'FTS_UPDATE_FAILURE';

    $this->_additionalFailureInformation = $additionalFailureInformation;

    parent::__construct($this->GetFailureMessage($code), $code, $exception);
  }
}
