<?php

session_start();

include_once('ORM.php');

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
        header('Location: ../public/login?error=Nom d\'utilisateur ou mot de passe incorrect');
        exit();
    }

    $databasePassword = $ORM->fetchUser($username)['password'];
} catch (Exception $ex) {
    header('Location: ../public/login?error=Erreur serveur');
}

if (!password_verify($password, $databasePassword)) {
    header('Location: ../public/login?error=Nom d\'utilisateur ou mot de passe incorrect');
    exit();
}

$_SESSION['username'] = $username;

header('Location: ../public');
