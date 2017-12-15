<?php

/**
 * Invalid
 *
 *  - Undefined or invalid "Id".
 *
 * For more information call [OPTIONS] /permission-policy
 */
$data['PermissionPolicy']['Delete']['Single'] = [
  [
    'Id' => 7,
  ],
  // Not Exist; Still OK:
  [
    'Id' => 7,
  ],
  [
    'Id' => 3,
  ]
];
