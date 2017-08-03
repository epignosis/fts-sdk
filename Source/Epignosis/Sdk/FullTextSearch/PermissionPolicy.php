<?php

namespace Epignosis\Sdk\FullTextSearch;

use Epignosis\Abstraction\AbstractSdk;
use Epignosis\Sdk\FullTextSearch\Failure\PermissionPolicy
  as SdkFtsPermissionPolicyException;

/**
 * Class PermissionPolicy
 *
 * The full-text search permission policy SDK.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Sdk\FullTextSearch
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Sdk\FullTextSearch
 * @since       1.0.0-dev
 */
class PermissionPolicy extends AbstractSdk
{
  /**
   * The version of the permission policy SDK.
   *
   * @since   1.0.0-dev
   * @var     string
   */
  const SDK_VERSION = '1.0.0-dev';


  /**
   * Returns the configuration of the full-text search permission policy SDK and its
   * service.
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
        ],
        'Version' => self::SDK_VERSION
      ],
      'Service' => [
        'Auth' => [
          'HashAlgorithm' => 'sha256',
          'SignatureName' => 'EPIGNOSIS-AUTH-SIGNATURE',
          'Status' => true
        ],
        'ActionList' => [
          'Push' => [
            'OperationType' => 'Write'
          ]
        ],
        'BaseEndPoint' => [
          'Single' => 'http://127.0.0.1:8080/fts/permission-policy'
          //'Single' => 'http://fts.pro.efrontlearning.com/permission-policy'
        ],
        'HeaderList' => [
          'Accept' => 'application/vnd.epignosis.v1+json',
          'Accept-Language' => 'en-US'
        ]
      ]
    ];
  }

  /**
   * Pushes the requested permission policy.
   *
   * @param   array $data
   *            - The data of the permission policy to be pushed. (Required)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  SdkFtsPermissionPolicyException
   *            - In case that is not possible to push the requested permission policy.
   */
  public function Push(array $data)
  {
    try {
      return $this->_GetClientInterface()->Create (
        $this->_GetConfigurationServiceAction('Create', $data, false), $data
      );
    } catch (\Exception $exception) {
      throw new SdkFtsPermissionPolicyException (
        SdkFtsPermissionPolicyException::SDK_FTS_PERMISSION_POLICY_PUSH_FAILURE,
        $exception
      );
    }
  }
}
