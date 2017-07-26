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
  $responseList['Multiple'] = $fullTextSearchDocumentSdk->Create (
    $data['Multiple'], true
  );

  foreach ($data['Single'] as $document) {
    $responseList['Single'][] = $fullTextSearchDocumentSdk->Create($document, false);
  }

} catch (\Exception $exception) {

  Printer::PrintError($exception);

} finally {

  Printer::PrintResponse (function() use ($responseList, $data) {
    foreach ($responseList as $key => $response) {
      if ('Multiple' == $key) {
        echo
          sprintf (
            '<b>Create Multiple Documents (Requested Data)</b><pre>%s</pre>',
            print_r($data['Multiple'], true)
          ),

          sprintf (
            '<b>Multiple Documents Creation (Response)</b><pre>%s</pre>',
            print_r($response, true)
          );
      } else {
        echo
          sprintf (
            '<b>Create Single Document (Requested Data)</b><pre>%s</pre>',
            print_r($data['Single'], true)
          ),

          sprintf (
            '<b>Single Document Creation (Response)</b><pre>%s</pre>',
            print_r($response, true)
          );
      }
    }
  });

}
