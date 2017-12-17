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
    'Policy' => json_encode([])
  ],
  // Replace:
  [
    'Id' => 7,
    'Policy' => json_encode([6 => [], 7 => [], 8 => []])
  ],
  [
    'Id' => 3,
    'Policy' => json_encode([])
  ]
];
