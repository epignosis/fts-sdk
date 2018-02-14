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
 * For more information call [OPTIONS] /document
 */
$data['Document']['Index']['Single'] = [
  [
    'Content' => [
      'FileList' => [
        'https://en.wikipedia.org/wiki/The_Evil_Within_2',
        'https://i.ytimg.com/vi/Q_UpPkQ3Y2c/maxresdefault.jpg'
      ],
      'TagList' => [
        'Horror',
        'Game'
      ]
    ],
    'Id' => [
      'Course' => 12,
      'Lesson' => 1000,
      'Unit' => 5999
    ],
    'Title' => 'The Evil Withing 2'
  ],
  [
    'Id' => [
      'Course' => 454,
      'Unit' => 22854
    ],
    'Title' => 'Τίτλος σε Ελληνικά'
  ]
];
