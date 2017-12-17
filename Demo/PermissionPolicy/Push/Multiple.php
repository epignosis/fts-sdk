<?php

/**
 * Invalid
 *
 *  - Undefined or invalid "Id".
 *  - Undefined or invalid "Policy".
 *
 * For more information call [OPTIONS] /permission-policies
 */
$data['PermissionPolicy']['Push']['Multiple'] = [
  [
    'Id' => 9,
    'Policy' => json_encode([])
  ],
  [
    'Id' => 8,
    'Policy' => json_encode([])
  ],
  // Replace:
  [
    'Id' => 9,
    'Policy' => json_encode([1 => [], 2 => [5, 6], 3 => []])
  ]
];
