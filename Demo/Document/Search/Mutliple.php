<?php

/**
 * For more information: https://github.com/epignosis/fts/wiki/Permission-Policy
 */
$data['Document']['Search']['Multiple'] = [
  // Valid:
  [

  ],
  // Invalid:
  [
    'Source' => 'blah'
  ],
  // Invalid:
  [
    'Pagination' => [
      'Limit' => -22
    ]
  ],
  // Invalid:
  [
    'Pagination' => [
      'Limit' => 'bar'
    ]
  ],
  // Valid:
  [
    'Pagination' => [
      'Limit' => 5,
      'Offset' => 0
    ],
    'PermissionPolicy' => [
      'Id' => null
    ],
    'Query' => [
      'Text' => 'eFrontPro by Epignosis LLC!'
    ],
    'Source' => [
      'All'
    ]
  ],
  // Invalid:
  [
    'Pagination' => [
      'Offset' => -7
    ]
  ],
  // Invalid:
  [
    'Pagination' => [
      'Offset' => 'baz'
    ]
  ]
];
