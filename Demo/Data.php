<?php

/**
 * For more information: https://github.com/epignosis/fts/wiki/Service-API
 */

// Account:
require
  'Account' . \DIRECTORY_SEPARATOR .
  'Create' . \DIRECTORY_SEPARATOR .
  'Single.php';

require
  'Account' . \DIRECTORY_SEPARATOR .
  'Update' . \DIRECTORY_SEPARATOR .
  'Single.php';

// Document:
require
  'Document' . \DIRECTORY_SEPARATOR .
  'DeIndex' . \DIRECTORY_SEPARATOR .
  'Multiple.php';

require
  'Document' . \DIRECTORY_SEPARATOR .
  'DeIndex' . \DIRECTORY_SEPARATOR .
  'Single.php';

require
  'Document' . \DIRECTORY_SEPARATOR .
  'Index' . \DIRECTORY_SEPARATOR .
  'Multiple.php';

require
  'Document' . \DIRECTORY_SEPARATOR .
  'Index' . \DIRECTORY_SEPARATOR .
  'Single.php';

require
  'Document' . \DIRECTORY_SEPARATOR .
  'Search' . \DIRECTORY_SEPARATOR .
  'Single.php';

// Permission Policy:
require
  'PermissionPolicy' . \DIRECTORY_SEPARATOR .
  'Delete' . \DIRECTORY_SEPARATOR .
  'Multiple.php';

require
  'PermissionPolicy' . \DIRECTORY_SEPARATOR .
  'Delete' . \DIRECTORY_SEPARATOR .
  'Single.php';

require
  'PermissionPolicy' . \DIRECTORY_SEPARATOR .
  'Push' . \DIRECTORY_SEPARATOR .
  'Multiple.php';

require
  'PermissionPolicy' . \DIRECTORY_SEPARATOR .
  'Push' . \DIRECTORY_SEPARATOR .
  'Single.php';
