<?php

/**
 * Full-Text Search Document SDK Demonstration
 * --------------------------------------------------------------------------------------
 */
namespace Demo;

use Epignosis\Helper\AutoLoader\AutoLoader;
use Epignosis\Sdk\FullTextSearch\Document;

/**
 * General Initialization
 * --------------------------------------------------------------------------------------
 */
$_SERVER['DEMO_NOW'] = microtime(true);
date_default_timezone_set('UTC');

/**
 * Check Server API
 * --------------------------------------------------------------------------------------
 */
if (false !== stripos(php_sapi_name(), 'cli', 0) || isset($_SERVER['argv'])) {
  echo 'Command line interface (CLI) is not allowed. Script execution was terminated.';

  exit(1);
}

/**
 * AutoLoader Initialization
 * --------------------------------------------------------------------------------------
 */
$epignosisFilePath =
  rtrim(dirname(__DIR__), \DIRECTORY_SEPARATOR) . \DIRECTORY_SEPARATOR .
  'Source' . \DIRECTORY_SEPARATOR .
  'Epignosis' . \DIRECTORY_SEPARATOR;

/** @noinspection PhpIncludeInspection */
require
  $epignosisFilePath .
  'Helper' . \DIRECTORY_SEPARATOR .
  'AutoLoader' . \DIRECTORY_SEPARATOR .
  'AutoLoader.php';

(new AutoLoader(true))
  ->SetNamespaceList(['Epignosis' => dirname($epignosisFilePath)])
  ->RegisterSelf();

/**
 * Full-Text Search Document SDK Configuration
 * --------------------------------------------------------------------------------------
 */
$configuration = [];

/**
 * Full-Text Search Document SDK Data
 * --------------------------------------------------------------------------------------
 */
$data = [
  'Document' => []
];

/**
 * Full-Text Search Document SDK Demonstration
 * --------------------------------------------------------------------------------------
 */
try {

  /**
   * Full-Text Search Document SDK Initialization
   * ------------------------------------------------------------------------------------
   */
  $response = [];
  $fullTextSearchDocumentSdk = new Document($configuration);

  /**
   * Create Document through the Full-Text Search Document SDK
   * ------------------------------------------------------------------------------------
   */
  $response['Document'] = $fullTextSearchDocumentSdk->Create($data['Document']);

} catch (\Exception $exception) {

  /** @var $originalException \Exception */
  /** @noinspection PhpUndefinedMethodInspection */
  $originalException = $exception->GetOriginalException();

  echo
    sprintf (
      '<b>Exception</b>: %s (%s)',
      $exception->getMessage(),
      $exception->getCode()
    ),

    '<br>',

    sprintf (
      '<b>Original Exception</b>: %s (%s)',
      $originalException->getMessage(),
      $originalException->getCode()
    ),

    '<br><br>';

} finally {

  if (isset($fullTextSearchDocumentSdk)) {
    $log = null;

    /** @noinspection PhpUndefinedMethodInspection */
    foreach ($fullTextSearchDocumentSdk->GetLog() as $logRecord) {
      print_r($logRecord);exit;
    }

    echo sprintf('<b>Log Report</b><br><br>', $log);
  }

  echo sprintf (
    'This script was executed in, <b>%s</b> sec.',
    round(microtime(true) - $_SERVER['DEMO_NOW'], 2)
  );

}
