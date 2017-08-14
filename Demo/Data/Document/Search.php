<?php

$data = [

  /**
   * Query #1
   * ------------------------------------------------------------------------------------
   */
  [

    /**
     * @default       7
     * @description   Determines, in which fields should search for the requested query
     *                data. The default behavior, is to search in any field which is
     *                related to the content. Available options are:
     *
     *                1: Title
     *                2: File Content
     *                3: Text Content
     *                4: Title        + File Content
     *                5: Title        + Text Content
     *                6: File Content + Text Content
     *                7: Title        + File Content + Text Content
     *
     * @required      false
     * @since         1.0.0-dev
     * @var           int
     */
    'Field' => 7,

    /**
     * @default       []
     * @description   Pagination information such as the limit and the offset of the
     *                returned result set.
     *
     * @required      false
     * @since         1.0.0-dev
     * @var           array
     */
    'Pagination' => [

      /**
       * @default       10
       * @description   The limit of the returned result set.
       * @required      false
       * @since         1.0.0-dev
       * @var           int
       */
      'Limit' => 5,

      /**
       * @default       0
       * @description   The offset of the returned result set.
       * @required      false
       * @since         1.0.0-dev
       * @var           int
       */
      'Offset' => 0

    ],

    /**
     * @default       []
     * @description   The query data.
     * @required      false
     * @since         1.0.0-dev
     * @var           array
     */
    'Query' => [

      /**
       * @default       null
       * @description   The text to search for documents that match.
       * @required      false
       * @since         1.0.0-dev
       * @var           null|string
       */
      'Text' => 'eFrontPro by Epignosis LLC!'

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
