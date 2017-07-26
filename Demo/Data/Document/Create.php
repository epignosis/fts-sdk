<?php

/** @noinspection SpellCheckingInspection */
$data = [

  'Multiple' => [

    /**
     * Document #1
     */
    [

      /**
       * @default       -
       * @description   The document's list of access rules.
       * @required      true
       * @since         1.0.0-dev
       * @var           array
       */
      'AccessRuleList' => [

        /**
         * @default       []
         * @description   The availability information.
         * @required      false
         * @since         1.0.0-dev
         * @var           array
         */
        'Availability' => [

          /**
           * @default       null
           * @description   The initial availability information.
           * @required      false
           * @since         1.0.0-dev
           * @var           null|int
           */
          'From' => null,

          /**
           * @default       null
           * @description   The final availability information.
           * @required      false
           * @since         1.0.0-dev
           * @var           null|int
           */
          'To' => null

        ],

        /**
         * @default       []
         * @description   The list of the course(s) identifier(s), that may be required to
         *                complete.
         * @required      false
         * @since         1.0.0-dev
         * @var           array
         */
        'CourseListIdCompleted' => [],

        /**
         * @default       null
         * @description   The unit identifier, that may be required to complete.
         *                (Sequential Rule)
         * @required      false
         * @since         1.0.0-dev
         * @var           null|int
         */
        'UnitIdCompleted' => null

      ],

      /**
       * @default       -
       * @description   The document's content information.
       * @required      true
       * @since         1.0.0-dev
       * @var           array
       */
      'Content' => [

        /**
         * @default       []
         * @description   The list of the content's files.
         * @required      false
         * @since         1.0.0-dev
         * @var           array
         */
        'FileList' => [],

        /**
         * @default       []
         * @description   The list of the content's tags.
         * @required      false
         * @since         1.0.0-dev
         * @var           array
         */
        'TagList' => [],

        /**
         * @default       null
         * @description   The plain text content.
         * @required      false
         * @since         1.0.0-dev
         * @var           string
         */
        'Text' => null,

        /**
         * @default       -
         * @description   The title.
         * @required      true
         * @since         1.0.0-dev
         * @var           string
         */
        'Title' => '-'

      ],

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
        'Lesson' => null,

        /**
         * @default       -
         * @description   The unit identifier.
         * @required      true
         * @since         1.0.0-dev
         * @var           int
         */
        'Unit' => 1
      ]

    ],

    /**
     * Document #2
     */
    [

      /**
       * @default       -
       * @description   The document's list of access rules.
       * @required      true
       * @since         1.0.0-dev
       * @var           array
       */
      'AccessRuleList' => [

        /**
         * @default       []
         * @description   The availability information.
         * @required      false
         * @since         1.0.0-dev
         * @var           array
         */
        'Availability' => [

          /**
           * @default       null
           * @description   The initial availability information.
           * @required      false
           * @since         1.0.0-dev
           * @var           null|int
           */
          'From' => null,

          /**
           * @default       null
           * @description   The final availability information.
           * @required      false
           * @since         1.0.0-dev
           * @var           null|int
           */
          'To' => null

        ],

        /**
         * @default       []
         * @description   The list of the course(s) identifier(s), that may be required to
         *                complete.
         * @required      false
         * @since         1.0.0-dev
         * @var           array
         */
        'CourseListIdCompleted' => [],

        /**
         * @default       null
         * @description   The unit identifier, that may be required to complete.
         *                (Sequential Rule)
         * @required      false
         * @since         1.0.0-dev
         * @var           null|int
         */
        'UnitIdCompleted' => null

      ],

      /**
       * @default       -
       * @description   The document's content information.
       * @required      true
       * @since         1.0.0-dev
       * @var           array
       */
      'Content' => [

        /**
         * @default       []
         * @description   The list of the content's files.
         * @required      false
         * @since         1.0.0-dev
         * @var           array
         */
        'FileList' => [],

        /**
         * @default       []
         * @description   The list of the content's tags.
         * @required      false
         * @since         1.0.0-dev
         * @var           array
         */
        'TagList' => [],

        /**
         * @default       null
         * @description   The plain text content.
         * @required      false
         * @since         1.0.0-dev
         * @var           string
         */
        'Text' => null,

        /**
         * @default       -
         * @description   The title.
         * @required      true
         * @since         1.0.0-dev
         * @var           string
         */
        'Title' => '-'

      ],

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
        'Lesson' => null,

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

    [

      /**
       * @default       -
       * @description   The document's list of access rules.
       * @required      true
       * @since         1.0.0-dev
       * @var           array
       */
      'AccessRuleList' => [

        /**
         * @default       []
         * @description   The availability information.
         * @required      false
         * @since         1.0.0-dev
         * @var           array
         */
        'Availability' => [

          /**
           * @default       null
           * @description   The initial availability information.
           * @required      false
           * @since         1.0.0-dev
           * @var           null|int
           */
          'From' => null,

          /**
           * @default       null
           * @description   The final availability information.
           * @required      false
           * @since         1.0.0-dev
           * @var           null|int
           */
          'To' => null

        ],

        /**
         * @default       []
         * @description   The list of the course(s) identifier(s), that may be required to
         *                complete.
         * @required      false
         * @since         1.0.0-dev
         * @var           array
         */
        'CourseListIdCompleted' => [],

        /**
         * @default       null
         * @description   The unit identifier, that may be required to complete.
         *                (Sequential Rule)
         * @required      false
         * @since         1.0.0-dev
         * @var           null|int
         */
        'UnitIdCompleted' => null

      ],

      /**
       * @default       -
       * @description   The document's content information.
       * @required      true
       * @since         1.0.0-dev
       * @var           array
       */
      'Content' => [

        /**
         * @default       []
         * @description   The list of the content's files.
         * @required      false
         * @since         1.0.0-dev
         * @var           array
         */
        'FileList' => [],

        /**
         * @default       []
         * @description   The list of the content's tags.
         * @required      false
         * @since         1.0.0-dev
         * @var           array
         */
        'TagList' => [],

        /**
         * @default       null
         * @description   The plain text content.
         * @required      false
         * @since         1.0.0-dev
         * @var           string
         */
        'Text' => null,

        /**
         * @default       -
         * @description   The title.
         * @required      true
         * @since         1.0.0-dev
         * @var           string
         */
        'Title' => '-'

      ],

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
        'Lesson' => null,

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
