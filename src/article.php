<?php

include_once('ORM.php');

try {
  $ORM = new ORM();
} catch (Exception $ex) {
  // Internal Server Error
  http_response_code(500);
  exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  // Bad Request
  http_response_code(400);
  exit();
}

$id = (int) htmlspecialchars($_GET['id']);

// $id needs to be > 0, otherwise it's a bad request
if ($id <= 0) {
  // Bad Request
  http_response_code(400);
  exit();
}

try {
  $article = $ORM->fetchArticle($id);
} catch (Exception $ex) {
  // Internal Server Error
  http_response_code(500);
  exit();
}

if (empty($article)) {
  // Bad Request
  http_response_code(400);
  exit();
}

$image = base64_encode($article['image']);

$data = array(
  'id' => $article['id'],
  'author' => $article['author'],
  'title' => $article['title'],
  'body' => $article['body'],
  'image' => $image,
  'category' => $article['category'],
  'created_at' => $article['created_at'],
  'updated_at' => $article['updated_at']
);

echo json_encode($data);
exit();
