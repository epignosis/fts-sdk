<?php

/**
 * Invalid
 *
 *  - Invalid "Content.FileList".
 *  - Invalid "Content.TagList".
 *  - Invalid "Content.Text".
 *  - Undefined or invalid "Id.Course".
 *  - Invalid "Id.Lesson".
 *  - Undefined or invalid "Id.Unit".
 *  - Undefined or invalid "Title".
 *
 * For more information call [OPTIONS] /documents
 */
$data['Document']['Index']['Multiple'] = [
  [
    'Content' => [
      'TagList' => [
        'baz',
        'qux'
      ],
      'Text' => 'This is my content!'
    ],
    'Id' => [
      'Course' => 454,
      'Lesson' => 22,
      'Unit' => 22854
    ],
    'Title' => 'foo bar'
  ],
  [
    'Content' => [
      'FileList' => [
        'https://i.ytimg.com/vi/5iszUCmLyW4/maxresdefault.jpg',
        'https://en.wikipedia.org/wiki/Resident_Evil_7:_Biohazard'
      ],
      'TagList' => [
        'Horror',
        'Game'
      ]
    ],
    'Id' => [
      'Course' => 12,
      'Unit' => 5999
    ],
    'Title' => 'Resident Evil 7'
  ]
];
