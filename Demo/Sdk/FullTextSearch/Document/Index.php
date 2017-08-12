<?php

namespace Demo\Sdk\FullTextSearch\Document;

use Demo\Helper\Printer;
use Epignosis\Sdk\FullTextSearch\Document;

require
  rtrim(dirname(dirname(dirname(__DIR__))), \DIRECTORY_SEPARATOR) . \DIRECTORY_SEPARATOR .
  'Helper' . \DIRECTORY_SEPARATOR .
  'Bootstrap.php';

require
  rtrim(dirname(dirname(dirname(__DIR__))), \DIRECTORY_SEPARATOR) . \DIRECTORY_SEPARATOR .
  'Data' . \DIRECTORY_SEPARATOR .
  'Document' . \DIRECTORY_SEPARATOR .
  'Index.php';

try {

  $responseList = [];
  $fullTextSearchDocumentSdk = new Document($configuration);

  $responseList['Multiple'] = $fullTextSearchDocumentSdk->Index (
    $data['Multiple'], true
  );

  foreach ($data['Single'] as $document) {
    $responseList['Single'][] = $fullTextSearchDocumentSdk->Index($document, false);
  }

} catch (\Exception $exception) {

  Printer::PrintError($exception);

} finally {

  Printer::PrintResponse (function() use ($responseList, $data) {
    foreach ($responseList as $keyType => $response) {
      if ('Multiple' == $keyType) {
        echo
          sprintf (
            '<b>Index Multiple Documents (Requested Data)</b><pre>%s</pre>',
            print_r($data['Multiple'], true)
          ),

          sprintf (
            '<b>Index Multiple Documents (Response)</b><pre>%s</pre>',
            print_r($response, true)
          );
      } else {
        foreach ($response as $keyIndex => $thisResponse) {
          echo
            sprintf (
              '<b>Index Single Document #%s (Requested Data)</b><pre>%s</pre>',
              $keyIndex + 1,
              print_r($data['Single'][$keyIndex], true)
            ),

            sprintf (
              '<b>Index Single Document #%s (Response)</b><pre>%s</pre>',
              $keyIndex + 1,
              print_r($thisResponse, true)
            );
        }
      }
    }
  });

}
