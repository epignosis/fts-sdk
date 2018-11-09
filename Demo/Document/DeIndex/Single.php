<?php

/**
 * Invalid
 *
 *  - Undefined or invalid "Id.Course".
 *  - Invalid "Id.Lesson".
 *  - Undefined or invalid "Id.Unit".
 *  - Undefined or invalid "Language".
 *
 * For more information call [OPTIONS] /document
 */
$data['Document']['DeIndex']['Single'] = [
  [
    'Id' => [
      'Course' => 454,
      'Lesson' => 22,
      'Unit' => 22854
    ],
    'Language' => 'en-US'
  ],
  [
    'Id' => [
      'Course' => 12,
      'Unit' => 5999
    ],
    'Language' => 'en-US'
  ],
  // Not Exist; Valid:
  [
    'Id' => [
      'Course' => 666,
      'Unit' => 999
    ],
    'Language' => 'de-DE'
  ]
];
