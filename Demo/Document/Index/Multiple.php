<?php

/**
 * For more information: https://github.com/epignosis/fts/wiki/Document
 */
/** @noinspection SpellCheckingInspection */
$data['Document']['Index']['Multiple'] = [
  // Invalid:
  [

  ],
  // Invalid:
  [
    'Content' => [
      'FileList' => [],
      'TagList' => ['foo', 'bar'],
      'Text' => 'This is a sample plain text content ..'
    ]
  ],
  // Invalid:
  [
    'Content' => [
      'FileList' => [],
      'TagList' => ['foo', 'bar'],
      'Text' => 'This is a sample plain text content ..'
    ],
    'Id' => [
      'Course' => 1,
      'Lesson' => 2,
      'Unit' => 3
    ]
  ],
  // Invalid:
  [
    'Content' => [
      'FileList' => [],
      'TagList' => ['foo', 'bar'],
      'Text' => 'This is a sample plain text content ..'
    ],
    'Title' => 'Plain Text Document'
  ],
  // Invalid:
  [
    'Content' => [
      'FileList' => [],
      'TagList' => ['foo', 'bar'],
      'Text' => 'This is a sample plain text content ..'
    ],
    'Id' => [
      'Lesson' => 2,
      'Unit' => 3
    ],
    'Title' => 'Plain Text Document'
  ],
  // Invalid:
  [
    'Content' => [
      'FileList' => [],
      'TagList' => ['foo', 'bar'],
      'Text' => 'This is a sample plain text content ..'
    ],
    'Id' => [
      'Course' => 1,
      'Lesson' => 2
    ],
    'Title' => 'Plain Text Document'
  ],
  // Valid:
  [
    'Content' => [
      'FileList' => [],
      'TagList' => ['foo', 'bar'],
      'Text' => 'This is a sample plain text content ..'
    ],
    'Id' => [
      'Course' => 1,
      'Lesson' => 2,
      'Unit' => 3
    ],
    'Title' => 'Plain Text Document'
  ],
  // Valid:
  [
    'Content' => [
      'FileList' => ['https://www.talentlms.com/', 'https://www.talentcards.net/'],
      'TagList' => ['baz', 'qux'],
      'Text' => 'This is a sample HTML content ..'
    ],
    'Id' => [
      'Course' => 4,
      'Lesson' => null,
      'Unit' => 6
    ],
    'Title' => 'HTML Document'
  ]
];
