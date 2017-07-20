<?php

/**
 * Full-Text Search SDK Demonstration
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
 * Check Script Requirements
 * --------------------------------------------------------------------------------------
 */
if (0 > version_compare(phpversion(), $configuration['Requirement']['PHP']['Version'])) {

  exit(2);
}

if (false !== stripos(php_sapi_name(), 'cli', 0) || isset($_SERVER['argv'])) {


  exit(3);
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
 * SDK Configuration Initialization
 * --------------------------------------------------------------------------------------
 */
$configuration = [
  'FullTextSearch' => [
    'Document' => []
  ]
];

/**
 * Full-Text Search Document SDK Demonstration
 * --------------------------------------------------------------------------------------
 */
try {
  $fullTextSearchDocumentSdk = new Document($configuration['FullTextSearch']['Document']);
} catch (\Exception $exception) {

}

/**
 * Full-Text Search Document SDK Result Presentation
 * --------------------------------------------------------------------------------------
 */
echo sprintf (
  'This script was executed in, <b>%s</b> sec.',
  round(microtime(true) - $_SERVER['DEMO_NOW'], 2)
);
