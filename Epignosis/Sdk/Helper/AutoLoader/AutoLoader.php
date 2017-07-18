<?php

namespace Epignosis\Sdk\Helper\AutoLoader;

/**
 * Class AutoLoader
 *
 * The AutoLoader.
 *
 * @application Epignosis SDK
 * @author      Haris Batsis <xarhsdev@efrontlearning.com>
 * @category    Epignosis\Sdk\Helper\AutoLoader
 * @copyright   Epignosis LLC (c) Copyright 2017, All Rights Reserved
 * @package     Epignosis\Sdk\Helper\AutoLoader
 * @since       1.0.0-dev
 */
class AutoLoader
{
  /**
   * The list of the registered namespaces.
   *
   * @default []
   * @since   1.0.0-dev
   * @var     array
   */
  private $_namespaceList = [];


  /**
   * The internal autoload function.
   *
   * @param   string $filePath
   *            - The file path to be auto-loaded. (Required)
   *
   * @return  bool
   *
   * @since   1.0.0-dev
   */
  private function _AutoLoad($filePath)
  {
    $filePath = $this->_GetFilePathFixed($filePath, false);

    foreach ($this->GetAutoLoadedFileExtensionList() as $fileExtension) {
      if ($this->_AutoLoadFromList($filePath . $fileExtension)) {
        return true;
      }
    }

    return false;
  }

  /**
   * This is a helper method of the internal autoload function.
   *
   * @param   string $filePath
   *            - The file path to be auto-loaded. (Required)
   *
   * @return  bool
   *
   * @since   1.0.0-dev
   */
  private function _AutoLoadFromList($filePath)
  {
    $filePathDirectoryList = array_slice(explode(\DIRECTORY_SEPARATOR, $filePath), 0, -1);
    $_namespace = null;

    foreach ($filePathDirectoryList as $namespace) {
      $_namespace .= ltrim('\\' . $namespace, '\\');

      if (isset($this->_namespaceList[$_namespace])) {
        if ($this->_IncludeOnce($this->_namespaceList[$_namespace] . $filePath)) {
          return true;
        }
      }
    }

    return false;
  }

  /**
   * Returns the default file extension list.
   *
   * @return  array
   *
   * @since   1.0.0-dev
   */
  private function _GetDefaultFileExtensionList()
  {
    return ['php'];
  }

  /**
   * Returns the default namespace list.
   *
   * @return  array
   *
   * @since   1.0.0-dev
   */
  private function _GetDefaultNamespaceList()
  {
    return [dirname(__NAMESPACE__, 3) => dirname(__DIR__, 4)];
  }

  /**
   * Returns the requested file extension list in a comma separated string.
   *
   * @param   array $fileExtensionList
   *            - The file extension list to be returned in a comma separated string.
   *              (Required)
   *
   * @return  string
   *
   * @since   1.0.0-dev
   */
  private function _GetFileExtensionListToString(array $fileExtensionList)
  {
    return implode (',', array_unique (array_map (
      [$this, '_GetFileExtensionFixed'], $fileExtensionList
    )));
  }

  /**
   * Returns the requested file extension into the appropriate format.
   *
   * @param   string $fileExtension
   *            - The file extension to be returned into the appropriate format.
   *              (Required)
   *
   * @return  string
   *
   * @since   1.0.0-dev
   */
  private function _GetFileExtensionFixed($fileExtension)
  {
    return '.' . ltrim(trim($fileExtension), '.');
  }

  /**
   * Returns the requested file path into the appropriate format.
   *
   * @param   string $filePath
   *            - The file path to be returned into the appropriate format. (Required)
   *
   * @param   bool $appendDirectorySeparator
   *            - Whether to append a directory separator, or not. (Optional, true)
   *
   * @return  string
   *
   * @since   1.0.0-dev
   */
  private function _GetFilePathFixed($filePath, $appendDirectorySeparator = true)
  {
    $filePath =
      trim (rtrim (
        str_replace(['\\', '/'], \DIRECTORY_SEPARATOR, $filePath), \DIRECTORY_SEPARATOR
      ));

    return $appendDirectorySeparator ? $filePath . \DIRECTORY_SEPARATOR : $filePath;
  }

  /**
   * Returns the requested namespace into the appropriate format.
   *
   * @param   string $namespace
   *            - The namespace to be returned into the appropriate format. (Required)
   *
   * @return  string
   *
   * @since   1.0.0-dev
   */
  private function _GetNamespaceFixed($namespace)
  {
    return trim(rtrim(str_replace(['\\', '/'], '\\', $namespace), '\\'));
  }

  /**
   * Includes once the requested file path (if exists), and returns the inclusion status.
   *
   * @param   string $filePath
   *            - The file path to be included once. (Required)
   *
   * @return  bool
   *
   * @since   1.0.0-dev
   */
  private function _IncludeOnce($filePath)
  {
    if (file_exists($filePath)) {
      /** @noinspection PhpIncludeInspection */
      return include_once $filePath;
    }

    return false;
  }

