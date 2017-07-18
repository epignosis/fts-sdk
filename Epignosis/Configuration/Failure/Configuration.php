<?php

namespace Epignosis\Configuration\Failure;

use Epignosis\Failure\EpignosisSdkTrait;

/**
 * Class Configuration
 *
 * The configuration interface exception.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Configuration\Failure
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Configuration\Failure
 * @since       1.0.0-dev
 */
class Configuration extends \Exception
{
  use EpignosisSdkTrait;
}
