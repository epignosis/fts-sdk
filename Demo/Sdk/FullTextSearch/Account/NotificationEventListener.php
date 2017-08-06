<?php

namespace Demo\Sdk\FullTextSearch\Account;

use Demo\Helper\Printer;
use Epignosis\Sdk\FullTextSearch\Account;

/** @noinspection PhpIncludeInspection */
/** @noinspection PhpUndefinedVariableInspection */
require
  rtrim(dirname(dirname(dirname(__DIR__))), \DIRECTORY_SEPARATOR) . \DIRECTORY_SEPARATOR .
  'Helper' . \DIRECTORY_SEPARATOR .
  'Bootstrap.php';

try {

  /** @noinspection PhpUndefinedVariableInspection */
  $notificationEventInformation = (new Account($configuration))->GetNotificationEvent();

} catch (\Exception $exception) {

  Printer::PrintError($exception);

} finally {

  /** @noinspection PhpUndefinedVariableInspection */
  Printer::PrintResponse (function() use ($notificationEventInformation) {
    echo sprintf (
      '<b>Account Notification Event Information</b><pre>%s</pre>',
      print_r($notificationEventInformation, true)
    );
  });

}
