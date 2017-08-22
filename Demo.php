<?php

$currentDirectory =  rtrim(__DIR__, '\/') . \DIRECTORY_SEPARATOR;

/** @noinspection PhpIncludeInspection */
require $currentDirectory . 'Demo' . \DIRECTORY_SEPARATOR . 'Data.php';
/** @noinspection PhpIncludeInspection */
require $currentDirectory . 'FullTextSearch.php';

function PrintHeader($line, $newLineBefore = false, $newLineAfter = false)
{
  echo $line;
}

function PrintObjectReadable($data)
{
  echo sprintf('<pre>%s</pre>', print_r($data, true));
}

try {
  $fullTextSearch = new FullTextSearch;

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
