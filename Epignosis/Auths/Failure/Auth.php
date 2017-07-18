<?php

namespace Epignosis\Auths\Failure;

use Epignosis\Failure\EpignosisSdkTrait;

/**
 * Class Auth
 *
 * The auth interface exception.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Auths\Failure
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Auths\Failure
 * @since       1.0.0-dev
 */
class Auth extends \Exception
{
  use EpignosisSdkTrait;
}
