<?php

/**
 * As of FTS-SDK v2.
 */
$data = [
  'Account' => [
    'Create' => [
      'Single' => [
        [
          'Domain' => 'https://xdev.com',
          'Status' => 1
        ],
        [
          'Domain' => 'panagop.talentlms.com',
          'Status' => 1
        ],
        [
          'Domain' => 'http://papagel.talentlms.com',
          'Status' => 0
        ],
        [
          'Domain' => 'pvenakis.com',
          'Status' => 0
        ]
      ]
    ]
  ],
  'Document' => [
    'DeIndex' => [
      'Multiple' => [
        [
          'Id' => [
            'Course' => 1,
            'Lesson' => 2,
            'Unit' => 3
          ]
        ],
        [
          'Id' => [
            'Course' => 4,
            'Lesson' => null,
            'Unit' => 6
          ]
        ],
        [
          'Id' => [
            'Course' => 1,
            'Lesson' => 1,
            'Unit' => 1
          ]
        ]
      ],
      'Single' => [
        [
          'Id' => [
            'Course' => 65536,
            'Lesson' => 4096,
            'Unit' => 1024
          ]
        ],
        [
          'Id' => [
            'Course' => 52,
            'Unit' => 666
          ]
        ],
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

      ]
    ],
    'Search' => [
      'Single' => [
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
        ]
      ]
    ]
  ],
  'PermissionPolicy' => [
    'Delete' => [
      'Multiple' => [
        ['Id' => 1],
        ['Id' => 5],
        ['Id' => 100]
      ],
      'Single' => [
        ['Id' => 82],
        ['Id' => 55],
        ['Id' => 70]
      ]
    ],
    'Push' => [
      'Multiple' => [
        [
          'Id' => 82,
          'Policy' => '{"39":[5]}'
        ],
        [
          'Id' => 5,
          'Policy' => '{"1":[],"995":[650,1018,2314]}'
        ],
        [
          'Id' => 4,
          'Policy' => '[]'
        ],
        [
          'Id' => 4,
          'Policy' => '{"12":[],"13":[14,15]}'
        ]
      ],
      'Single' => [
        [
          'Id' => 1,
          'Policy' => '{"39":[5]}'
        ],
        [
          'Id' => 1,
          'Policy' => '[]'
        ],
        [
          'Id' => 13,
          'Policy' => '{"12":[],"13":[14,15]}'
        ],
        [
          'Id' => 4,
          'Policy' => '{"1":[],"995":[650,1018,2314]}'
        ]
      ]
    ]
  ]
];
