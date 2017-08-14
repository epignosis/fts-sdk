<?php

$data = [

  'Multiple' => [

    /**
     * Document #1 (Exist)
     * ----------------------------------------------------------------------------------
     */
    [

      /**
       * @default       -
       * @description   The document's identifiers.
       * @required      true
       * @since         1.0.0-dev
       * @var           array
       */
      'Id' => [

        /**
         * @default       -
         * @description   The course identifier.
         * @required      true
         * @since         1.0.0-dev
         * @var           int
         */
        'Course' => 1,

        /**
         * @default       null
         * @description   The lesson identifier.
         * @required      false
         * @since         1.0.0-dev
         * @var           null|int
         */
        'Lesson' => 2,

        /**
         * @default       -
         * @description   The unit identifier.
         * @required      true
         * @since         1.0.0-dev
         * @var           int
         */
        'Unit' => 3

      ]

    ],

    /**
     * Document #2 (Exist)
     * ----------------------------------------------------------------------------------
     */
    [

      /**
       * @default       -
       * @description   The document's identifiers.
       * @required      true
       * @since         1.0.0-dev
       * @var           array
       */
      'Id' => [

        /**
         * @default       -
         * @description   The course identifier.
         * @required      true
         * @since         1.0.0-dev
         * @var           int
         */
        'Course' => 4,

        /**
         * @default       null
         * @description   The lesson identifier.
         * @required      false
         * @since         1.0.0-dev
         * @var           null|int
         */
        'Lesson' => null,

        /**
         * @default       -
         * @description   The unit identifier.
         * @required      true
         * @since         1.0.0-dev
         * @var           int
         */
        'Unit' => 6

      ]

    ],

    /**
     * Document #3 (Not Exist)
     * ----------------------------------------------------------------------------------
     */
    [

      /**
       * @default       -
       * @description   The document's identifiers.
       * @required      true
       * @since         1.0.0-dev
       * @var           array
       */
      'Id' => [

        /**
         * @default       -
         * @description   The course identifier.
         * @required      true
         * @since         1.0.0-dev
         * @var           int
         */
        'Course' => 1,

        /**
         * @default       null
         * @description   The lesson identifier.
         * @required      false
         * @since         1.0.0-dev
         * @var           null|int
         */
        'Lesson' => 1,

        /**
         * @default       -
         * @description   The unit identifier.
         * @required      true
         * @since         1.0.0-dev
         * @var           int
         */
        'Unit' => 1

      ]

    ]

  ],

  'Single' => [

    /**
     * Document #4 (Exist)
     * ----------------------------------------------------------------------------------
     */
    [

      /**
       * @default       -
       * @description   The document's identifiers.
       * @required      true
       * @since         1.0.0-dev
       * @var           array
       */
      'Id' => [

        /**
         * @default       -
         * @description   The course identifier.
         * @required      true
         * @since         1.0.0-dev
         * @var           int
         */
        'Course' => 65536,

        /**
         * @default       null
         * @description   The lesson identifier.
         * @required      false
         * @since         1.0.0-dev
         * @var           null|int
         */
        'Lesson' => 4096,

        /**
         * @default       -
         * @description   The unit identifier.
         * @required      true
         * @since         1.0.0-dev
         * @var           int
         */
        'Unit' => 1024

      ]

    ],

    /**
     * Document #5 (Exist)
     * ----------------------------------------------------------------------------------
     */
    [

      /**
       * @default       -
       * @description   The document's identifiers.
       * @required      true
       * @since         1.0.0-dev
       * @var           array
       */
      'Id' => [

        /**
         * @default       -
         * @description   The course identifier.
         * @required      true
         * @since         1.0.0-dev
         * @var           int
         */
        'Course' => 52,

        /**
         * @default       -
         * @description   The unit identifier.
         * @required      true
         * @since         1.0.0-dev
         * @var           int
         */
        'Unit' => 666

      ]

    ],

    /**
     * Document #6 (Not Exist)
     * ----------------------------------------------------------------------------------
     */
    [

      /**
       * @default       -
       * @description   The document's identifiers.
       * @required      true
       * @since         1.0.0-dev
       * @var           array
       */
      'Id' => [

        /**
         * @default       -
         * @description   The course identifier.
         * @required      true
         * @since         1.0.0-dev
         * @var           int
         */
        'Course' => 1,

        /**
         * @default       -
         * @description   The unit identifier.
         * @required      true
         * @since         1.0.0-dev
         * @var           int
         */
        'Unit' => 1

      ]

    ]

  ]

];
