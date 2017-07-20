<?php

namespace Epignosis\Decoder\Failure;

use Epignosis\Failure\EpignosisSdkTrait;

/**
 * Class Decoder
 *
 * The decoder base exception.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Decoder\Failure
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Decoder\Failure
 * @since       1.0.0-dev
 */
class Decoder extends \Exception
{
  use EpignosisSdkTrait;
}
