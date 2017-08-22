<?php

require 'Demo' . \DIRECTORY_SEPARATOR . 'Data.php';
require 'FullTextSearch.php';
require 'Configuration.php';

function Get()
{
  if (false !== stripos(php_sapi_name(), 'cli', 0)) {
    $argumentList = [];

    foreach (array_slice($_SERVER['argv'], 1, $_SERVER['argc']) as $argument) {
      $argument = explode('=', $argument);
      $argumentList[ltrim(trim($argument[0]), '-')] = trim($argument[1]);
    }

    return $argumentList;
  }

  return $_GET;
}

function PrintHeader($header, $newLineBefore = false, $newLineAfter = false)
{
  if (false !== stripos(php_sapi_name(), 'cli', 0)) {
    echo sprintf (
      '%s%s%s',
      $newLineBefore ? "\n" : null,
      $header,
      $newLineAfter ? "\n" : null
    );
  } else {
    echo sprintf (
      '%s<b>%s</b>%s',
      $newLineBefore ? '<br>' : null,
      $header,
      $newLineAfter ? '<br>' : null
    );
  }
}

function PrintLine($line, $newLineBefore = false, $newLineAfter = false)
{
  if (false !== stripos(php_sapi_name(), 'cli', 0)) {
    echo sprintf (
      '%s%s%s',
      $newLineBefore ? "\n" : null,
      $line,
      $newLineAfter ? "\n" : null
    );
  } else {
    echo sprintf (
      '%s%s%s',
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

  PrintHeader('FullTextSearch SDK Version: ');
  PrintLine($fullTextSearch->GetSdkVersionFull(), true, true);

  PrintHeader('FullTextSearch SDK Configuration: ', true);
  PrintObjectReadable($fullTextSearch->GetConfiguration());

  $getList = Get();
  $multiplicity = $getList['Multiplicity'] ? 'Multiple' : 'Single';

  if (!isset($data[$getList['Entity']][$getList['Action']][$multiplicity])) {
    throw new \Exception('Nothing to execute according the requested entity / action.');
  }

  PrintHeader (
    sprintf('Execute %s %s (%s)', $getList['Entity'], $getList['Action'], $multiplicity),
    false,
    true
  );

  /** @noinspection PhpUndefinedVariableInspection */
  $methodData = $data[$getList['Entity']][$getList['Action']][$multiplicity];
  $method = sprintf('%s%s', $getList['Entity'], $getList['Action']);

  PrintLine('Requested Data');
  PrintObjectReadable($methodData);
} catch (\Exception $exception) {
  PrintHeader('System Exception', true, false);
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
