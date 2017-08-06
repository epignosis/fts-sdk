<?php

namespace Demo\Sdk\FullTextSearch\PermissionPolicy;

use Demo\Helper\Printer;
use Epignosis\Sdk\FullTextSearch\PermissionPolicy;

/** @noinspection PhpIncludeInspection */
/** @noinspection PhpUndefinedVariableInspection */
require
  rtrim(dirname(dirname(dirname(__DIR__))), \DIRECTORY_SEPARATOR) . \DIRECTORY_SEPARATOR .
  'Helper' . \DIRECTORY_SEPARATOR .
  'Bootstrap.php';

try {

  /** @noinspection PhpUndefinedVariableInspection */
  $notificationEventInformation =
    (new PermissionPolicy($configuration))->GetNotificationEvent();

} catch (\Exception $exception) {

  Printer::PrintError($exception);

} finally {

  /** @noinspection PhpUndefinedVariableInspection */
  Printer::PrintResponse (function() use ($notificationEventInformation) {
    echo sprintf (
      '<b>Permission Policy Notification Event Information</b><pre>%s</pre>',
      print_r($notificationEventInformation, true)
    );
  });

}
