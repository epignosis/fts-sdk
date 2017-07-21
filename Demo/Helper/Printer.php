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
    /** @var $originalException \Exception */
    /** @noinspection PhpUndefinedMethodInspection */
    $originalException = $exception->GetOriginalException();

    echo
    sprintf (
      '<b>Exception</b>: %s (%s)',
      $exception->getMessage(),
      $exception->getCode()
    ),

    '<br>',

    sprintf (
      '<b>Original Exception</b>: %s (%s)',
      $originalException->getMessage(),
      $originalException->getCode()
    ),

    '<br><br>';
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

    echo sprintf (
      'This script was executed in, <b>%s</b> sec.',
      round(microtime(true) - $_SERVER['DEMO_NOW'], 2)
    );
  }
}
