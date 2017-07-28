<?php

namespace Epignosis\Sdk\FullTextSearch;

use Epignosis\Abstraction\AbstractSdk;
use Epignosis\Sdk\FullTextSearch\Failure\Administration
  as SdkFtsAdministrationException;

/**
 * Class Administration
 *
 * The full-text search administration SDK.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Sdk\FullTextSearch
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Sdk\FullTextSearch
 * @since       1.0.0-dev
 */
class Administration extends AbstractSdk
{
  /**
   * The version of the administration SDK.
   *
   * @since   1.0.0-dev
   * @var     string
   */
  const SDK_VERSION = '1.0.0-dev';


  /**
   * Returns the configuration of the full-text search administration SDK and its service.
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
          'AccountCreate' => [
            'OperationType' => 'Write'
          ]
        ],
        'BaseEndPoint' => [
          'Multiple' => 'http://fts.pro.efrontlearning.com/administration/accounts',
          'Single' => 'http://fts.pro.efrontlearning.com/administration/account'
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
   * Creates the requested account.
   *
   * @param   array $data
   *            - The data of the account to be created. (Required)
   *
   * @param   bool $multiple
   *            - Whether to create multiple accounts, or not. (Optional, false)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  SdkFtsAdministrationException
   *            - In case that is not possible to create the requested document.
   */
  public function AccountCreate(array $data, $multiple = false)
  {
    try {
      return $this->_GetClientInterface()->Create (
        $this->_GetConfigurationServiceAction('AccountCreate', $data, $multiple), $data
      );
    } catch (\Exception $exception) {
      throw new SdkFtsAdministrationException (
        SdkFtsAdministrationException::SDK_FTS_ADMINISTRATION_ACCOUNT_CREATE_FAILURE,
        $exception
      );
    }
  }
}
