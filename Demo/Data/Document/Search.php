<?php

$data = [

  /**
   * Query #1
   * ------------------------------------------------------------------------------------
   */
  [

    /**
     * @default       []
     * @description   Determines, in which fields should search for the requested query
     *                data. The default behavior, is to search in any content related
     *                field. Available fields are "File", "Text" and "Title". If only
     *                particular fields must be excluded, one, can define their type and
     *                set them to false.
     *
     * @required      false
     * @since         1.0.0-dev
     * @var           array
     */
    'Field' => [
      'File' => true,
      'Text' => true,
      'Title' => true
    ],

    /**
     * @default       []
     * @description   Determines, in which fields should search for the requested query
     *                data. The default behavior, is to search in any content related
     *                field. Available fields are "File", "Text" and "Title". If only
     *                particular fields must be excluded, one, can define their type and
     *                set them to false.
     *
     * @required      false
     * @since         1.0.0-dev
     * @var           array
     */
    'Pagination' => [
      'Limit' => 5,
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
       *
       * @required      false
       * @since         1.0.0-dev
       * @var           null|int
       */
      'Id' => null

    ]

  ]

];
