<?php

namespace Epignosis\Factory\Abstraction;

/**
 * Interface FactoryInterface
 *
 * The factory interface.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Factory\Abstraction
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Factory\Abstraction
 * @since       1.0.0-dev
 */
interface FactoryInterface
{
  public function Get($entity, array $configuration = []);
  public function GetCached($entity, array $configuration = []);
  public function GetCachedDefault(array $configuration = []);
  public function GetDefault(array $configuration = []);
}
