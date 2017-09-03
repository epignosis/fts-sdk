<?php

/**
 * For more information: https://github.com/epignosis/fts/wiki/Document
 */
$data['Document']['DeIndex']['Multiple'] = [
  // Valid:
  [
    'Id' => [
      'Course' => 1,
      'Lesson' => 2,
      'Unit' => 3
    ]
  ],
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
      'Course' => 4,
      'Lesson' => null,
      'Unit' => 6
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
      'Course' => 1,
      'Lesson' => 1,
      'Unit' => 1
    ]
  ],
  // Invalid:
  [
    'Id' => null
  ]
];
