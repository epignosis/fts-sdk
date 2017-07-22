<?php

namespace Demo\Helper;

use Epignosis\Helper\AutoLoader\AutoLoader;

$_SERVER['DEMO_NOW'] = microtime(true);
date_default_timezone_set('UTC');

if (false !== stripos(php_sapi_name(), 'cli', 0) || !empty($_SERVER['argv'])) {
  echo 'Command line interface (CLI) is not allowed. Script execution was terminated.';

  exit(1);
}

register_shutdown_function(function() {
  $error = error_get_last();

  $errorTypeList = [
    \E_COMPILE_ERROR,
    \E_CORE_ERROR,
    \E_ERROR,
    \E_RECOVERABLE_ERROR,
    \E_USER_ERROR
  ];

  if (in_array($error['type'], $errorTypeList, true)) {
    echo sprintf('<pre>%s</pre>', print_r($error, true));

    exit(2);
  }

  exit(0);
});

require 'Printer.php';

/** @noinspection PhpIncludeInspection */
require
  rtrim(dirname(__DIR__), \DIRECTORY_SEPARATOR) . \DIRECTORY_SEPARATOR .
  'Configuration.php';

$documentRootEpignosis =
  rtrim(dirname(dirname(__DIR__)), \DIRECTORY_SEPARATOR) . \DIRECTORY_SEPARATOR .
  'Source' . \DIRECTORY_SEPARATOR .
  'Epignosis' . \DIRECTORY_SEPARATOR;

/** @noinspection PhpIncludeInspection */
require
  $documentRootEpignosis .
  'Helper' . \DIRECTORY_SEPARATOR .
  'AutoLoader' . \DIRECTORY_SEPARATOR .
  'AutoLoader.php';

(new AutoLoader(true))
  ->SetNamespaceList(['Epignosis' => dirname($documentRootEpignosis)])
  ->RegisterSelf();
