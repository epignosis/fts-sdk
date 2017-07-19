<?php

namespace Epignosis\Factory\Failure;

use Epignosis\Failure\EpignosisSdkTrait;

/**
 * Class Factory
 *
 * The factory exception.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Factory\Failure
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Factory\Failure
 * @since       1.0.0-dev
 */
class Factory extends \Exception
{
  use EpignosisSdkTrait;
}
