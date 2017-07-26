<?php

namespace Epignosis\Auth;

use Epignosis\Auth\Abstraction\AuthInterface;
use Epignosis\Auth\Failure\Signature as AuthSignatureException;
use Epignosis\Server\Abstraction\RequestInterface;

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
  /**
   * The auth configuration.
   *
   * @default []
   * @since   1.0.0-dev
   * @var     array
   */
  private $_authConfiguration = [];


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
   * Encodes the requested source into Base64 (time safe).
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
   * Returns the initialization vector.
   *
   * @param   string $cryptoAlgorithm
   *            - The crypto algorithm to be used. (Required)
   *
   * @return  string
   *
   * @since   1.0.0-dev
   */
  private function _GetInitializationVector($cryptoAlgorithm)
  {
    $iv = $secure = false;
    $length = openssl_cipher_iv_length($cryptoAlgorithm);

    while (!$secure || !$iv) {
      $iv = openssl_random_pseudo_bytes($length, $secure);
    }

    return $iv;
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
   * Signature constructor.
   *
   * @param   array $authConfiguration
   *            - The auth configuration to be used. (Required)
   *
   * @since   1.0.0-dev
   *
   * @throws  AuthSignatureException
   *            - In case that the cURL PHP extension is not available.
   */
  public function __construct(array $authConfiguration)
  {
    /** @noinspection SpellCheckingInspection */
    $functionList = [
      'mb_strlen', 'mb_substr',
      'openssl_cipher_iv_length', 'openssl_encrypt', 'openssl_random_pseudo_bytes'
    ];

    foreach ($functionList as $function) {
      if (!function_exists($function)) {
        throw new AuthSignatureException (
          AuthSignatureException::AUTH_SIGNATURE_FUNCTION_NOT_AVAILABLE,
          null,
          ['Extension' => $function]
        );
      }
    }

    $this->_authConfiguration = (array) $authConfiguration;
  }

  /**
   * Authenticates the server request and returns its method type.
   *
   * @param   RequestInterface $requestInterface
   *            - The request interface. (Required)
   *
   * @return  string
   *
   * @since   1.0.0-dev
   *
   * @throws  AuthSignatureException
   *            - In case that is not possible to authenticate the server request.
   */
  public function AuthenticateServerRequest(RequestInterface $requestInterface)
  {
    return null;
  }

  /**
   * Signs the request.
   *
   * @param   array $authInformation
   *            - The auth information to be used. (Required)
   *
   * @param   array $operationInformation
   *            - The operation information to be used. (Required)
   *
   * @param   array $data
   *            - The data to be signed. (Required)
   *
   * @return  array
   *
   * @since   1.0.0-dev
   *
   * @throws  AuthSignatureException
   *            - In case that is not possible to sign the request.
   */
  public function GetSignedRequest (
    array $authInformation,
    array $operationInformation,
    array $data)
  {
    $iv = $this->_GetInitializationVector($this->_authConfiguration['CryptoAlgorithm']);

    // @todo
    $cipherText = openssl_encrypt (
      serialize($this->_GetSortedData($data)),
      $this->_authConfiguration['CryptoAlgorithm'],
      $authInformation['Key']['Crypto'][$operationInformation['OperationType']],
      \OPENSSL_RAW_DATA,
      $iv
    );

    $hashMac = hash_hmac (
      $this->_authConfiguration['HashAlgorithm'],
      $cipherText,
      $authInformation['Key']['Private'][$operationInformation['OperationType']],
      true
    );

    return [
      $this->_authConfiguration['SignatureName'],
      $this->_EncodeBase64 (
        $authInformation['Key']['Public'][$operationInformation['OperationType']] .
        $hashMac .
        $iv .
        $cipherText
      )
    ];
  }
}
