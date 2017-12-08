<?php

use Epignosis\Sdk\FullTextSearch;

$now = microtime(true);

/**
 * Returns the requested argument (CLI), or the parameter (HTTP/GET) list.
 *
 * @return  array
 *
 * @since   2.0.0-dev
 */
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

/**
 * Prints on the screen, the requested header.
 *
 * @param   string $header
 *            - The header to be printed. (Required)
 *
 * @param   bool $newLineBefore
 *            - Whether to print a new line before the header, or not. (Optional, false)
 *
 * @param   bool $newLineAfter
 *            - Whether to print a new line after the header, or not. (Optional, false)
 *
 * @since   2.0.0-dev
 */
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

/**
 * Prints on the screen, the requested text line.
 *
 * @param   string $textLine
 *            - The header to be printed. (Required)
 *
 * @param   bool $newLineBefore
 *            - Whether to print a new line before the text line, or not.
 *              (Optional, false)
 *
 * @param   bool $newLineAfter
 *            - Whether to print a new line after the text line, or not. (Optional, false)
 *
 * @since   2.0.0-dev
 */
function PrintLine($textLine, $newLineBefore = false, $newLineAfter = false)
{
  if (false !== stripos(php_sapi_name(), 'cli', 0)) {
    echo sprintf (
      '%s%s%s',
      $newLineBefore ? "\n" : null,
      strip_tags($textLine),
      $newLineAfter ? "\n" : null
    );
  } else {
    echo sprintf (
      '%s%s%s',
      $newLineBefore ? '<br>' : null,
      $textLine,
      $newLineAfter ? '<br>' : null
    );
  }
}

/**
 * Prints on the screen, the requested data structure.
 *
 * @param   mixed $dataStructure
 *            - The data structure to be printed. (Required)
 *
 * @since   2.0.0-dev
 */
function PrintObjectReadable($dataStructure)
{
  if (false !== stripos(php_sapi_name(), 'cli', 0)) {
    print_r($dataStructure);
  } else {
    echo sprintf('<pre>%s</pre>', print_r($dataStructure, true));
  }
}

try {

  require 'Demo' . \DIRECTORY_SEPARATOR . 'Data.php';
  require 'Configuration.php';

  require
    'Epignosis' . \DIRECTORY_SEPARATOR .
    'Sdk' . \ DIRECTORY_SEPARATOR .
    'FullTextSearch.php';

  $fullTextSearchSdk = new FullTextSearch($configuration);
  $getList = Get();
  $multiplicity = $getList['Multiplicity'] ? 'Multiple' : 'Single';

  PrintHeader (
    sprintf('Execute %s %s (%s)', $getList['Entity'], $getList['Action'], $multiplicity),
    false,
    true
  );

  /** @noinspection PhpUndefinedVariableInspection */
  $methodData = $data[$getList['Entity']][$getList['Action']][$multiplicity];

  PrintLine('Requested Data');
  PrintObjectReadable($methodData);

  if ($getList['Multiplicity']) {
    $responseData = [
      'Demo' => [],
      'Server' => $fullTextSearchSdk->Execute (
        $getList['Entity'], $getList['Action'], (array) $methodData
      )
    ];
  } else {
    $responseData = [];

    foreach ($methodData as $methodDatum) {
      $thisNow = microtime(true);
      $serverResponse = $fullTextSearchSdk->Execute (
        $getList['Entity'], $getList['Action'], (array) $methodDatum
      );

      $responseData[] = [
        'Demo' => [
          'Executed' => sprintf('<b>%s</b> sec.', round(microtime(true) - $thisNow, 3))
        ],
        'Server' => $serverResponse
      ];
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
