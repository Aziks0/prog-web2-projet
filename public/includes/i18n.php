<?php
if (!isset($_SESSION['language'])) {
  $_SESSION['language'] = 'fr-FR';
  $_SESSION['flag'] = '🇫🇷';
}

$localesFilesPath =
  $_SERVER['REQUEST_SCHEME'] .
  '://' .
  $_SERVER['HTTP_HOST'] .
  '/prog-web2-projet/public/locales/' .
  $_SESSION['language'] .
  '.json';
$locales = file_get_contents($localesFilesPath);
$i18n = json_decode($locales);
