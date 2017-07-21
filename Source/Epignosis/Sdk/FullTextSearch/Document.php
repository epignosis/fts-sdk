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
          'Crypto' => [
            'Algorithm' => 'AES-128-CBC',
            'Raw' => true
          ],
          'Hash' => [
            'Algorithm' => 'sha256',
            'MessageAuth' => true,
            'Raw' => true,
          ],
          'Signature' => [
            'Name' => 'EA-AUTH-SIGNATURE'
          ],
          'Status' => true,
          'Token' => [
            'Name' => 'EA-AUTH-TOKEN'
          ]
        ],
        'ActionList' => [
          'Create' => [
            'OperationType' => ['Write'],
            'Path' => 'document'
          ],
          'Delete' => [
            'OperationType' => ['Write', 'Master'],
            'Parameter' => [
              'DocumentId' => 'Integer'
            ],
            'Path' => 'document/%s'
          ],
          'Retrieve' => [
            'OperationType' => 'Read',
            'Parameter' => [
              'DocumentId' => 'Integer'
            ],
            'Path' => 'document/%s'
          ],
          'RetrieveMany' => [
            'OperationType' => 'Read',
            'Path' => 'documents'
          ],
          'Update' => [
            'OperationType' => 'Write',
            'Parameter' => [
              'DocumentId' => 'Integer'
            ],
            'Path' => 'document/%s'
          ]
        ],
        'BaseEndPoint' => 'http://fts.pro.efrontlearning.com/',
        'HeaderList' => [
          'Accept' => 'application/vnd.epignosis.v10+json',
          'Accept-Language' => 'en-US'
        ]
      ]
    ];
  }

  /**
   * Creates the requested document.
   *
   * @param   array $data
   *            - The data of the document to be created. (Required)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  FullTextSearchDocumentException
   *            - In case that is not possible to create the requested document.
   */
  public function Create(array $data)
  {
    try {
      return $this->_GetClientInterface()->Create (
        $this->_GetConfigurationServiceAction('Create'), $data
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
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  FullTextSearchDocumentException
   *            - In case that is not possible to delete the requested document.
   */
  public function Delete(array $data)
  {
    try {
      return $this->_GetClientInterface()->Delete (
        $this->_GetConfigurationServiceAction('Delete'), $data
      );
    } catch (\Exception $exception) {
      throw new FullTextSearchDocumentException (
        FullTextSearchDocumentException::SDK_FTS_DOCUMENT_DELETE_FAILURE, $exception
      );
    }
  }

  /**
   * Retrieves the requested document.
   *
   * @param   array $data
   *            - The data of the document to be retrieved. (Required)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  FullTextSearchDocumentException
   *            - In case that is not possible to retrieve the requested document.
   */
  public function Retrieve(array $data)
  {
    try {
      return $this->_GetClientInterface()->Retrieve (
        $this->_GetConfigurationServiceAction('Retrieve'), $data
      );
    } catch (\Exception $exception) {
      throw new FullTextSearchDocumentException (
        FullTextSearchDocumentException::SDK_FTS_DOCUMENT_RETRIEVE_FAILURE, $exception
      );
    }
  }

  /**
   * Retrieves many documents.
   *
   * @param   array $data
   *            - The data of the documents to be retrieved. (Required)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  FullTextSearchDocumentException
   *            - In case that is not possible to retrieve the requested documents.
   */
  public function RetrieveMany(array $data)
  {
    try {
      return $this->_GetClientInterface()->Retrieve (
        $this->_GetConfigurationServiceAction('RetrieveMany'), $data
      );
    } catch (\Exception $exception) {
      throw new FullTextSearchDocumentException (
        FullTextSearchDocumentException::SDK_FTS_DOCUMENT_RETRIEVE_MANY_FAILURE,
        $exception
      );
    }
  }

  /**
   * Updates the requested document.
   *
   * @param   array $data
   *            - The data of the document to be updated. (Required)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  FullTextSearchDocumentException
   *            - In case that is not possible to update the requested document.
   */
  public function Update(array $data)
  {
    try {
      return $this->_GetClientInterface()->Update (
        $this->_GetConfigurationServiceAction('Update'), $data
      );
    } catch (\Exception $exception) {
      throw new FullTextSearchDocumentException (
        FullTextSearchDocumentException::SDK_FTS_DOCUMENT_UPDATE_FAILURE, $exception
      );
    }
  }
}
