<?php

/**
 * For more information: https://github.com/epignosis/fts/wiki/Permission-Policy
 */
$data['PermissionPolicy']['Push']['Multiple'] = [
  // Valid:
  [
    'Id' => 82,
    'Policy' => '[]'
  ],
  // Invalid:
  [

  ],
  // Valid:
  [
    'Id' => 5,
    'Policy' => '[]'
  ],
  // Invalid:
  [
    'Id1' => 10,
    'Policy' => '[]'
  ],
  // Invalid:
  [
    'Id' => 5
  ],
  // Invalid:
  [
    'Id' => 5,
    'Policy' => 'foobar'
  ],
  // Valid:
  [
    'Id' => 4,
    'Policy' => '[]'
  ],
  // Invalid:
  [
    'Policy' => '[]'
  ],
  // Valid:
  [
    'Id' => 4,
    'Policy' => '[]'
  ]
];
