<?php

/**
 * Invalid
 *
 *  - Undefined or invalid "Id".
 *  - Undefined or invalid "Policy".
 *
 * For more information call [OPTIONS] /permission-policy
 */
$data['PermissionPolicy']['Push']['Single'] = [
  [
    'Id' => 7,
    'Policy' => '[6, 7, 8]'
  ],
  // Replace:
  [
    'Id' => 7,
    'Policy' => '[]'
  ],
  [
    'Id' => 3,
    'Policy' => '[]'
  ]
];
