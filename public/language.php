<?php

session_start();

$languageList = array('fr-FR', 'en-GB');

if (!isset($_GET['lang'])) header('Location: ' . $_SERVER['HTTP_REFERER']);

$language = htmlspecialchars($_GET['lang']);

if (!in_array($language, $languageList))
    header('Location: ' . $_SERVER['HTTP_REFERER']);


$_SESSION['language'] = $language;

header('Location: ' . $_SERVER['HTTP_REFERER']);
