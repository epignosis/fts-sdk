<?php

$data = [

  /**
   * Account #1
   * ----------------------------------------------------------------------------------
   */
  [

    /**
     * @default       -
     * @description   The domain that the account controls.
     * @required      true
     * @since         1.0.0-dev
     * @var           bool
     */
    'Domain' => 'xdev.com',

    /**
     * @default       null
     * @description   The search index to assign the account. If index will not be set,
     *                the service will auto assign the account to the best available
     *                index, after considering a set of different factors. Available
     *                indexes are, "Proton" and "Nero". Keep in mind, that setting a
     *                custom index, can lead to the inability to create the account.
     * @required      true
     * @since         1.0.0-dev
     * @var           null|string
     */
    'Index' => "Nero",

    /**
     * @default       1
     * @description   The status of the account. Use 1 to be "Enabled" or 0 to be
     *                "Disabled".
     *
     * @required      false
     * @since         1.0.0-dev
     * @var           int
     */
    'Status' => 1

  ],

  /**
   * Account #2
   * ----------------------------------------------------------------------------------
   */
  [

    /**
     * @default       -
     * @description   The domain that the account controls.
     * @required      true
     * @since         1.0.0-dev
     * @var           bool
     */
    'Domain' => 'panagop.talentlms.com',

    /**
     * @default       null
     * @description   The search index to assign the account. If index will not be set,
     *                the service will auto assign the account to the best available
     *                index, after considering a set of different factors. Available
     *                indexes are, "Proton" and "Nero". Keep in mind, that setting a
     *                custom index, can lead to the inability to create the account.
     * @required      true
     * @since         1.0.0-dev
     * @var           null|string
     */
    'Index' => null,

    /**
     * @default       1
     * @description   The status of the account. Use 1 to be "Enabled" or 0 to be
     *                "Disabled".
     *
     * @required      false
     * @since         1.0.0-dev
     * @var           int
     */
    'Status' => 1

  ]

];
