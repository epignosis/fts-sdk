<?php

$data = [

  /**
   * Query #1
   * ------------------------------------------------------------------------------------
   */
  [

    'Field' => [
      'File' => true,
      'Text' => true,
      'Title' => true
    ],

    'Pagination' => [
      'Limit' => 10,
      'Offset' => 0
    ],

    'Query' => [
      'Text' => 'eFrontPro'
    ],

    /**
     * @default       []
     * @description   The permission policy of the search.
     * @required      false
     * @since         1.0.0-dev
     * @var           array
     */
    'PermissionPolicy' => [

      /**
       * @default       null
       * @description   The permission policy identifier. Could be the internal user
       *                identifier on the LMS.
       * @required      false
       * @since         1.0.0-dev
       * @var           null|int
       */
      'Id' => null

    ]

  ]

];
