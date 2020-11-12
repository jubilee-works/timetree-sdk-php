<?php
\ini_set('display_errors', 1);

$vendorFilename = \dirname(__DIR__) . '/vendor/autoload.php';
if (\file_exists($vendorFilename)) {
  /* composer install */
  /** @noinspection PhpIncludeInspection */
  require $vendorFilename;
}
