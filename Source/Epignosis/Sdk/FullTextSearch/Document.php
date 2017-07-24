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
            'Path' => 'document',
            'Response' => [
              'SuccessCode' => [201, 202]
            ]
          ],
          'Delete' => [
            'OperationType' => 'Write',
            'Parameter' => [
              'DocumentId' => 'Integer'
            ],
            'Path' => 'document/%s',
            'Response' => [
              'SuccessCode' => [200, 202]
            ]
          ],
          'Retrieve' => [
            'OperationType' => 'Read',
            'Parameter' => [
              'DocumentId' => 'Integer'
            ],
            'Path' => 'document/%s',
            'Response' => [
              'SuccessCode' => [200]
            ]
          ],
          'RetrieveMany' => [
            'OperationType' => 'Read',
            'Path' => 'documents',
            'Response' => [
              'SuccessCode' => [200]
            ]
          ],
          'Update' => [
            'OperationType' => 'Write',
            'Parameter' => [
              'DocumentId' => 'Integer'
            ],
            'Path' => 'document/%s',
            'Response' => [
              'SuccessCode' => [200, 202]
            ]
          ]
        ],
        'BaseEndPoint' => 'http://fts.pro.efrontlearning.com/',
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
        $this->_GetConfigurationServiceAction('Create', $data), $data
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
        $this->_GetConfigurationServiceAction('Delete', $data), $data
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
        $this->_GetConfigurationServiceAction('Retrieve', $data), $data
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
        $this->_GetConfigurationServiceAction('RetrieveMany', $data), $data
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
        $this->_GetConfigurationServiceAction('Update', $data), $data
      );
    } catch (\Exception $exception) {
      throw new FullTextSearchDocumentException (
        FullTextSearchDocumentException::SDK_FTS_DOCUMENT_UPDATE_FAILURE, $exception
      );
    }
  }
}
