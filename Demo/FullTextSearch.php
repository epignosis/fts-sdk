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

(new AutoLoader(true))->SetNamespaceList(['Epignosis' => $epignosisFilePath]);

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
 * Full-Text Search Document SDK Initialization
 * --------------------------------------------------------------------------------------
 */
$fullTextSearchDocumentSdk = new Document($configuration['FullTextSearch']['Document']);

echo '<pre>'; print_r($fullTextSearchDocumentSdk); echo '</pre>';

/**
 * Presentation
 * --------------------------------------------------------------------------------------
 */
echo sprintf (
  'This script was executed in, <b>%s</b> sec.',
  round(microtime(true) - $_SERVER['DEMO_NOW'], 2)
);
