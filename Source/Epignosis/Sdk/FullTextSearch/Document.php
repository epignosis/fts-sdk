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
          'HashAlgorithm' => 'sha256',
          'SignatureName' => 'EPIGNOSIS-AUTH-SIGNATURE',
          'Status' => true
        ],
        'ActionList' => [
          'Create' => [
            'OperationType' => 'Write'
          ],
          'Delete' => [
            'OperationType' => 'Write',
            'Path' => ['Id']
          ],
          'Search' => [
            'OperationType' => 'Read'
          ],
          'Update' => [
            'OperationType' => 'Write',
            'Path' => ['Id']
          ]
        ],
        'BaseEndPoint' => [
          'Multiple' => 'http://fts.pro.efrontlearning.com/documents/',
          'Single' => 'http://fts.pro.efrontlearning.com/document/'
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
   * Creates the requested document(s).
   *
   * @param   array $data
   *            - The data of the document(s) to be created. (Required)
   *
   * @param   bool $multiple
   *            - Whether to create multiple documents, or not. (Optional, false)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  SdkFtsDocumentException
   *            - In case that is not possible to create the requested document(s).
   */
  public function Create(array $data, $multiple = false)
  {
    try {
      return $this->_GetClientInterface()->Create (
        $this->_GetConfigurationServiceAction('Create', $data, $multiple), $data
      );
    } catch (\Exception $exception) {
      throw new SdkFtsDocumentException (
        SdkFtsDocumentException::SDK_FTS_DOCUMENT_CREATE_FAILURE, $exception
      );
    }
  }

  /**
   * Deletes the requested document(s).
   *
   * @param   array $data
   *            - The data of the document(s) to be deleted. (Required)
   *
   * @param   bool $multiple
   *            - Whether to delete multiple documents, or not. (Optional, false)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  SdkFtsDocumentException
   *            - In case that is not possible to delete the requested document(s).
   */
  public function Delete(array $data, $multiple = false)
  {
    try {
      return $this->_GetClientInterface()->Delete (
        $this->_GetConfigurationServiceAction('Delete', $data, $multiple), $data
      );
    } catch (\Exception $exception) {
      throw new SdkFtsDocumentException (
        SdkFtsDocumentException::SDK_FTS_DOCUMENT_DELETE_FAILURE, $exception
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
      return $this->_GetClientInterface()->Search (
        $this->_GetConfigurationServiceAction('Search', $data, true), $data
      );
    } catch (\Exception $exception) {
      throw new SdkFtsDocumentException (
        SdkFtsDocumentException::SDK_FTS_DOCUMENT_SEARCH_FAILURE, $exception
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
   * @throws  SdkFtsDocumentException
   *            - In case that is not possible to update the requested document(s).
   */
  public function Update(array $data, $multiple = false)
  {
    try {
      return $this->_GetClientInterface()->Update (
        $this->_GetConfigurationServiceAction('Update', $data, $multiple), $data
      );
    } catch (\Exception $exception) {
      throw new SdkFtsDocumentException (
        SdkFtsDocumentException::SDK_FTS_DOCUMENT_UPDATE_FAILURE, $exception
      );
    }
  }
}
