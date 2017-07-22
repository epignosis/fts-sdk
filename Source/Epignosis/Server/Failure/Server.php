<?php

namespace Epignosis\Server\Failure;

use Epignosis\Failure\EpignosisSdkTrait;

/**
 * Class Server
 *
 * The server base exception.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Server\Failure
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Server\Failure
 * @since       1.0.0-dev
 */
class Server extends \Exception
{
  use EpignosisSdkTrait;
}
