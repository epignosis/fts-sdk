<?php

namespace Epignosis\Auth;

use Epignosis\Auth\Abstraction\AuthInterface;
use Epignosis\Auth\Abstraction\AuthTrait;
use Epignosis\Auth\Failure\SignatureToken as SignatureTokenException;

/**
 * Class SignatureToken
 *
 * The signature-token auth.
 *
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Auth
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Auth
 * @since       1.0.0-dev
 */
class SignatureToken implements AuthInterface
{
  use AuthTrait;


  /**
   * Checks the availability of the requested function name.
   *
   * @param   string $functionName
   *            - The function name to be checked. (Required)
   *
   * @return  SignatureToken
   *
   * @since   1.0.0-dev
   *
   * @throws  SignatureTokenException
   *            - In case that the requested function name is not available.
   */
  private function _CheckFunctionAvailability($functionName)
  {
    if (!function_exists($functionName)) {
      throw new SignatureTokenException (
        SignatureTokenException::AUTH_ADAPTER_SIGNATURE_TOKEN_FUNCTION_NOT_EXIST,
        null,
        ['Function' => 'openssl_encrypt']
      );
    }

    return $this;
  }




  private function _SafeStringLength($str)
  {
    if (\function_exists('mb_strlen')) {
      return \mb_strlen($str, '8bit');
    } else {
      return \strlen($str);
    }
  }

  private function _SafeSubstring($str, $start = 0, $length = null) {
    if ($length === 0) {
      return '';
    }
    if (\function_exists('mb_substr')) {
      return \mb_substr($str, $start, $length, '8bit');
    }
    // Unlike mb_substr(), substr() doesn't accept NULL for length
    if ($length !== null) {
      return \substr($str, $start, $length);
    } else {
      return \substr($str, $start);
    }
  }

  private function _EncodeBase64($src)
  {
    $dest = '';
    $srcLen = $this->_SafeStringLength($src);
    // Main loop (no padding):
    for ($i = 0; $i + 3 <= $srcLen; $i += 3) {
      $chunk = \unpack('C*', $this->_SafeSubstring($src, $i, 3));
      $b0 = $chunk[1];
      $b1 = $chunk[2];
      $b2 = $chunk[3];
      $dest .=
        $this->_Encode6Bits(               $b0 >> 2       ) .
        $this->_Encode6Bits((($b0 << 4) | ($b1 >> 4)) & 63) .
        $this->_Encode6Bits((($b1 << 2) | ($b2 >> 6)) & 63) .
        $this->_Encode6Bits(  $b2                     & 63);
    }
    // The last chunk, which may have padding:
    if ($i < $srcLen) {
      $chunk = \unpack('C*', $this->_SafeSubstring($src, $i, $srcLen - $i));
      $b0 = $chunk[1];
      if ($i + 1 < $srcLen) {
        $b1 = $chunk[2];
        $dest .=
          $this->_Encode6Bits(               $b0 >> 2       ) .
          $this->_Encode6Bits((($b0 << 4) | ($b1 >> 4)) & 63) .
          $this->_Encode6Bits( ($b1 << 2)               & 63) . '=';
      } else {
        $dest .=
          $this->_Encode6Bits( $b0 >> 2) .
          $this->_Encode6Bits(($b0 << 4) & 63) . '==';
      }
    }
    return $dest;
  }

  /**
   * Uses bitwise operators instead of table-lookups to turn 8-bit integers
   * into 6-bit integers.
   *
   * @param int $src
   * @return string
   */
  private function _Encode6Bits($src)
  {
    $diff = 0x41;
    // if ($src > 25) $diff += 0x61 - 0x41 - 26; // 6
    $diff += ((25 - $src) >> 8) & 6;
    // if ($src > 51) $diff += 0x30 - 0x61 - 26; // -75
    $diff -= ((51 - $src) >> 8) & 75;
    // if ($src > 61) $diff += 0x2b - 0x30 - 10; // -15
    $diff -= ((61 - $src) >> 8) & 15;
    // if ($src > 62) $diff += 0x2f - 0x2b - 1; // 3
    $diff += ((62 - $src) >> 8) & 3;
    return \pack('C', $src + $diff);
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
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  SignatureTokenException
   *            - In case that is not possible to sign the request.
   */
  public function GetSignedRequest(array $authInformation, $operationType)
  {
    $this->_CheckFunctionAvailability('openssl_encrypt');
    $this->_CheckFunctionAvailability('openssl_random_pseudo_bytes');

    $dataToSign = $iv = null;
    $secure = false;

    while (!$secure) {
      $iv = openssl_random_pseudo_bytes(16, $secure);
    }

    $cipherText = $this->_Encode6Bits (
      openssl_encrypt (
        $dataToSign,
        $this->_authConfiguration['CryptoAlgorithm'],
        $authInformation['Key']['Encryption'][$operationType],
        \OPENSSL_RAW_DATA,
        $iv
      )
    );

    $hashMac = $this->_EncodeBase64 (
      hash_hmac (
        $this->_authConfiguration['HashAlgorithm'],
        $cipherText,
        $authInformation['Key']['Private'][$operationType],
        true
      )
    );

    return [
      $this->_authConfiguration['SignatureName'],
      sprintf('%s;%s;%s', $cipherText, $iv, $hashMac)
    ];
  }
}
