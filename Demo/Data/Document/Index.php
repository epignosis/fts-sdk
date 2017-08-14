<?php

$data = [

  'Multiple' => [

    /**
     * Document #1
     * ----------------------------------------------------------------------------------
     */
    [

      /**
       * @default       []
       * @description   The document's content.
       * @required      false
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
         * @description   The content's tags.
         * @required      false
         * @since         1.0.0-dev
         * @var           array
         */
        'TagList' => ['foo', 'bar'],

        /**
         * @default       null
         * @description   The plain text content.
         * @required      false
         * @since         1.0.0-dev
         * @var           null|string
         */
        'Text' => 'This is a sample plain text content ..'

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
        'Lesson' => 2,

        /**
         * @default       -
         * @description   The unit identifier.
         * @required      true
         * @since         1.0.0-dev
         * @var           int
         */
        'Unit' => 3

      ],

      /**
       * @default       -
       * @description   The document's title.
       * @required      true
       * @since         1.0.0-dev
       * @var           string
       */
      'Title' => 'Plain Text Document'

    ],

    /**
     * Document #2
     * ----------------------------------------------------------------------------------
     */
    [

      /**
       * @default       -
       * @description   The document's content.
       * @required      false
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
        'FileList' => ['https://www.talentlms.com/', 'https://www.talentcards.net/'],

        /**
         * @default       []
         * @description   The content's tags.
         * @required      false
         * @since         1.0.0-dev
         * @var           array
         */
        'TagList' => ['baz', 'qux'],

        /**
         * @default       null
         * @description   The plain text content.
         * @required      false
         * @since         1.0.0-dev
         * @var           null|string
         */
        'Text' => 'This is a sample HTML content ..'

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

      ],

      /**
       * @default       -
       * @description   The document's title.
       * @required      true
       * @since         1.0.0-dev
       * @var           string
       */
      'Title' => 'HTML Document'

    ]

  ],

  'Single' => [

    /**
     * Document #3
     * ----------------------------------------------------------------------------------
     */
    [

      /**
       * @default       -
       * @description   The document's content.
       * @required      false
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
        'FileList' => ['https://efrontlearning.com/'],

        /**
         * @default       []
         * @description   The content's tags.
         * @required      false
         * @since         1.0.0-dev
         * @var           array
         */
        'TagList' => ['blah'],

        /**
         * @default       null
         * @description   The plain text content.
         * @required      false
         * @since         1.0.0-dev
         * @var           null|string
         */
        'Text' => 'Κείμενο στα Ελληνικά. Yay!'

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

      ],

      /**
       * @default       -
       * @description   The document's title.
       * @required      true
       * @since         1.0.0-dev
       * @var           string
       */
      'Title' => 'Google Adwords'

    ],

    /**
     * Document #4
     * ----------------------------------------------------------------------------------
     */
    [

      /**
       * @default       -
       * @description   The document's content.
       * @required      false
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
         * @description   The content's tags.
         * @required      false
         * @since         1.0.0-dev
         * @var           array
         */
        'TagList' => ['talentlms', 'epignosis'],

        /**
         * @default       null
         * @description   The plain text content.
         * @required      false
         * @since         1.0.0-dev
         * @var           null|string
         */
        'Text' => 'Text? No Text ..'

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
        'Course' => 52,

        /**
         * @default       -
         * @description   The unit identifier.
         * @required      true
         * @since         1.0.0-dev
         * @var           int
         */
        'Unit' => 666

      ],

      /**
       * @default       -
       * @description   The document's title.
       * @required      true
       * @since         1.0.0-dev
       * @var           string
       */
      'Title' => 'Information Security'

    ]

  ]

];
