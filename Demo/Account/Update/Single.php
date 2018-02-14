<?php

/**
 * Invalid
 *
 *  - Undefined or invalid "Domain".
 *  - Undefined or invalid "Id".
 *  - Undefined or invalid "Plan".
 *  - Invalid "Status".
 *
 * For more information call [OPTIONS] /account
 */
$data['Account']['Update']['Single'] = [
  [
    'Domain' => 'https://xdev.com',
    'Id' => 3,
    'Plan' => 'Paid',
    'Status' => 'Enabled'
  ],
  [
    'Domain' => 'https://panagop.talentlms.com',
    'Id' => 4,
    'Plan' => 'Big',
    'Status' => 'Enabled'
  ],
];
