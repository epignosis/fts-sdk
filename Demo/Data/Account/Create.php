<?php

/** @noinspection SpellCheckingInspection */
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
     * @default       -
     * @description   The product identifier that is installed in this domain. Use 2 for
     *                an eFrontPro installation, or 3 for the TalentLMS. Use 1, in case
     *                that the domain is registered to the Epignosis LLC (corporate).
     * @required      true
     * @since         1.0.0-dev
     * @var           int
     */
    'ProductId' => 2,

    /**
     * @default       1
     * @description   The status of the account. Use 1 to be "Active / Enabled" or 0 to be
     *                "Inactive / Disabled".
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
     * @default       -
     * @description   The product identifier that is installed in this domain. Use 2 for
     *                an eFrontPro installation, or 3 for the TalentLMS. Use 1, in case
     *                that the domain is registered to the Epignosis LLC (corporate).
     * @required      true
     * @since         1.0.0-dev
     * @var           int
     */
    'ProductId' => 3,

    /**
     * @default       1
     * @description   The status of the account. Use 1 to be "Active / Enabled" or 0 to be
     *                "Inactive / Disabled".
     * @required      false
     * @since         1.0.0-dev
     * @var           int
     */
    'Status' => 1

  ]

];
