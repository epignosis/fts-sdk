<?php

namespace Epignosis\Sdk\FullTextSearch;

use Epignosis\Sdk\Abstraction\AbstractSdk;
use Epignosis\Sdk\FullTextSearch\Failure\Document as DocumentException;

/**
 * Class FullTextSearch
 *
 * The full-text search operator SDK. With this SDK, one, can create, delete, update, and
 * retrieve documents from the full-text search service.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Sdk\FullTextSearch
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Sdk\FullTextSearch
 * @since       1.0.0-dev
 */
class Operator extends AbstractSdk
{
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
      return $this->_GetClientInterface()->Post($data);
    } catch (\Exception $exception) {
      throw new DocumentException (
        DocumentException::FTS_CREATE_FAILURE, $exception, ['Data' => $data]
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
      return $this->_GetClientInterface()->Delete($data);
    } catch (\Exception $exception) {
      throw new DocumentException (
        DocumentException::FTS_DELETE_FAILURE, $exception, ['Data' => $data]
      );
    }
  }

  /**
  * Retrieves and returns the requested document.
  *
  * @param   array $data
  *            - The data of the document to be retrieved and returned. (Required)
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
      return $this->_GetClientInterface()->Get($data);
    } catch (\Exception $exception) {
      throw new DocumentException (
        DocumentException::FTS_RETRIEVE_FAILURE, $exception, ['Data' => $data]
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
      return $this->_GetClientInterface()->Put($data);
    } catch (\Exception $exception) {
      throw new DocumentException (
        DocumentException::FTS_UPDATE_FAILURE, $exception, ['Data' => $data]
      );
    }
  }
}
