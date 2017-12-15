<?php

/**
 * Invalid
 *
 *  - Undefined or invalid "Id".
 *
 * For more information call [OPTIONS] /permission-policies
 */
$data['PermissionPolicy']['Delete']['Multiple'] = [
  [
    'Id' => 9
  ],
  [
    'Id' => 8
  ],
  // Not Exist; Still OK:
  [
    'Id' => 9
  ]
];
