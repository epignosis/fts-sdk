<?php

require 'Demo' . \DIRECTORY_SEPARATOR . 'Data.php';
require 'FullTextSearch.php';
require 'Configuration.php';

function PrintHeader($line, $newLineBefore = false, $newLineAfter = false)
{
  $newLine = false !== stripos(php_sapi_name(), 'cli', 0) ? "\n" : '<br>';

  echo sprintf (
    '%s%s%s',
    $newLineBefore ? $newLine : null,
    $line,
    $newLineAfter ? $newLine : null
  );
}

function PrintObjectReadable($data)
{
  if (false !== stripos(php_sapi_name(), 'cli', 0)) {
    print_r($data);
  } else {
    echo sprintf('<pre>%s</pre>', print_r($data, true));
  }
}

try {

  /** @noinspection PhpUndefinedVariableInspection */
  $fullTextSearch = new FullTextSearch($configuration);

  // Print FullTextSearch Full SDK Version:
  PrintHeader (
    sprintf('FullTextSearch SDK Version: %s', $fullTextSearch->GetSdkVersionFull())
  );
} catch (\Exception $exception) {
  PrintHeader('System Exception');
  PrintObjectReadable($exception);

  if ($fullTextSearch instanceof FullTextSearch) {
    PrintHeader('FullTextSearch SDK Error');
    PrintObjectReadable($fullTextSearch->GetError());
  }

  exit(1);
}

exit(0);
