<?php

/**
 * The FullTextSearch PHP SDK configuration.
 *
 * @since   1.0.0-dev
 * @var     array
 */
/** @noinspection PhpUnusedLocalVariableInspection */
$configuration = [

  /**
   * The auth configuration.
   *
   * @since   1.0.0-dev
   * @var     array
   */
  'Auth' => [

    /**
     * The auth key configuration.
     *
     * @since   1.0.0-dev
     * @var     array
     */
    'Key' => [

      /**
       * The private auth key configuration.
       *
       * @since   1.0.0-dev
       * @var     array
       */
      'Private' => [

        /**
         * The private read key.
         *
         * @since   1.0.0-dev
         * @var     string
         */
        'Read' => 'pcSEcve89u2+nkLuQIbvQHenZDTL0oCWGsJePg58E0WB7jbZnGsTIkXF+hUY4ih6',

        /**
         * The private write key.
         *
         * @since   1.0.0-dev
         * @var     string
         */
        'Write' => 'gKNp4KXTRrDlA2jOj+vWIk0kT4vJh7MdMCqM7dUuOSSjnOqHvJ66TNXllxuE3ycV'

      ],

      /**
       * The public auth key configuration.
       *
       * @since   1.0.0-dev
       * @var     array
       */
      'Public' => [

        /**
         * The public read key.
         *
         * @since   1.0.0-dev
         * @var     string
         */
        'Read' => 'HFM/n0oSe8jqdfm6vLPB0PlAW1tFBmaU',

        /**
         * The public write key.
         *
         * @since   1.0.0-dev
         * @var     string
         */
        'Write' => 'GmVeZ6hfe1P+KEo63xA+kwMKgu0XW6kW'

      ]

    ]

  ],

  /**
   * The hypermedia configuration.
   *
   * @since   2.0.0-dev
   * @var     array
   */
  'Hypermedia' => [

    /**
     * The hypermedia storage configuration.
     *
     * @since   2.0.0-dev
     * @var     array
     */
    'Storage' => [

      /**
       * The storage file path.
       *
       * @since   2.0.0-dev
       * @var     string
       */
      'FilePath' => rtrim(__DIR__, '\/') . \DIRECTORY_SEPARATOR . 'Hypermedia',

      /**
       * The storage file path permission.
       *
       * @since   2.0.0-dev
       * @var     int
       */
      'Mode' => 0777

    ]

  ],

  /**
   * The service configuration.
   *
   * @since   2.0.0-dev
   * @var     array
   */
  'Service' => [

    /**
     * The agent string to be send, for the communication with the service.
     *
     * @since   2.0.0-dev
     * @var     null|string
     */
    'Agent' => null,

    /**
     * The service base endpoint.
     *
     * @since   2.0.0-dev
     * @var     string
     */
    'BaseEndpoint' => 'http://127.0.0.1/',

    /**
     * The default format to be used, for the communication with the service.
     *
     * @since   2.0.0-dev
     * @var     string
     */
    'Format' => 'JSON',

    /**
     * The default language to be used, for the communication with the service.
     *
     * @since   2.0.0-dev
     * @var     string
     */
    'Language' => 'en-US',

    /**
     * The default interface version to be used, for the communication with the service.
     *
     * @since   2.0.0-dev
     * @var     string
     */
    'Version' => '2'

  ]

];
