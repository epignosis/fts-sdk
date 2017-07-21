<?php

namespace Epignosis\Auth\Abstraction;

/**
 * Interface AuthInterface
 *
 * The auth interface.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Auth\Abstraction
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Auth\Abstraction
 * @since       1.0.0-dev
 */
trait AuthTrait
{
  /**
   * The auth configuration.
   *
   * @default []
   * @since   1.0.0-dev
   * @var     array
   */
  private $_authConfiguration = [];

  /**
   * AuthTrait constructor.
   *
   * @param   array $authConfiguration
   *            - The auth configuration to be used. (Required)
   *
   * @since   1.0.0-dev
   */
  public function __construct($authConfiguration = [])
  {
    $this->_authConfiguration = (array) $authConfiguration;
  }
}
