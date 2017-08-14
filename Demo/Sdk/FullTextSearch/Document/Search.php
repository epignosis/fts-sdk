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
  'Search.php';

try {

  $responseList = [];
  $fullTextSearchDocumentSdk = new Document($configuration);

  foreach ($data as $search) {
    $responseList[] = $fullTextSearchDocumentSdk->Search($search);
  }

} catch (\Exception $exception) {

  Printer::PrintError($exception);

} finally {

  Printer::PrintResponse (function() use ($responseList, $data) {
    foreach ($responseList as $keyIndex => $thisResponse) {
      echo
      sprintf (
        '<b>Search Documents #%s (Requested Data)</b><pre>%s</pre>',
        $keyIndex + 1,
        print_r($data[$keyIndex], true)
      ),

      sprintf (
        '<b>Search Documents #%s (Response)</b><pre>%s</pre>',
        $keyIndex + 1,
        print_r($thisResponse, true)
      );
    }
  });

}
