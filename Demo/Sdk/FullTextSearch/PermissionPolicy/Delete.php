<?php

namespace Demo\Sdk\FullTextSearch\PermissionPolicy;

use Demo\Helper\Printer;
use Epignosis\Sdk\FullTextSearch\PermissionPolicy;

require
  rtrim(dirname(dirname(dirname(__DIR__))), \DIRECTORY_SEPARATOR) . \DIRECTORY_SEPARATOR .
  'Helper' . \DIRECTORY_SEPARATOR .
  'Bootstrap.php';

require
  rtrim(dirname(dirname(dirname(__DIR__))), \DIRECTORY_SEPARATOR) . \DIRECTORY_SEPARATOR .
  'Data' . \DIRECTORY_SEPARATOR .
  'PermissionPolicy' . \DIRECTORY_SEPARATOR .
  'Delete.php';

try {

  $responseList = [];
  $fullTextSearchPermissionPolicySdk = new PermissionPolicy($configuration);

  foreach ($data as $permissionPolicy) {
    $responseList[] = $fullTextSearchPermissionPolicySdk->Delete($permissionPolicy);
  }

} catch (\Exception $exception) {

  Printer::PrintError($exception);

} finally {

  Printer::PrintResponse (function() use ($responseList, $data) {
    foreach ($responseList as $keyIndex => $thisResponse) {
      echo
        sprintf (
          '<b>Delete Permission Policy #%s (Requested Data)</b><pre>%s</pre>',
          $keyIndex + 1,
          print_r($data[$keyIndex], true)
        ),

        sprintf (
          '<b>Delete Permission Policy #%s (Response)</b><pre>%s</pre>',
          $keyIndex + 1,
          print_r($thisResponse, true)
        );
    }
  });

}
