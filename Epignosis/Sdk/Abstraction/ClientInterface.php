<?php

namespace Epignosis\Sdk\Abstraction;

/**
 * Interface ClientInterface
 *
 * The client interface.
 *
 * @application Epignosis SDK
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Sdk\Abstraction
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Sdk\Abstraction
 * @since       1.0.0-dev
 */
interface ClientInterface
{
  public function Delete($url, array $data = [], array $optionList = []);
  public function Get($url, array $data = [], array $optionList = []);
  public function Post($url, array $data = [], array $optionList = []);
  public function Put($url, array $data = [], array $optionList = []);
}
