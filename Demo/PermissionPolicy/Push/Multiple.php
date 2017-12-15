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
    'Policy' => '[]'
  ],
  [
    'Id' => 8,
    'Policy' => '[]'
  ],
  // Replace:
  [
    'Id' => 9,
    'Policy' => '[1, 2, 3]'
  ]
];
