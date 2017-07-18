<?php

namespace Epignosis\Sdk\FullTextSearch\Configuration;

/**
 * Class Document
 *
 * The full-text search document SDK configuration.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Sdk\FullTextSearch\Configuration
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Sdk\FullTextSearch\Configuration
 * @since       1.0.0-dev
 */
class Document
{
  /**
   * Returns the configuration of the full-text search document SDK.
   *
   * @return  array
   *
   * @since   1.0.0-dev
   */
  public static function GetAll()
  {
    return [
      'Service' => [

        'Request' => [

          'EndPoint' => [
            'Create' => null,
            'Delete' => null,
            'Retrieve' => null,
            'RetrieveMany' => null,
            'Update' => null
          ],

          'OptionList' => []
        ],

        'Response' => []
      ]
    ];
  }
}