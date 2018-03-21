<?php

/**
 * The FullTextSearch PHP SDK configuration.
 *
 * @since   1.0.0
 * @var     array
 */
/** @noinspection PhpUnusedLocalVariableInspection */
$configuration = [

  /**
   * The auth configuration.
   *
   * @since   1.0.0
   * @var     array
   */
  'Auth' => [

    /**
     * The auth key configuration.
     *
     * @since   1.0.0
     * @var     array
     */
    'Key' => [

      /**
       * The private auth key configuration.
       *
       * @since   1.0.0
       * @var     array
       */
      'Private' => [

        /**
         * The private read key.
         *
         * @since   1.0.0
         * @var     string
         */
        'Read' => 'test',

        /**
         * The private write key.
         *
         * @since   1.0.0
         * @var     string
         */
        'Write' => 'test'

      ],

      /**
       * The public auth key configuration.
       *
       * @since   1.0.0
       * @var     array
       */
      'Public' => [

        /**
         * The public read key.
         *
         * @since   1.0.0
         * @var     string
         */
        'Read' => 'test',

        /**
         * The public write key.
         *
         * @since   1.0.0
         * @var     string
         */
        'Write' => 'test'

      ]

    ]

  ],

  /**
   * The connection configuration.
   *
   * @since   3.3.0
   * @var     array
   */
  'Connection' => [

    /**
     * The connection timeout in seconds.
     *
     * @since   3.3.0
     * @var     int
     */
    'Timeout' => 10

  ],

  /**
   * The hypermedia configuration.
   *
   * @since   2.0.0
   * @var     array
   */
  'Hypermedia' => [

    /**
     * The hypermedia storage configuration.
     *
     * @since   2.0.0
     * @var     array
     */
    'Storage' => [

      /**
       * The storage file path.
       *
       * @since   2.0.0
       * @var     string
       */
      'FilePath' => rtrim(__DIR__, \DIRECTORY_SEPARATOR) . \DIRECTORY_SEPARATOR . 'Hypermedia',

      /**
       * The storage file path permission.
       *
       * @since   2.0.0
       * @var     int
       */
      'Mode' => 0777

    ]

  ],

  /**
   * The service configuration.
   *
   * @since   2.0.0
   * @var     array
   */
  'Service' => [

    /**
     * The agent string to be send, for the communication with the service.
     *
     * @since   2.0.0
     * @var     null|string
     */
    'Agent' => null,

    /**
     * The service base endpoint.
     *
     * @since   2.0.0
     * @var     string
     */
    'BaseEndpoint' => 'http://127.0.0.1/',

    /**
     * The default format to be used, for the communication with the service.
     *
     * @since   2.0.0
     * @var     string
     */
    'Format' => 'JSON',

    /**
     * The default language to be used, for the communication with the service.
     *
     * @since   2.0.0
     * @var     string
     */
    'Language' => 'en-US',

    /**
     * The default interface version to be used, for the communication with the service.
     *
     * @since   2.0.0
     * @var     string
     */
    'Version' => '2'

  ]

];
