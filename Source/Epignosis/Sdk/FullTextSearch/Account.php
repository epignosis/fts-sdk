<?php

namespace Epignosis\Sdk\FullTextSearch;

use Epignosis\Abstraction\AbstractSdk;
use Epignosis\Sdk\FullTextSearch\Failure\Account as SdkFtsAccountException;

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
  const SDK_VERSION = '1.0.1-dev';


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
          'Create' => [
            'OperationType' => 'Write'
          ]
        ],
        'BaseEndPoint' => [
          'Single' => 'http://127.0.0.1/account'
        ],
        'HeaderList' => [
          'Accept' => 'application/vnd.epignosis.v%s+%s'
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
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  SdkFtsAccountException
   *            - In case that is not possible to create the requested account(s).
   */
  public function Create(array $data)
  {
    try {
      return $this->_GetClientInterface()->Create (
        $this->_GetConfigurationServiceAction('Create', $data, false), $data
      );
    } catch (\Exception $exception) {
      throw new SdkFtsAccountException (
        SdkFtsAccountException::SDK_FTS_ACCOUNT_CREATE_FAILURE, $exception
      );
    }
  }
}
