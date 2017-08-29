<?php

/**
 * For more information: https://github.com/epignosis/fts/wiki/Service-API
 */
require 'Account' . \DIRECTORY_SEPARATOR . 'Create' . \DIRECTORY_SEPARATOR . 'Single.php';

$data = [
  'Document' => [
    'DeIndex' => [
      'Single' => [
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
      ]
    ],
    'Index' => [
      'Multiple' => [
        // Invalid:
        [

        ],
        // Invalid:
        [
          'Content' => [
            'FileList' => [],
            'TagList' => ['foo', 'bar'],
            'Text' => 'This is a sample plain text content ..'
          ],
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
          ],
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
      ],
      'Single' => [
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
          ],
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
      ]
    ]
  ]
];
