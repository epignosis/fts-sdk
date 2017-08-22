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
          'Domain' => 'jp.talentlms.com',
          'Status' => 1
        ],
        [
          'Domain' => 'http://ap.talentlms.com',
          'Status' => 0
        ],
        [
          'Domain' => 'pv.com',
          'Status' => 0
        ]
      ]
    ]
  ],
  'Document' => [
    'DeIndex' => [
      'Multiple' => [

      ],
      'Single' => [

      ]
    ],
    'Index' => [
      'Multiple' => [

      ],
      'Single' => [

      ]
    ],
    'Search' => [
      'Single' => [

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
