<?php

/**
 * For more information: https://github.com/epignosis/fts/wiki/Document
 */
$data['Document']['DeIndex']['Single'] = [
  // Invalid:
  [

  ],
  // Invalid:
  [
    'Id' => 'foo'
  ],
  // Valid:
  [
    'Id' => [
      'Course' => 65536,
      'Lesson' => 4096,
      'Unit' => 1024
    ]
  ],
  // Invalid:
  [
    'Id' => 111
  ],
  // Invalid:
  [
    'Id' => '4-6'
  ],
  // Valid:
  [
    'Id' => [
      'Course' => 52,
      'Unit' => 666
    ]
  ],
  // Valid:
  [
    'Id' => [
      'Course' => 1,
      'Unit' => 1
    ]
  ]
];
