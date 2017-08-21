<?php

namespace Epignosis\Sdk\FullTextSearch;

use Epignosis\Abstraction\AbstractSdk;
use Epignosis\Sdk\FullTextSearch\Failure\Document as SdkFtsDocumentException;

/**
 * Class Document
 *
 * The full-text search document SDK.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Sdk\FullTextSearch
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Sdk\FullTextSearch
 * @since       1.0.0-dev
 */
class Document extends AbstractSdk
{
  /**
   * The version of the document SDK.
   *
   * @since   1.0.0-dev
   * @var     string
   */
  const SDK_VERSION = '1.0.1-dev';


  /**
   * Returns the configuration of the full-text search document SDK and its service.
   *
   * @return  array
   *
   * @since   1.0.0-dev
   */
  protected function _GetConfigurationSdkService()
  {
    return [
      'Sdk' => [
        'Client' => [
          'Timeout.Connect' => 15,
          'Timeout.Execute' => 15
        ],
        'Version' => self::SDK_VERSION
      ],
      'Service' => [
        'Auth' => [
          'HashAlgorithm' => 'sha256',
          'SignatureName' => 'FTS-AUTH-SIGNATURE',
          'Status' => true
        ],
        'ActionList' => [
          'DeIndex' => [
            'EndPoint' => ['Id' => ['Course', 'Lesson', 'Unit']],
            'OperationType' => 'Write',
          ],
          'Index' => [
            'OperationType' => 'Write'
          ],
          'Search' => [
            'OperationType' => 'Read'
          ],
        ],
        'BaseEndPoint' => [
          'Multiple' => 'http://127.0.0.1/documents',
          'Single' => 'http://127.0.0.1/document'
        ],
        'HeaderList' => [
          'Accept' => 'application/vnd.epignosis.v%s+%s'
        ]
      ]
    ];
  }

  /**
   * De-indexes the requested document(s).
   *
   * @param   array $data
   *            - The data of the document(s) to be de-indexed. (Required)
   *
   * @param   bool $multiple
   *            - Whether to de-index multiple documents, or not. (Optional, false)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  SdkFtsDocumentException
   *            - In case that is not possible to de-index the requested document(s).
   */
  public function DeIndex(array $data, $multiple = false)
  {
    try {
      return $this->_GetClientInterface()->Delete (
        $this->_GetConfigurationServiceAction('DeIndex', $data, $multiple)
      );
    } catch (\Exception $exception) {
      throw new SdkFtsDocumentException (
        SdkFtsDocumentException::SDK_FTS_DOCUMENT_DEINDEX_FAILURE, $exception
      );
    }
  }

  /**
   * Indexes the requested document(s).
   *
   * @param   array $data
   *            - The data of the document(s) to be indexed. (Required)
   *
   * @param   bool $multiple
   *            - Whether to index multiple documents, or not. (Optional, false)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  SdkFtsDocumentException
   *            - In case that is not possible to index the requested document(s).
   */
  public function Index(array $data, $multiple = false)
  {
    try {
      return $this->_GetClientInterface()->Create (
        $this->_GetConfigurationServiceAction('Index', $data, $multiple), $data
      );
    } catch (\Exception $exception) {
      throw new SdkFtsDocumentException (
        SdkFtsDocumentException::SDK_FTS_DOCUMENT_INDEX_FAILURE, $exception
      );
    }
  }

  /**
   * Searches for documents, according the requested criteria.
   *
   * @param   array $data
   *            - The search data. (Required)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  SdkFtsDocumentException
   *            - In case that is not possible to search for documents.
   */
  public function Search(array $data)
  {
    try {
      return $this->_GetClientInterface()->Get (
        $this->_GetConfigurationServiceAction('Search', $data, true), $data
      );
    } catch (\Exception $exception) {
      throw new SdkFtsDocumentException (
        SdkFtsDocumentException::SDK_FTS_DOCUMENT_SEARCH_FAILURE, $exception
      );
    }
  }
}
