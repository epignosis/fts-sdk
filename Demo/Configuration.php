<?php

$configuration = [
  'Auth' => [
    'Key' => [
      'Private' => [
        'Read' => null,
        'Write' => null
      ],
      'Public' => [
        'Read' => null,
        'Write' => null
      ]
    ]
  ],
  'Service' => [
    'Format' => 'JSON',
    'Language' => 'en-US',
    'Version' => '1'
  ]
];


/**
 * Overrides
 */
require
  rtrim(dirname(dirname(__DIR__)), '\/') . \DIRECTORY_SEPARATOR .
  'FTS_SDK_CONFIG.php';
