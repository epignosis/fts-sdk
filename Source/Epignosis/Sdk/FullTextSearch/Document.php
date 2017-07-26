<?php

namespace Epignosis\Sdk\FullTextSearch;

use Epignosis\Abstraction\AbstractSdk;
use Epignosis\Sdk\FullTextSearch\Failure\Document as FullTextSearchDocumentException;

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
   * The version of the Document SDK.
   *
   * @since   1.0.0-dev
   * @var     string
   */
  const SDK_VERSION = '1.0.0-dev';


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
        'Client' => []
      ],
      'Service' => [
        'Auth' => [
          'CryptoAlgorithm' => 'AES-128-CBC',
          'HashAlgorithm' => 'sha256',
          'SignatureName' => 'FTS-AUTH-SIGNATURE',
          'Status' => true
        ],
        'ActionList' => [
          'Create' => [
            'OperationType' => 'Write',
            'Response' => ['SuccessCode' => [201, 202]]
          ],
          'Delete' => [
            'OperationType' => 'Write',
            'Path' => ['Id'],
            'Response' => ['SuccessCode' => [200, 202]]
          ],
          'Search' => [
            'OperationType' => 'Read',
            'Response' => ['SuccessCode' => [200]]
          ],
          'Update' => [
            'OperationType' => 'Write',
            'Path' => ['Id'],
            'Response' => ['SuccessCode' => [200, 202]]
          ]
        ],
        'BaseEndPoint' => [
          'Multiple' => 'http://xarhsdev.gr/fts/documents/',
          'Single' => 'http://xarhsdev.gr/fts/document/'
        ],
        'HeaderList' => [
          'Accept' => 'application/vnd.epignosis.v10+json',
          'Accept-Language' => 'en-US'
        ],
        'Timeout' => 15
      ]
    ];
  }

  /**
   * Creates the requested document.
   *
   * @param   array $data
   *            - The data of the document to be created. (Required)
   *
   * @param   bool $multiple
   *            - Whether to create multiple documents, or not. (Optional, false)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  FullTextSearchDocumentException
   *            - In case that is not possible to create the requested document.
   */
  public function Create(array $data, $multiple = false)
  {
    try {
      return $this->_GetClientInterface()->Create (
        $this->_GetConfigurationServiceAction('Create', $data, $multiple), $data
      );
    } catch (\Exception $exception) {
      throw new FullTextSearchDocumentException (
        FullTextSearchDocumentException::SDK_FTS_DOCUMENT_CREATE_FAILURE, $exception
      );
    }
  }

  /**
   * Deletes the requested document.
   *
   * @param   array $data
   *            - The data of the document to be deleted. (Required)
   *
   * @param   bool $multiple
   *            - Whether to delete multiple documents, or not. (Optional, false)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  FullTextSearchDocumentException
   *            - In case that is not possible to delete the requested document.
   */
  public function Delete(array $data, $multiple = false)
  {
    try {
      return $this->_GetClientInterface()->Delete (
        $this->_GetConfigurationServiceAction('Delete', $data, $multiple), $data
      );
    } catch (\Exception $exception) {
      throw new FullTextSearchDocumentException (
        FullTextSearchDocumentException::SDK_FTS_DOCUMENT_DELETE_FAILURE, $exception
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
   * @throws  FullTextSearchDocumentException
   *            - In case that is not possible to search for documents.
   */
  public function Search(array $data)
  {
    try {
      return $this->_GetClientInterface()->Search (
        $this->_GetConfigurationServiceAction('Search', $data, true), $data
      );
    } catch (\Exception $exception) {
      throw new FullTextSearchDocumentException (
        FullTextSearchDocumentException::SDK_FTS_DOCUMENT_SEARCH_FAILURE, $exception
      );
    }
  }

  /**
   * Updates the requested document(s).
   *
   * @param   array $data
   *            - The data of the document(s) to be updated. (Required)
   *
   * @param   bool $multiple
   *            - Whether to update multiple documents, or not. (Optional, false)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  FullTextSearchDocumentException
   *            - In case that is not possible to update the requested document(s).
   */
  public function Update(array $data, $multiple = false)
  {
    try {
      return $this->_GetClientInterface()->Update (
        $this->_GetConfigurationServiceAction('Update', $data, $multiple), $data
      );
    } catch (\Exception $exception) {
      throw new FullTextSearchDocumentException (
        FullTextSearchDocumentException::SDK_FTS_DOCUMENT_UPDATE_FAILURE, $exception
      );
    }
  }
}
