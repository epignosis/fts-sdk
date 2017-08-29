<?php

/**
 * For more information: https://github.com/epignosis/fts/wiki/Permission-Policy
 */
$data['PermissionPolicy']['Push']['Single'] = [
  // Valid:
  [
    'Id' => 1,
    'Policy' => '[]'
  ],
  // Invalid:
  [

  ],
  // Invalid:
  [
    'Policy' => '[]'
  ],
  // Valid:
  [
    'Id' => 1,
    'Policy' => '[]'
  ],
  // Valid:
  [
    'Id' => 13,
    'Policy' => '[]'
  ],
  // Invalid:
  [
    'Id' => 5,
    'Policy' => 'foobar'
  ],
  // Invalid:
  [
    'Id' => 4
  ],
  // Valid:
  [
    'Id' => 4,
    'Policy' => '[]'
  ]
];
