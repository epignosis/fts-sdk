<?php

require 'Demo' . \DIRECTORY_SEPARATOR . 'Data.php';
require 'FullTextSearch.php';
require 'Configuration.php';

function PrintHeader($line, $newLineBefore = false, $newLineAfter = false)
{
  if (stripos(php_sapi_name(), 'cli', 0)) {
    echo sprintf (
      '%s%s%s',
      $newLineBefore ? "\n" : null,
      $line,
      $newLineAfter ? "\n" : null
    );
  } else {
    echo sprintf (
      '%s<b>%s</b><hr>%s',
      $newLineBefore ? '<br>' : null,
      $line,
      $newLineAfter ? '<br>' : null
    );
  }
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
    sprintf('FullTextSearch SDK Version: %s', $fullTextSearch->GetSdkVersionFull()),
    false,
    true
  );

  $multiplicity = $_GET['Multiplicity'] ? 'Multiple' : 'Single';

  if (!isset($data[$_GET['Entity']][$_GET['Action']][$multiplicity])) {
    throw new \Exception('Nothing to execute according the requested entity / action.');
  }
} catch (\Exception $exception) {
  PrintHeader('System Exception');
  PrintObjectReadable($exception);

  if ($fullTextSearch instanceof FullTextSearch) {
    $fullTextSearchError = $fullTextSearch->GetError();

    if (!empty($fullTextSearchError)) {
      PrintHeader('FullTextSearch SDK Error');
      PrintObjectReadable($fullTextSearchError);
    }
  }

  exit(1);
}

exit(0);
