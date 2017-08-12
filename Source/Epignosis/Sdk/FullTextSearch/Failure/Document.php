<?php

namespace Epignosis\Sdk\FullTextSearch\Failure;

use Epignosis\Failure\Sdk;

/**
 * Class Document
 *
 * The document FullTextSearch SDK exception.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Sdk\FullTextSearch\Failure
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Sdk\FullTextSearch\Failure
 * @since       1.0.0-dev
 */
class Document extends Sdk
{
  /**
   * Used in case that is not possible to de-index the requested document(s).
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const SDK_FTS_DOCUMENT_DEINDEX_FAILURE = 7;

  /**
   * Used in case that is not possible to index the requested document(s).
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const SDK_FTS_DOCUMENT_INDEX_FAILURE = 8;

  /**
   * Used in case that is not possible to search for documents.
   *
   * @since   1.0.0-dev
   * @var     int
   */
  const SDK_FTS_DOCUMENT_SEARCH_FAILURE = 9;


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

    self::$_failureMessageList[self::SDK_FTS_DOCUMENT_DEINDEX_FAILURE] =
      'SDK_FTS_DOCUMENT_DEINDEX_FAILURE';

    self::$_failureMessageList[self::SDK_FTS_DOCUMENT_INDEX_FAILURE] =
      'SDK_FTS_DOCUMENT_INDEX_FAILURE';

    self::$_failureMessageList[self::SDK_FTS_DOCUMENT_SEARCH_FAILURE] =
      'SDK_FTS_DOCUMENT_SEARCH_FAILURE';

    $this->_additionalFailureInformation = $additionalFailureInformation;

    parent::__construct($code, $exception, $additionalFailureInformation);
  }
}
