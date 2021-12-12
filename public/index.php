<?php
session_start();
include_once('includes/i18n.php');
?>

<!DOCTYPE html>

<html lang="<?php echo $_SESSION['language'] ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Critics</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <?php include_once('includes/header.php'); ?>

    <div class="index__welcome__container">
        <p><?php echo $i18n->index->welcomeMessage ?></p>
    </div>

    <div class="index__content">
        <img class="index__welcome__image" src="./images/cinema.jpg" alt="cinema" style="display: none;">
        <a id="articles"></a>
    </div>

    <?php include_once('includes/footer.php') ?>

    <script type="module" src="js/pagination.js"></script>
</body>

</html>