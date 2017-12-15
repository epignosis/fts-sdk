<?php

/**
 * Invalid
 *
 *  - Undefined or invalid "Domain".
 *  - Undefined or invalid "Plan".
 *  - Invalid "Status".
 *
 * For more information call [OPTIONS] /account
 */
$data['Account']['Create']['Single'] = [
  [
    'Domain' => 'https://xdev.com',
    'Plan' => 'Deployed',
    'Status' => 'Enabled'
  ],
  [
    'Domain' => 'https://panagop.com',
    'Plan' => 'Hosted',
    'Status' => 'Disabled'
  ],
];
