<?php

/** @noinspection SpellCheckingInspection */
$data = [

  /**
   * Document #1
   */
  [

    /**
     * @description   The document's list of access rules.
     * @default       -
     * @required      true
     * @since         1.0.0-dev
     * @var           array
     */
    'AccessRuleList' => [

      /**
       * @description   The availability information.
       * @default       []
       * @required      false
       * @since         1.0.0-dev
       * @var           array
       */
      'Availability' => [

        /**
         * @description   The initial availability information.
         * @default       null
         * @required      false
         * @since         1.0.0-dev
         * @var           null|int
         */
        'From' => null,

        /**
         * @description   The final availability information.
         * @default       null
         * @required      false
         * @since         1.0.0-dev
         * @var           null|int
         */
        'To' => null

      ],

      /**
       * @description   The list of the course(s) identifier(s), that may be required to
       *                complete.
       * @default       []
       * @required      false
       * @since         1.0.0-dev
       * @var           array
       */
      'CourseListIdCompleted' => [],

      /**
       * @description   The unit identifier, that may be required to complete.
       *                (Sequential Rule)
       * @default       null
       * @required      false
       * @since         1.0.0-dev
       * @var           null|int
       */
      'UnitIdCompleted' => null

    ],

    /**
     * @description   The document's content information.
     * @default       -
     * @required      true
     * @since         1.0.0-dev
     * @var           array
     */
    'Content' => [

      /**
       * @description   The list of the content's files.
       * @default       []
       * @required      false
       * @since         1.0.0-dev
       * @var           array
       */
      'FileList' => [
        'http://math.hws.edu/eck/cs124/downloads/javanotes6-linked.pdf',
        'http://cevre.beun.edu.tr/zeydan/pdf/introduction-to-computer-programming.pdf',
        'http://www.icsd.aegean.gr/lecturers/kavallieratou/Cplusplus_files/notes.pdf'
      ],

      /**
       * @description   The list of the content's tags.
       * @default       []
       * @required      false
       * @since         1.0.0-dev
       * @var           array
       */
      'TagList' => [
        'program',
        'instruction',
        'computer'
      ],

      /**
       * @description   The plain text content.
       * @default       null
       * @required      false
       * @since         1.0.0-dev
       * @var           string
       */
      'Text' =>
        'A program is a set of instructions that tell the computer to do various ' .
        'things; sometimes the instruction it has to perform depends on what happened ' .
        'when it performed a previous instruction.',

      /**
       * @description   The title.
       * @default       -
       * @required      true
       * @since         1.0.0-dev
       * @var           string
       */
      'Title' => '(1.0) Introduction to Programming'

    ],

    /**
     * @description   The document's identifiers.
     * @default       -
     * @required      true
     * @since         1.0.0-dev
     * @var           array
     */
    'Id' => [

      /**
       * @description   The course identifier.
       * @default       -
       * @required      true
       * @since         1.0.0-dev
       * @var           int
       */
      'Course' => 17,

      /**
       * @description   The lesson identifier.
       * @default       null
       * @required      false
       * @since         1.0.0-dev
       * @var           null|int
       */
      'Lesson' => 65,

      /**
       * @description   The unit identifier.
       * @default       -
       * @required      true
       * @since         1.0.0-dev
       * @var           int
       */
      'Unit' => 341
    ]

  ]

];
