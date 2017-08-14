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
       * @description   The course identifier.
       * @required      true
       * @since         1.0.0-dev
       * @var           int
       */
      'CourseId' => 1,

      /**
       * @default       null
       * @description   The lesson identifier.
       * @required      false
       * @since         1.0.0-dev
       * @var           null|int
       */
      'LessonId' => 2,

      /**
       * @default       -
       * @description   The unit identifier.
       * @required      true
       * @since         1.0.0-dev
       * @var           int
       */
      'UnitId' => 3

    ],

    /**
     * Document #2 (Exist)
     * ----------------------------------------------------------------------------------
     */
    [

      /**
       * @default       -
       * @description   The course identifier.
       * @required      true
       * @since         1.0.0-dev
       * @var           int
       */
      'CourseId' => 4,

      /**
       * @default       null
       * @description   The lesson identifier.
       * @required      false
       * @since         1.0.0-dev
       * @var           null|int
       */
      'LessonId' => null,

      /**
       * @default       -
       * @description   The unit identifier.
       * @required      true
       * @since         1.0.0-dev
       * @var           int
       */
      'UnitId' => 6

    ],

    /**
     * Document #3 (Not Exist)
     * ----------------------------------------------------------------------------------
     */
    [

      /**
       * @default       -
       * @description   The course identifier.
       * @required      true
       * @since         1.0.0-dev
       * @var           int
       */
      'CourseId' => 1,

      /**
       * @default       null
       * @description   The lesson identifier.
       * @required      false
       * @since         1.0.0-dev
       * @var           null|int
       */
      'LessonId' => 1,

      /**
       * @default       -
       * @description   The unit identifier.
       * @required      true
       * @since         1.0.0-dev
       * @var           int
       */
      'UnitId' => 1

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
       * @description   The course identifier.
       * @required      true
       * @since         1.0.0-dev
       * @var           int
       */
      'CourseId' => 65536,

      /**
       * @default       null
       * @description   The lesson identifier.
       * @required      false
       * @since         1.0.0-dev
       * @var           null|int
       */
      'LessonId' => 4096,

      /**
       * @default       -
       * @description   The unit identifier.
       * @required      true
       * @since         1.0.0-dev
       * @var           int
       */
      'UnitId' => 1024

    ],

    /**
     * Document #5 (Exist)
     * ----------------------------------------------------------------------------------
     */
    [

      /**
       * @default       -
       * @description   The course identifier.
       * @required      true
       * @since         1.0.0-dev
       * @var           int
       */
      'CourseId' => 52,

      /**
       * @default       -
       * @description   The unit identifier.
       * @required      true
       * @since         1.0.0-dev
       * @var           int
       */
      'UnitId' => 666

    ],

    /**
     * Document #6 (Not Exist)
     * ----------------------------------------------------------------------------------
     */
    [

      /**
       * @default       -
       * @description   The course identifier.
       * @required      true
       * @since         1.0.0-dev
       * @var           int
       */
      'CourseId' => 1,

      /**
       * @default       -
       * @description   The unit identifier.
       * @required      true
       * @since         1.0.0-dev
       * @var           int
       */
      'UnitId' => 1

    ]

  ]

];
