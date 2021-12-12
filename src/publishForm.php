<?php

session_start();

include_once('ORM.php');

if (
  !isset($_POST['title']) ||
  !isset($_FILES['image']) ||
  !isset($_POST['category']) ||
  !isset($_POST['body']) ||
  !isset($_SESSION['username'])
) {
  header('Location: ../public');
  exit();
}

$title = htmlspecialchars($_POST['title']);
$category = htmlspecialchars($_POST['category']);
$body = htmlspecialchars($_POST['body']);

if (
  strlen($title) < 6 ||
  strlen($title) > 100 ||
  strlen($body) < 300
) {
  header('Location: ../public');
  exit();
}

$author = $_SESSION['username'];
$image_blob = file_get_contents($_FILES['image']['tmp_name']);
$image_extension = pathinfo(($_FILES['image']['name']), PATHINFO_EXTENSION);

try {
  $ORM = new ORM();
  $id = $ORM->insertArticle($title, $body, $category, $author, $image_blob, $image_extension);
} catch (Exception $ex) {
  header('Location: ../public/publish?error=Erreur serveur');
  exit();
}

header('Location: ../public/article?id=' . $id);
