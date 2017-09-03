<?php

/**
 * For more information: https://github.com/epignosis/fts/wiki/Document
 */
/** @noinspection SpellCheckingInspection */
$data['Document']['Index']['Single'] = [
  // Invalid:
  [

  ],
  // Invalid:
  [
    'Content' => [
      'FileList' => ['https://efrontlearning.com/'],
      'TagList' => ['blah'],
      'Text' => 'Κείμενο στα Ελληνικά. Yay!'
    ]
  ],
  // Invalid:
  [
    'Content' => [
      'FileList' => ['https://efrontlearning.com/'],
      'TagList' => ['blah'],
      'Text' => 'Κείμενο στα Ελληνικά. Yay!'
    ],
    'Id' => [
      'Course' => 65536,
      'Lesson' => 4096,
      'Unit' => 1024
    ]
  ],
  // Invalid:
  [
    'Content' => [
      'FileList' => ['https://efrontlearning.com/'],
      'TagList' => ['blah'],
      'Text' => 'Κείμενο στα Ελληνικά. Yay!'
    ],
    'Title' => 'Google Adwords'
  ],
  // Invalid:
  [
    'Content' => [
      'FileList' => ['https://efrontlearning.com/'],
      'TagList' => ['blah'],
      'Text' => 'Κείμενο στα Ελληνικά. Yay!'
    ],
    'Id' => [
      'Lesson' => 4096,
      'Unit' => 1024
    ],
    'Title' => 'Google Adwords'
  ],
  // Invalid:
  [
    'Content' => [
      'FileList' => ['https://efrontlearning.com/'],
      'TagList' => ['blah'],
      'Text' => 'Κείμενο στα Ελληνικά. Yay!'
    ],
    'Id' => [
      'Course' => 65536,
      'Lesson' => 4096
    ],
    'Title' => 'Google Adwords'
  ],
  // Valid:
  [
    'Content' => [
      'FileList' => ['https://efrontlearning.com/'],
      'TagList' => ['blah'],
      'Text' => 'Κείμενο στα Ελληνικά. Yay!'
    ],
    'Id' => [
      'Course' => 65536,
      'Lesson' => 4096,
      'Unit' => 1024
    ],
    'Title' => 'Google Adwords'
  ],
  // Valid:
  [
    'Content' => [
      'FileList' => [],
      'TagList' => ['talentlms', 'epignosis'],
      'Text' => 'Text? No Text ..'
    ],
    'Id' => [
      'Course' => 52,
      'Unit' => 666
    ],
    'Title' => 'Information Security'
  ]
];
