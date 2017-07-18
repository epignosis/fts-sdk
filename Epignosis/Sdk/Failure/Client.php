<?php

namespace Epignosis\Sdk\Failure;

/**
 * Class Client
 *
 * The client interface exception.
 *
 * @application Epignosis SDK
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Sdk\Failure
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Sdk\Failure
 * @since       1.0.0-dev
 */
class Client extends \Exception
{
  use EpignosisSdkTrait;
}
