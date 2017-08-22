<?php

$configuration = [
  'Auth' => [
    'Key' => [
      'Private' => [
        'Read' => 'pcSEcve89u2+nkLuQIbvQHenZDTL0oCWGsJePg58E0WB7jbZnGsTIkXF+hUY4ih6',
        'Write' => 'gKNp4KXTRrDlA2jOj+vWIk0kT4vJh7MdMCqM7dUuOSSjnOqHvJ66TNXllxuE3ycV'
      ],
      'Public' => [
        'Read' => 'HFM/n0oSe8jqdfm6vLPB0PlAW1tFBmaU3FWjrLYOycMyw8rOijm960CvJOkSDtMB',
        'Write' => 'GmVeZ6hfe1P+KEo63xA+kwMKgu0XW6kWGwyxCVAGpM2pG3Rmw/nirfRsYys3EtJc'
      ]
    ]
  ],
  'Service' => [
    'BaseEndpoint' => 'http://127.0.0.1/',
    'Format' => 'JSON',
    'Header' => [
      'Accept' => 'application/vnd.epignosis.v%d+%s',
      'AcceptLanguage' => '%s'
    ],
    'Language' => 'en-US',
    'Storage' => [
      'FilePath' => rtrim(__DIR__, '\/') . \DIRECTORY_SEPARATOR . 'HyperMedia'
    ],
    'Version' => 1
  ]
];
