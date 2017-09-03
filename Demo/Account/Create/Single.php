<?php

/**
 * For more information: https://github.com/epignosis/fts/wiki/Account
 */
/** @noinspection SpellCheckingInspection */
$data['Account']['Create']['Single'] = [
  // Invalid:
  [

  ],
  // Valid:
  [
    'Domain' => 'https://xdev.com',
    'Status' => ''
  ],
  // Invalid:
  [
    'Status' => 'Enabled'
  ],
  // Valid:
  [
    'Domain' => 'panagop.talentlms.com',
    'Status' => 'Enabled'
  ],
  // Invalid:
  [
    'Domain' => 'papathe.talentlms.com',
    'Status' => 'Enable'
  ],
  // Invalid:
  [
    'Domain' => 'example-1.com',
    'Status' => 0
  ],
  // Invalid:
  [
    'Domain' => 'example-2.com',
    'Status' => 1
  ],
  // Valid:
  [
    'Domain' => 'http://papagel.talentlms.com',
    'Status' => 'Disabled'
  ],
  // Valid:
  [
    'Domain' => 'pvenakis.com',
    'Status' => 'Enabled'
  ],
  // Invalid:
  [
    'Domain' => 'foobar',
    'Status' => 'Disabled'
  ]
];
