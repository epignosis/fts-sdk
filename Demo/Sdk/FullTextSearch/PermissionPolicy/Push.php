<?php

namespace Demo\Sdk\FullTextSearch\PermissionPolicy;

use Demo\Helper\Printer;
use Epignosis\Sdk\FullTextSearch\PermissionPolicy;

/** @noinspection PhpIncludeInspection */
/** @noinspection PhpUndefinedVariableInspection */
require
  rtrim(dirname(dirname(dirname(__DIR__))), \DIRECTORY_SEPARATOR) . \DIRECTORY_SEPARATOR .
  'Helper' . \DIRECTORY_SEPARATOR .
  'Bootstrap.php';

/** @noinspection PhpIncludeInspection */
require
  rtrim(dirname(dirname(dirname(__DIR__))), \DIRECTORY_SEPARATOR) . \DIRECTORY_SEPARATOR .
  'Data' . \DIRECTORY_SEPARATOR .
  'PermissionPolicy' . \DIRECTORY_SEPARATOR .
  'Push.php';

try {

  $responseList = [];

  /** @noinspection PhpUndefinedVariableInspection */
  $fullTextSearchPermissionPolicySdk = new PermissionPolicy($configuration);

  /** @noinspection PhpUndefinedVariableInspection */
  foreach ($data as $permissionPolicy) {
    $responseList[] = $fullTextSearchPermissionPolicySdk->Push($permissionPolicy);
  }

} catch (\Exception $exception) {

  Printer::PrintError($exception);

} finally {

  Printer::PrintResponse (function() use ($responseList, $data) {
    foreach ($responseList as $keyIndex => $response) {
      echo
        sprintf (
          '<b>Push Permission Policy #%s (Requested Data)</b><pre>%s</pre>',
          $keyIndex + 1,
          print_r($data[$keyIndex], true)
        ),

        sprintf (
          '<b>Push Permission Policy #%s (Response)</b><pre>%s</pre>',
          $keyIndex + 1,
          print_r($thisResponse, true)
        );
    }
  });

}
