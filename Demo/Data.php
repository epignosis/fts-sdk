<?php

/**
 * For more information: https://github.com/epignosis/fts/wiki/Service-API
 */
/** @noinspection PhpUnusedLocalVariableInspection */
$data = [
  /**
   * For more information: https://github.com/epignosis/fts/wiki/Account
   */
  'Account' => [
    'Create' => [
      'Single' => [
        // Invalid:
        [

        ],
        // Valid:
        [
          'Domain' => 'https://xdev.com',
          'Status' => ''
        ],
        // Invalid:
        [
          'Status' => 'Enabled'
        ],
        // Valid:
        [
          'Domain' => 'panagop.talentlms.com',
          'Status' => 'Enabled'
        ],
        // Invalid:
        [
          'Domain' => 'example-1.com',
          'Status' => 0
        ],
        // Invalid:
        [
          'Domain' => 'example-2.com',
          'Status' => 1
        ],
        // Valid:
        [
          'Domain' => 'http://papagel.talentlms.com',
          'Status' => 'Disabled'
        ],
        // Valid:
        [
          'Domain' => 'pvenakis.com',
          'Status' => 'Disabled'
        ],
        // Invalid:
        [
          'Domain' => 'foobar',
          'Status' => 'Disabled'
        ]
      ]
    ]
  ],
  /**
   * For more information: https://github.com/epignosis/fts/wiki/Document
   */
  'Document' => [
    'DeIndex' => [
      'Multiple' => [
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
        ]
      ],
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
    ],
    'Search' => [
      'Multiple' => [
        // Valid:
        [

        ],
        // Invalid:
        [
          'Source' => 'blah'
        ],
        // Invalid:
        [
          'Pagination' => [
            'Limit' => -22
          ]
        ],
        // Invalid:
        [
          'Pagination' => [
            'Limit' => 'bar'
          ]
        ],
        // Valid:
        [
          'Pagination' => [
            'Limit' => 5,
            'Offset' => 0
          ],
          'PermissionPolicy' => [
            'Id' => null
          ],
          'Query' => [
            'Text' => 'eFrontPro by Epignosis LLC!'
          ],
          'Source' => [
            'All'
          ]
        ],
        // Invalid:
        [
          'Pagination' => [
            'Offset' => -7
          ]
        ],
        // Invalid:
        [
          'Pagination' => [
            'Offset' => 'baz'
          ]
        ],
      ]
    ]
  ],
  /**
   * For more information: https://github.com/epignosis/fts/wiki/Permission-Policy
   */
  'PermissionPolicy' => [
    'Delete' => [
      'Multiple' => [
        // Valid:
        [
          'Id' => 1
        ],
        // Valid:
        [
          'Id' => 5
        ],
        // Invalid:
        [
          'Id' => -1
        ],
        // Invalid:
        [

        ],
        // Invalid:
        [
          'Id' => 'Id'
        ],
        // Valid:
        [
          'Id' => 100
        ]
      ],
      'Single' => [
        // Invalid:
        [

        ],
        // Valid:
        [
          'Id' => 82
        ],
        // Valid:
        [
          'Id' => 55
        ],
        // Invalid:
        [
          'Id' => -100
        ],
        // Invalid:
        [
          'Id' => 'Id'
        ],
        // Valid:
        [
          'Id' => 70
        ]
      ]
    ],
    'Push' => [
      'Multiple' => [
        // Valid:
        [
          'Id' => 82,
          'Policy' => '[]'
        ],
        // Invalid:
        [

        ],
        // Valid:
        [
          'Id' => 5,
          'Policy' => '[]'
        ],
        // Invalid:
        [
          'Id' => 5
        ],
        // Invalid:
        [
          'Id' => 5,
          'Policy' => 'foobar'
        ],
        // Valid:
        [
          'Id' => 4,
          'Policy' => '[]'
        ],
        // Invalid:
        [
          'Policy' => '[]'
        ],
        // Valid:
        [
          'Id' => 4,
          'Policy' => '[]'
        ]
      ],
      'Single' => [
        // Valid:
        [
          'Id' => 1,
          'Policy' => '[]'
        ],
        // Invalid:
        [

        ],
        // Invalid:
        [
          'Policy' => '[]'
        ],
        // Valid:
        [
          'Id' => 1,
          'Policy' => '[]'
        ],
        // Valid:
        [
          'Id' => 13,
          'Policy' => '[]'
        ],
        // Invalid:
        [
          'Id' => 5,
          'Policy' => 'foobar'
        ],
        // Invalid:
        [
          'Id' => 4
        ],
        // Valid:
        [
          'Id' => 4,
          'Policy' => '[]'
        ]
      ]
    ]
  ]
];
