<?php

namespace Epignosis\Auth;

use Epignosis\Auth\Abstraction\AuthInterface;
use Epignosis\Auth\Abstraction\AuthTrait;
use Epignosis\Auth\Failure\Signature as SignatureException;

/**
 * Class Signature
 *
 * The signature auth.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Auth
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Auth
 * @since       1.0.0-dev
 */
class Signature implements AuthInterface
{
  use AuthTrait;


  /**
   * Checks the availability of the requested function name.
   *
   * @param   string $functionName
   *            - The function name to be checked. (Required)
   *
   * @return  Signature
   *
   * @since   1.0.0-dev
   *
   * @throws  SignatureException
   *            - In case that the requested function name is not available.
   */
  private function _CheckFunctionAvailability($functionName)
  {
    if (!function_exists($functionName)) {
      throw new SignatureException (
        SignatureException::AUTH_ADAPTER_SIGNATURE_FUNCTION_NOT_EXIST,
        null,
        ['Function' => $functionName]
      );
    }

    return $this;
  }

  /**
   * Encodes the requested integer from 8-bit to 6-bit.
   *
   * @param   int $integer
   *            - The integer to be encoded. (Required)
   *
   * @return  string
   *
   * @since   1.0.0-dev
   */
  private function _Encode6Bits($integer)
  {
    $diff = 0x41;
    $diff += ((25 - $integer) >> 8) & 6;
    $diff -= ((51 - $integer) >> 8) & 75;
    $diff -= ((61 - $integer) >> 8) & 15;
    $diff += ((62 - $integer) >> 8) & 3;

    return pack('C', $integer + $diff);
  }

  /**
   * Encodes the requested source into Base64.
   *
   * @param   string $source
   *            - The source to be Base64 encoded. (Required)
   *
   * @return  string
   *
   * @since   1.0.0-dev
   */
  private function _EncodeBase64($source)
  {
    $destination = null;
    $sourceLength = mb_strlen($source, '8bit');

    for ($i = 0; $i + 3 <= $sourceLength; $i += 3) {
      $chunk = unpack('C*', mb_substr($source, $i, 3, '8bit'));

      $b0 = $chunk[1];
      $b1 = $chunk[2];
      $b2 = $chunk[3];

      $destination .=
        $this->_Encode6Bits($b0 >> 2) .
        $this->_Encode6Bits((($b0 << 4) | ($b1 >> 4)) & 63) .
        $this->_Encode6Bits((($b1 << 2) | ($b2 >> 6)) & 63) .
        $this->_Encode6Bits($b2 & 63);
    }

    if ($i < $sourceLength) {
      $chunk = unpack('C*', mb_substr($source, $i, $sourceLength - $i, '8bit'));
      $b0 = $chunk[1];

      if ($i + 1 < $sourceLength) {
        $b1 = $chunk[2];

        $destination .=
          $this->_Encode6Bits($b0 >> 2) .
          $this->_Encode6Bits((($b0 << 4) | ($b1 >> 4)) & 63) .
          $this->_Encode6Bits(($b1 << 2) & 63) .
          '=';
      } else {
        $destination .=
          $this->_Encode6Bits( $b0 >> 2) .
          $this->_Encode6Bits(($b0 << 4) & 63) .
          '==';
      }
    }

    return $destination;
  }

  /**
   * Sorts the requested data, and returns the result.
   *
   * @param   array $data
   *            - The data to be sorted. (Required)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   */
  private function _GetSortedData(array $data)
  {
    ksort($data);

    foreach ($data as $k => $v) {
      if (is_array($v)) {
        $data[$k] = $this->_GetSortedData($v);
      }
    }

    return $data;
  }

  /**
   * Signs the request.
   *
   * @param   array $authInformation
   *            - The auth information to be used. (Required)
   *
   * @param   string $operationType
   *            - The operation type to be used. (Required)
   *
   * @param   array $data
   *            - The data to be signed. (Required)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  SignatureException
   *            - In case that is not possible to sign the request.
   */
  public function GetSignedRequest(array $authInformation, $operationType, array $data)
  {
    $this
      ->_CheckFunctionAvailability('mb_strlen')
      ->_CheckFunctionAvailability('mb_substr')
      ->_CheckFunctionAvailability('openssl_encrypt')
      ->_CheckFunctionAvailability('openssl_random_pseudo_bytes');

    $data = $this->_GetSortedData($data);

    $iv = null;
    $secure = false;

    while (!$secure) {
      $iv = openssl_random_pseudo_bytes(16, $secure);
    }

    $cipherText = openssl_encrypt (
      $data,
      $this->_authConfiguration['CryptoAlgorithm'],
      $authInformation['Key']['Encryption'][$operationType],
      \OPENSSL_RAW_DATA,
      $iv
    );

    $hashMac = hash_hmac (
      $this->_authConfiguration['HashAlgorithm'],
      $cipherText,
      $authInformation['Key']['Private'][$operationType],
      true
    );

    return [
      $this->_authConfiguration['SignatureName'],
      $this->_EncodeBase64($hashMac . $iv . $cipherText)
    ];
  }
}
