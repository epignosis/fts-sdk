<?php

namespace Demo\Document;

use Demo\Helper\Printer;
use Epignosis\Sdk\FullTextSearch\Document;

/** @noinspection PhpIncludeInspection */
/** @noinspection PhpUndefinedVariableInspection */
require
  rtrim(dirname(__DIR__), \DIRECTORY_SEPARATOR) . \DIRECTORY_SEPARATOR .
  'Helper' . \DIRECTORY_SEPARATOR .
  'Bootstrap.php';

/** @noinspection PhpIncludeInspection */
require
  rtrim(dirname(__DIR__), \DIRECTORY_SEPARATOR) . \DIRECTORY_SEPARATOR .
  'Data' . \DIRECTORY_SEPARATOR .
  'Document' . \DIRECTORY_SEPARATOR .
  'Create.php';

try {
  $responseList = [];
  /** @noinspection PhpUndefinedVariableInspection */
  $fullTextSearchDocumentSdk = new Document($configuration);

  /** @noinspection PhpUndefinedVariableInspection */
  foreach ($data as $document) {
    $responseList[] = $fullTextSearchDocumentSdk->Create($document);
  }

} catch (\Exception $exception) {

  Printer::PrintError($exception);

} finally {

  Printer::PrintResponse (function() use ($responseList, $data) {
    foreach ($responseList as $key => $response) {
      echo
        sprintf (
          '<b>Create Document #%s</b><pre>%s</pre>',
          $key + 1,
          print_r($data[$key], true)
        ),

        sprintf (
          '<b>Document Creation Response #%s</b><pre>%s</pre>',
          $key + 1,
          print_r($response, true)
        );
    }
  });

}
