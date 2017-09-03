<?php

/**
 * For more information: https://github.com/epignosis/fts/wiki/Document
 */
$data['Document']['Search']['Single'] = [
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
    'PermissionPolicy' => [
      'Id' => -10
    ]
  ],
  // Invalid:
  [
    'PermissionPolicy' => [
      'Id' => 'foo'
    ]
  ],
  // Invalid:
  [
    'PermissionPolicy' => [
      'Id' => 'foo'
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