  /**
   * AutoLoader constructor.
   *
   * @param   bool $useDefaultConfiguration
   *            - Whether to load the default auto-loading configuration or not.
   *              (Optional, true)
   *
   * @since   1.0.0-dev
   */
  public function __construct($useDefaultConfiguration = true)
  {
    if ($useDefaultConfiguration) {
      $this->SetAutoLoadedFileExtensionList($this->_GetDefaultFileExtensionList());
      $this->SetNamespaceList($this->_GetDefaultNamespaceList());
    }
  }

  /**
   * Returns the auto-loaded file extension list.
   *
   * @return  array
   *
   * @since   1.0.0-dev
   */
  public function GetAutoLoadedFileExtensionList()
  {
    return explode(',', spl_autoload_extensions());
  }

  /**
   * Returns the auto-loaded function list.
   *
   * @return  array
   *
   * @since   1.0.0-dev
   */
  public function GetAutoLoadedFunctionList()
  {
    $autoLoadFunctionList = spl_autoload_functions();

    return false === $autoLoadFunctionList ? [] : $autoLoadFunctionList;
  }

  /**
   * Registers the requested callable function into the autoload function list.
   *
   * @param   callable $autoLoadFunction
   *            - The callable to function to be registered into the autoload function
   *              list. (Required)
   *
   * @param   bool $throwException
   *            - Whether to throw an exception, if it's not possible to register
   *              the self autoload function into the autoload function list, or not.
   *              (Optional, true)
   *
   * @param   bool $prepend
   *            - Whether to prepend or append the self autoload function into the
   *              autoload function list. (Optional, false)
   *
   * @return  bool
   *
   * @since   1.0.0-dev
   */
  public function Register (
    callable $autoLoadFunction,
             $throwException = true,
             $prepend = false)
  {
    return spl_autoload_register($autoLoadFunction, $throwException, $prepend);
  }

  /**
   * Registers the self autoload callable function into the autoload function list.
   *
   * @param   bool $throwException
   *            - Whether to throw an exception, if it's not possible to register
   *              the self autoload function into the autoload function list, or not.
   *              (Optional, true)
   *
   * @param   bool $prepend
   *            - Whether to prepend or append the self autoload function into the
   *              autoload function list. (Optional, false)
   *
   * @return  bool
   *
   * @since   1.0.0-dev
   */
  public function RegisterSelf($throwException = true, $prepend = false)
  {
    return $this->Register([$this, '_AutoLoad'], $throwException, $prepend);
  }

  /**
   * Set the requested file extension list into the autoload file extension list.
   *
   * @param   array $fileExtensionList
   *            - The list of file extensions to be set in the autoload file extension
   *              list. (Required)
   *
   * @return  AutoLoader
   *
   * @since   1.0.0-dev
   */
  public function SetAutoLoadedFileExtensionList(array $fileExtensionList)
  {
    spl_autoload_extensions($this->_GetFileExtensionListToString($fileExtensionList));

    return $this;
  }

  /**
   * Set the requested namespace list into the namespace registration list.
   *
   * @param   array $namespaceList
   *            - The list of namespaces to be set in the namespace registration list.
   *              (Required)
   *
   * @return  AutoLoader
   *
   * @since   1.0.0-dev
   */
  public function SetNamespaceList(array $namespaceList)
  {
    foreach ($namespaceList as $namespace => $filePath) {
      $this->_namespaceList[$this->_GetNamespaceFixed($namespace)] =
        $this->_GetFilePathFixed($filePath, true);
    }

    return $this;
  }

  /**
   * Un-registers the requested callable function from the autoload function list.
   *
   * @param   callable $autoLoadFunction
   *            - The callable function to be un-registered from the autoload function
   *              list. (Required)
   *
   * @return  bool
   *
   * @since   1.0.0-dev
   */
  public function UnRegister(callable $autoLoadFunction)
  {
    return spl_autoload_unregister($autoLoadFunction);
  }

  /**
   * Un-registers the self autoload callable function from the autoload function list.
   *
   * @return  bool
   *
   * @since   1.0.0-dev
   */
  public function UnRegisterSelf()
  {
    return $this->UnRegister([$this, '_AutoLoad']);
  }

  /**
   * Updates the file extensions in the autoload file extension list with the requested
   *
   * @param   array $fileExtensionList
   *            - The list of file extensions to be updated in the autoload file extension
   *              list. (Required)
   *
   * @return  AutoLoader
   *
   * @since   1.0.0-dev
   */
  public function UpdateAutoLoadedFileExtensionList(array $fileExtensionList)
  {
    $this->SetAutoLoadedFileExtensionList (
      array_merge($this->GetAutoLoadedFileExtensionList(), $fileExtensionList)
    );

    return $this;
  }

  /**
   * Updates the namespaces in the namespace registration list with the requested
   * namespaces.
   *
   * @param   array $namespaceList
   *            - The list of namespaces to be updated in the namespace registration list.
   *              (Required)
   *
   * @return  AutoLoader
   *
   * @since   1.0.0-dev
   */
  public function UpdateNamespaceList(array $namespaceList)
  {
    $this->SetNamespaceList(array_merge($this->_namespaceList, $namespaceList));

    return $this;
  }
}
