<?php
if (!isset($_SESSION['language']))
  $_SESSION['language'] = 'fr-FR';

$localesFilesPath = './locales/' . $_SESSION['language'] . '.json';
$locales = file_get_contents($localesFilesPath);
$i18n = json_decode($locales);
