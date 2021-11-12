<?php

include_once('ORM.php');

try {
    $ORM = new ORM();
} catch (Exception $ex) {
    // Internal Server Error
    http_response_code(500);
    exit();
}

// Respond with an array of articles that can be displayed on the webpage and
// the number of articles in the database
if (
    isset($_GET['nbArticle']) &&
    is_numeric($_GET['nbArticle']) &&
    isset($_GET['page']) &&
    is_numeric($_GET['page'])
) {
    $numberArticle = (int) htmlspecialchars($_GET['nbArticle']);
    $page = (int) htmlspecialchars($_GET['page']);

    // $numberArticle and $page needs to be > 0, otherwise it's a bad request
    if ($numberArticle <= 0 || $page <= 0) {
        // Bad Request
        http_response_code(400);
        exit();
    }

    try {
        // We only need to fetch the articles that will be displayed on the
        // webpage
        $offset = $numberArticle * ($page - 1);
        $articles = $ORM->fetchArticlesLimited($numberArticle, $offset);

        $articlesCount = $ORM->getCountArticles();

        $data = array(
            'articles_count' => $articlesCount, 'articles' => $articles
        );
        echo json_encode($data);
        exit();
    } catch (Exception $ex) {
        // Internal Server Error
        http_response_code(500);
        exit();
    }
}

// Bad Request
http_response_code(400);
exit();
