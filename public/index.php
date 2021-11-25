<?php session_start() ?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Critics</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/header.css">
</head>

<body>
    <?php include_once('includes/header.php'); ?>

    <div class="index__welcome__container">
        <p>Bienvenue sur Critics, blog de critique de films et séries</p>
    </div>

    <div class="index__content">
        <img class="index__welcome__image" src="./images/cinema.jpg" alt="cinema" style="display: none;">
        <a id="articles"></a>
    </div>

    <script type="module" src="js/pagination.js"></script>
</body>

</html>