<?php

/**
 * For more information: https://github.com/epignosis/fts/wiki/Account
 */
$data['Account']['Create']['Single'] = [
  // Invalid. No Data.
  [

  ],
  // Valid.
  [
    'Domain' => 'https://xdev.com',
    'Status' => ''
  ],
  // Invalid. No Domain.
  [
    'Status' => 'Enabled'
  ],
  // Valid.
  [
    'Domain' => 'panagop.talentlms.com',
    'Status' => 'Enabled'
  ],
  // Invalid. Not valid status.
  [
    'Domain' => 'example-1.com',
    'Status' => 0
  ],
  // Invalid. Not valid status.
  [
    'Domain' => 'example-2.com',
    'Status' => 1
  ],
  // Valid.
  [
    'Domain' => 'http://papagel.talentlms.com',
    'Status' => 'Disabled'
  ],
  // Valid.
  [
    'Domain' => 'pvenakis.com',
    'Status' => 'Disabled'
  ],
  // Invalid.
  [
    'Domain' => 'foobar',
    'Status' => 'Disabled'
  ]
];
