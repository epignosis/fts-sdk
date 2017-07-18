<?php

namespace Epignosis\Sdk\FullTextSearch;

use Epignosis\Sdk\Abstraction\AbstractSdk;
use Epignosis\Sdk\FullTextSearch\Configuration\Document as DocumentConfiguration;
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
   * Returns the configuration of the full-text search document SDK.
   *
   * @return  array
   *
   * @since   1.0.0-dev
   */
  protected function _GetSdkConfiguration()
  {
    return DocumentConfiguration::GetAll();
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
   *            - In case that is not possible to successfully complete, the creation of
   *              the requested document.
   */
  public function Create(array $data)
  {
    try {
      return $this->_GetDecodedResponse (
        $this->_GetClientInterface()->Post (
          $this->_configurationInterface->GetByKey('Service.Request.EndPoint.Create'),
          $data,
          $this->_configurationInterface->GetByKey('Service.Request.OptionList')
        ),
        $this->_configurationInterface->GetByKey('Service.Response')
      );
    } catch (\Exception $exception) {
      throw new DocumentException (
        DocumentException::FTS_DOCUMENT_CREATE_FAILURE, $exception, ['Data' => $data]
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
   *            - In case that is not possible to successfully complete, the deletion of
   *              the requested document.
   */
  public function Delete(array $data)
  {
    try {
      return $this->_GetDecodedResponse (
        $this->_GetClientInterface()->Delete (
          $this->_configurationInterface->GetByKey('Service.Request.EndPoint.Delete'),
          $data,
          $this->_configurationInterface->GetByKey('Service.Request.OptionList')
        ),
        $this->_configurationInterface->GetByKey('Service.Response')
      );
    } catch (\Exception $exception) {
      throw new DocumentException (
        DocumentException::FTS_DOCUMENT_DELETE_FAILURE, $exception, ['Data' => $data]
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
   *            - In case that is not possible to successfully complete, the retrieval of
   *              the requested document.
   */
  public function Retrieve(array $data)
  {
    try {
      return $this->_GetDecodedResponse (
        $this->_GetClientInterface()->Get (
          $this->_configurationInterface->GetByKey('Service.Request.EndPoint.Retrieve'),
          $data,
          $this->_configurationInterface->GetByKey('Service.Request.OptionList')
        ),
        $this->_configurationInterface->GetByKey('Service.Response')
      );
    } catch (\Exception $exception) {
      throw new DocumentException (
        DocumentException::FTS_DOCUMENT_RETRIEVE_FAILURE, $exception, ['Data' => $data]
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
   *            - In case that is not possible to successfully complete, the retrieval of
   *              the documents.
   */
  public function RetrieveMany(array $data)
  {
    try {
      return $this->_GetDecodedResponse (
        $this->_GetClientInterface()->Get (
          $this->_configurationInterface->GetByKey (
            'Service.Request.EndPoint.RetrieveMany'
          ),
          $data,
          $this->_configurationInterface->GetByKey('Service.Request.OptionList')
        ),
        $this->_configurationInterface->GetByKey('Service.Response')
      );
    } catch (\Exception $exception) {
      throw new DocumentException (
        DocumentException::FTS_DOCUMENT_RETRIEVE_MANY_FAILURE,
        $exception,
        ['Data' => $data]
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
   *            - In case that is not possible to successfully complete, the update of the
   *              requested document.
   */
  public function Update(array $data)
  {
    try {
      return $this->_GetDecodedResponse (
        $this->_GetClientInterface()->Put (
          $this->_configurationInterface->GetByKey('Service.Request.EndPoint.Update'),
          $data,
          $this->_configurationInterface->GetByKey('Service.Request.OptionList')
        ),
        $this->_configurationInterface->GetByKey('Service.Response')
      );
    } catch (\Exception $exception) {
      throw new DocumentException (
        DocumentException::FTS_DOCUMENT_UPDATE_FAILURE, $exception, ['Data' => $data]
      );
    }
  }
}
