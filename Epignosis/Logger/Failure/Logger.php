<?php

namespace Epignosis\Logger\Failure;

use Epignosis\Failure\EpignosisSdkTrait;

/**
 * Class Logger
 *
 * The logger interface exception.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Logger\Failure
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Logger\Failure
 * @since       1.0.0-dev
 */
class Logger extends \Exception
{
  use EpignosisSdkTrait;
}
