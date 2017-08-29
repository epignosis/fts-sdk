<?php

/**
 * For more information: https://github.com/epignosis/fts/wiki/Permission-Policy
 */
$data['PermissionPolicy']['Delete']['Single'] = [
  // Invalid:
  [

  ],
  // Valid:
  [
    'Id' => 82
  ],
  // Valid:
  [
    'Id' => 55
  ],
  // Invalid:
  [
    'Id' => -100
  ],
  // Invalid:
  [
    'Id' => 'Id'
  ],
  // Valid:
  [
    'Id' => 70
  ]
];
