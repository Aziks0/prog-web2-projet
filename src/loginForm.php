<?php

session_start();

include_once('ORM.php');
include_once('i18n.php');

if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header('Location: ../public/login');
    exit();
}

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

if (empty($username) || empty($password)) {
    header('Location: ../public/login');
    exit();
}

try {
    $ORM = new ORM();

    if (!$ORM->isUsernameInDatabase($username)) {
        header('Location: ../public/login?error=' . $i18n->login->wrongLogin);
        exit();
    }

    $databasePassword = $ORM->fetchUser($username)['password'];
} catch (Exception $ex) {
    header('Location: ../public/login?error=' . $i18n->login->serverError);
    exit();
}

if (!password_verify($password, $databasePassword)) {
    header('Location: ../public/login?error=' . $i18n->login->wrongLogin);
    exit();
}

$_SESSION['username'] = $username;

if (isset($_POST['redirect_url'])) {
    $redirect_url = htmlspecialchars($_POST['redirect_url']);

    if (
        filter_var($redirect_url, FILTER_VALIDATE_URL) ||
        // FILTER_VALIDATE_URL doesn't like localhost
        $_SERVER['HTTP_HOST'] === 'localhost'
    ) {
        header('Location: ' . $redirect_url);
        exit();
    }
}

header('Location: ../public');
