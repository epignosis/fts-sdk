<?php

/**
 * Invalid
 *
 *  - Undefined or invalid "Id.Course".
 *  - Invalid "Id.Lesson".
 *  - Undefined or invalid "Id.Unit".
 *
 * For more information call [OPTIONS] /documents
 */
$data['Document']['DeIndex']['Multiple'] = [
  [
    'Id' => [
      'Course' => 12,
      'Lesson' => 1000,
      'Unit' => 5999
    ]
  ],
  // Not Exist; Valid:
  [
    'Id' => [
      'Course' => 12,
      'Lesson' => 1000,
      'Unit' => 5999
    ]
  ],
  [
    'Id' => [
      'Course' => 454,
      'Unit' => 22854
    ]
  ]
];
