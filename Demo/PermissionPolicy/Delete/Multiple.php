<?php

/**
 * For more information: https://github.com/epignosis/fts/wiki/Permission-Policy
 */
$data['PermissionPolicy']['Delete']['Multiple'] = [
  // Valid:
  [
    'Id' => 1
  ],
  // Valid:
  [
    'Id' => 5
  ],
  // Invalid:
  [
    'Id' => -1
  ],
  // Invalid:
  [

  ],
  // Invalid:
  [
    'Id' => 'Id'
  ],
  // Valid:
  [
    'Id' => 100
  ]
];
