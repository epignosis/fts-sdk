<?php

namespace Epignosis\Auth\Failure;

use Epignosis\Failure\EpignosisSdkTrait;

/**
 * Class Auth
 *
 * The auth base exception.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Auth\Failure
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Auth\Failure
 * @since       1.0.0-dev
 */
class Auth extends \Exception
{
  use EpignosisSdkTrait;
}
