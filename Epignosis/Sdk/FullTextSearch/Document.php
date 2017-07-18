<?php

namespace Epignosis\Sdk\FullTextSearch;

use Epignosis\Sdk\Abstraction\AbstractSdk;
use Epignosis\Sdk\FullTextSearch\Failure\Document as DocumentException;

/**
 * Class Document
 *
 * The full-text search document SDK.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Sdks\Sdk\FullTextSearch
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Sdks\Sdk\FullTextSearch
 * @since       1.0.0-dev
 */
class Document extends AbstractSdk
{
  /**
   * Prepares the full-text search document SDK.
   *
   * @return  Document
   *
   * @since   1.0.0-dev
   */
  protected function _PrepareSdk()
  {
    $this->_configurationSdk = [
      'Service' => [
        'Request' => [
          'Private' => [
            'Create' => [],
            'Delete' => [],
            'Retrieve' => [],
            'RetrieveMany' => [],
            'Update' => []
          ],
          'Public' => []
        ],
        'Response' => [
          'Private' => [
            'Create' => [],
            'Delete' => [],
            'Retrieve' => [],
            'RetrieveMany' => [],
            'Update' => []
          ],
          'Public' => []
        ]
      ]
    ];

    return $this;
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
   * @throws  DocumentException
   *            - In case that is not possible to create the requested document.
   */
  public function Create(array $data)
  {
    try {
      return $this->_GetDecodedResponse (
        $this->_GetClientInterface()->Post (
          $this->_GetConfigurationService('Request', 'Create'), $data
        ),
        $this->_GetConfigurationService('Response', 'Create')
      );
    } catch (\Exception $exception) {
      throw new DocumentException (
        DocumentException::FTS_DOCUMENT_CREATE_FAILURE, $exception
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
   * @throws  DocumentException
   *            - In case that is not possible to delete the requested document.
   */
  public function Delete(array $data)
  {
    try {
      return $this->_GetDecodedResponse (
        $this->_GetClientInterface()->Delete (
          $this->_GetConfigurationService('Request', 'Delete'), $data
        ),
        $this->_GetConfigurationService('Response', 'Delete')
      );
    } catch (\Exception $exception) {
      throw new DocumentException (
        DocumentException::FTS_DOCUMENT_DELETE_FAILURE, $exception
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
   * @throws  DocumentException
   *            - In case that is not possible to retrieve the requested document.
   */
  public function Retrieve(array $data)
  {
    try {
      return $this->_GetDecodedResponse (
        $this->_GetClientInterface()->Get (
          $this->_GetConfigurationService('Request', 'Retrieve'), $data
        ),
        $this->_GetConfigurationService('Response', 'Retrieve')
      );
    } catch (\Exception $exception) {
      throw new DocumentException (
        DocumentException::FTS_DOCUMENT_RETRIEVE_FAILURE, $exception
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
   * @throws  DocumentException
   *            - In case that is not possible to retrieve the requested documents.
   */
  public function RetrieveMany(array $data)
  {
    try {
      return $this->_GetDecodedResponse (
        $this->_GetClientInterface()->Get (
          $this->_GetConfigurationService('Request', 'RetrieveMany'), $data
        ),
        $this->_GetConfigurationService('Response', 'RetrieveMany')
      );
    } catch (\Exception $exception) {
      throw new DocumentException (
        DocumentException::FTS_DOCUMENT_RETRIEVE_MANY_FAILURE, $exception
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
   * @throws  DocumentException
   *            - In case that is not possible to update the requested document.
   */
  public function Update(array $data)
  {
    try {
      return $this->_GetDecodedResponse (
        $this->_GetClientInterface()->Put (
          $this->_GetConfigurationService('Request', 'Update'), $data
        ),
        $this->_GetConfigurationService('Response', 'Update')
      );
    } catch (\Exception $exception) {
      throw new DocumentException (
        DocumentException::FTS_DOCUMENT_UPDATE_FAILURE, $exception
      );
    }
  }
}
