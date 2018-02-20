<?php

/**
 * Invalid
 *
 *  - Invalid "Pagination.Limit".
 *  - Invalid "Pagination.Offset".
 *  - Undefined or invalid "PermissionPolicy.Id".
 *  - Undefined or invalid "Query.Text".
 *  - Invalid "Source".
 *
 * For more information call [OPTIONS] /documents
 */
$data['Document']['Search']['Single'] = [
  [
    'Pagination' => [
      'Limit' => 10,
      'Offset' => 0
    ],
    'PermissionPolicy' => [
      'Id' => 9
    ],
    'Query' => [
      'Text' => 'Resident'
    ],
    'Source' => 'Any'
  ]
];
