<?php

namespace Demo\Helper;

/**
 * Class Printer
 *
 * The printer helper.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Demo\Helper
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Demo\Helper
 * @since       1.0.0-dev
 */
class Printer
{
  /**
   * Prints the requested exception.
   *
   * @param   \Exception $exception
   *            - The exception to be printed. (Required)
   *
   * @since   1.0.0-dev
   */
  public static function PrintError(\Exception $exception)
  {
    $originalException = $exception->GetOriginalException();

    echo
      sprintf (
        '<b>Exception</b><br>&ensp;%s (%s)<br><br>',
        $exception->getMessage(),
        $exception->getCode()
      ),
      sprintf (
        '<b>Original Exception</b><br>&ensp;%s (%s)<br><br>',
        $originalException->getMessage(),
        $originalException->getCode()
      ),
      sprintf (
        '<b>Additional Exception Information</b><br>%s<br>',
        print_r($originalException->GetAdditionalFailureInformation(), true)
      );
  }

  /**
   * Prints the requested response content.
   *
   * @param   callable $callable
   *            - The callable to be printed. (Required)
   *
   * @since   1.0.0-dev
   */
  public static function PrintResponse($callable)
  {
    $callable();

    echo
      '<hr>',

      sprintf (
        'This script was executed in, <b>%s</b> sec.',
        round(microtime(true) - $_SERVER['DEMO_NOW'], 2)
      );
  }
}
