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
     * @description   The product that is installed in this domain. Use 1 for an eFrontPro
     *                installation, or 2 for the TalentLMS.
     * @required      true
     * @since         1.0.0-dev
     * @var           int
     */
    'Product' => 1,

    /**
     * @default       1
     * @description   The status of the account. Use 1 to be active/enabled, or 0 to be
     *                inactive/disabled.
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
     * @description   The product that is installed in this domain. Use 1 for an eFrontPro
     *                installation, or 2 for the TalentLMS.
     * @required      true
     * @since         1.0.0-dev
     * @var           int
     */
    'Product' => 2,

    /**
     * @default       1
     * @description   The status of the account. Use 1 to be active/enabled, or 0 to be
     *                inactive/disabled.
     * @required      false
     * @since         1.0.0-dev
     * @var           int
     */
    'Status' => 1

  ]

];
