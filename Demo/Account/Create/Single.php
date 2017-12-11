<?php

/**
 * For more information: https://github.com/epignosis/fts/wiki/Account
 */
/** @noinspection SpellCheckingInspection */
$data['Account']['Create']['Single'] = [
  // Invalid:
  [

  ],
  // Invalid:
  [
    'Domain' => 'https://xdev.com',
    'Status' => ''
  ],
  // Valid:
  [
    'Domain' => 'https://xdev.com',
    'Plan' => 'Hosted',
    'Status' => ''
  ],
  // Invalid:
  [
    'Status' => 'Enabled'
  ],
  // Valid:
  [
    'Domain' => 'panagop.talentlms.com',
    'Plan' => 'Premium Standard',
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
    'Plan' => 'Free',
    'Status' => 'Disabled'
  ],
  // Valid:
  [
    'Domain' => 'pvenakis.com',
    'Plan' => 'Deployed',
    'Status' => 'Enabled'
  ],
  // Invalid:
  [
    'Domain' => 'pvenakis.com',
    'Plan' => 'Deployed',
    'Status' => 'Enabled'
  ],
  // Invalid:
  [
    'Domain' => 'foobar',
    'Status' => 'Disabled'
  ],
  // Invalid:
  [
    'Domain' => 'georgia.efrontlearning.com',
    'Plan' => 'Basic Unlimited',
    'Status' => 'Enabled'
  ],
  // Invalid:
  [
    'Domain' => 'georgia.talentlms.com',
    'Plan' => 'Demo',
    'Status' => 'Enabled'
  ]
];
