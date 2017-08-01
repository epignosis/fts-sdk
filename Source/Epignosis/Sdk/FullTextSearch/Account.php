<?php

namespace Epignosis\Sdk\FullTextSearch;

use Epignosis\Abstraction\AbstractSdk;
use Epignosis\Sdk\FullTextSearch\Failure\Account as SdkFtsAccountingException;

/**
 * Class Account
 *
 * The full-text search account SDK.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Sdk\FullTextSearch
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Sdk\FullTextSearch
 * @since       1.0.0-dev
 */
class Account extends AbstractSdk
{
  /**
   * The version of the account SDK.
   *
   * @since   1.0.0-dev
   * @var     string
   */
  const SDK_VERSION = '1.0.0-dev';


  /**
   * Returns the configuration of the full-text search account SDK and its service.
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
          'Timeout' => 15
        ]
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
          ]
        ],
        'BaseEndPoint' => [
          'Multiple' => 'http://xarhsdev.gr/fts/accounts',
          'Single' => 'http://xarhsdev.gr/fts/account'
          //'Multiple' => 'http://fts.pro.efrontlearning.com/accounts',
          //'Single' => 'http://fts.pro.efrontlearning.com/account'
        ],
        'HeaderList' => [
          'Accept' => 'application/vnd.epignosis.v10+json',
          'Accept-Language' => 'en-US'
        ]
      ]
    ];
  }

  /**
   * Creates the requested account(s).
   *
   * @param   array $data
   *            - The data of the account(s) to be created. (Required)
   *
   * @param   bool $multiple
   *            - Whether to create multiple accounts, or not. (Optional, false)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  SdkFtsAccountingException
   *            - In case that is not possible to create the requested account(s).
   */
  public function Create(array $data, $multiple = false)
  {
    try {
      return $this->_GetClientInterface()->Create (
        $this->_GetConfigurationServiceAction('Create', $data, $multiple), $data
      );
    } catch (\Exception $exception) {
      throw new SdkFtsAccountingException (
        SdkFtsAccountingException::SDK_FTS_ACCOUNTING_ACCOUNT_CREATE_FAILURE, $exception
      );
    }
  }
}
