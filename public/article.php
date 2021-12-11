<?php session_start() ?>

<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Critics</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/article.css">
</head>

<body>
  <?php include_once('includes/header.php'); ?>

  <div class="article__content">
    <div class="article__background__container">
      <article>
        <h1 class="article__title"></h1>
        <p class="article__category"></p>
        <img class="article__image image" alt="">
        <p class="article__body"></p>
        <div class="article__footer">
          <div class="article__date">
            <p class="article__created_at"></p>
            <p class="article__updated_at"></p>
          </div>
          <p class="article__author"></p>
        </div>
      </article>
    </div>
  </div>

  <?php include_once('includes/footer.php') ?>

  <script type="module" src="js/article.js"></script>
</body>

</html>