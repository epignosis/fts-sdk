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
  'Mode' => [
    'Production' => false
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
if (!$configuration['Mode']['Production']) {
  require
    rtrim(dirname(dirname(__DIR__)), '\/') . \DIRECTORY_SEPARATOR .
    'FTS_SDK_CONFIG.php';
}
