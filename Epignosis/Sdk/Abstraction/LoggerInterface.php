<?php

namespace Epignosis\Sdk\Abstraction;

/**
 * Interface LoggerInterface
 *
 * The logger interface.
 *
 * @application Epignosis SDK
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Sdk\Abstraction
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Sdk\Abstraction
 * @since       1.0.0-dev
 */
interface LoggerInterface
{

  public function ClearLog();
  public function GetLog();
  public function Log($success = true, array $data = [], $sensitive = false);
}
