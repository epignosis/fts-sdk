<?php

use Epignosis\Sdk\FullTextSearch;

$now = microtime(true);

require
  'Demo' . \DIRECTORY_SEPARATOR . 'Data.php';
require
  'Configuration.php';
require
  'Epignosis' . \DIRECTORY_SEPARATOR .
  'Sdk' . \ DIRECTORY_SEPARATOR .
  'FullTextSearch.php';

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
      strip_tags($header),
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
      strip_tags($line),
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

  $fullTextSearchSdk = new FullTextSearch($configuration);
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

  $methodData = $data[$getList['Entity']][$getList['Action']][$multiplicity];
  $method = sprintf('%s%s', $getList['Entity'], $getList['Action']);

  PrintLine('Requested Data');
  PrintObjectReadable($methodData);

  if ($getList['Multiplicity']) {
    $responseData = $fullTextSearchSdk->$method($methodData);
  } else {
    $responseData = [];

    foreach ($methodData as $methodDatum) {
      $responseData[] = $fullTextSearchSdk->$method($methodDatum);
    }
  }

  PrintLine('Response Data');
  PrintObjectReadable($responseData);

} catch (\Exception $exception) {

  PrintHeader('SDK Exception');
  PrintObjectReadable($exception);

}

PrintLine('<hr>');
PrintLine(sprintf('Executed in <b>%s</b> sec.', round(microtime(true) - $now, 3)));
