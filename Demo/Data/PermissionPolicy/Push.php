<?php

$data = [

  /**
   * Permission Policy #1
   * ------------------------------------------------------------------------------------
   */
  [

    /**
     * @default       -
     * @description   The permission policy identifier. Could be the internal user
     *                identifier on the LMS.
     * @required      true
     * @since         1.0.0-dev
     * @var           int
     */
    'Id' => 1,

    /**
     * @default       -
     * @description   The permission policy. It is an indexed array, with accessible
     *                course identifiers as keys, and an array of non-accessible unit
     *                identifiers as values. MUST be in JSON format.
     *
     *                Example: {"7":[],"22":[6,9]}
     *
     * @required      true
     * @since         1.0.0-dev
     * @var           string
     */
    'Policy' => '{"39":[5]}'

  ],

  /**
   * Permission Policy #2 / Updates Permission Policy #1
   * ------------------------------------------------------------------------------------
   */
  [

    /**
     * @default       -
     * @description   The permission policy identifier. Could be the internal user
     *                identifier on the LMS.
     * @required      true
     * @since         1.0.0-dev
     * @var           int
     */
    'Id' => 1,

    /**
     * @default       -
     * @description   The permission policy. It is an indexed array, with accessible
     *                course identifiers as keys, and an array of non-accessible unit
     *                identifiers as values. MUST be in JSON format.
     *
     *                Example: {"7":[],"22":[6,9]}
     *
     * @required      true
     * @since         1.0.0-dev
     * @var           string
     */
    'Policy' => '[]'

  ],

  /**
   * Permission Policy #3
   * ------------------------------------------------------------------------------------
   */
  [

    /**
     * @default       -
     * @description   The permission policy identifier. Could be the internal user
     *                identifier on the LMS.
     * @required      true
     * @since         1.0.0-dev
     * @var           int
     */
    'Id' => 2,

    /**
     * @default       -
     * @description   The permission policy. It is an indexed array, with accessible
     *                course identifiers as keys, and an array of non-accessible unit
     *                identifiers as values. MUST be in JSON format.
     *
     *                Example: {"7":[],"22":[6,9]}
     *
     * @required      true
     * @since         1.0.0-dev
     * @var           string
     */
    'Policy' => '{"12":[],"13":[14,15]}',

  ]

];
