<?php

namespace Epignosis\Clients\Failure;

use Epignosis\Failure\EpignosisSdkTrait;

/**
 * Class Client
 *
 * The client interface exception.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Clients\Failure
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Clients\Failure
 * @since       1.0.0-dev
 */
class Client extends \Exception
{
  use EpignosisSdkTrait;
}
