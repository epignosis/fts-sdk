<?php

/**
 * Invalid
 *
 *  - Undefined or invalid "Id.Course".
 *  - Invalid "Id.Lesson".
 *  - Undefined or invalid "Id.Unit".
 *
 * For more information call [OPTIONS] /document
 */
$data['Document']['DeIndex']['Single'] = [
  [
    'Id' => [
      'Course' => 454,
      'Lesson' => 22,
      'Unit' => 22854
    ]
  ],
  [
    'Id' => [
      'Course' => 12,
      'Unit' => 5999
    ]
  ],
  // Not Exist; Valid:
  [
    'Id' => [
      'Course' => 666,
      'Unit' => 999
    ]
  ]
];
