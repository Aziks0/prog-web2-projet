<?php
session_start();
include_once('includes/requireLogin.php');
include_once('includes/i18n.php');
?>

<!DOCTYPE html>

<html lang="<?php echo $_SESSION['language'] ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Critics</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/publish.css">
</head>

<body>
    <?php include_once('includes/header.php'); ?>


    <div class="publish__content">
        <div class="publish__background__container">
            <form action="../src/publishForm.php" method="post" class="publish__form" enctype="multipart/form-data">
                <?php if (isset($_GET['error'])) : ?>
                    <p class="publish__error error"><?php echo $_GET['error']; ?></p>
                <?php endif; ?>

                <label for="title" id="title-label">
                    <?php echo $i18n->publish->titleLabel ?>
                </label>
                <input type="text" name="title" id="title" class="publish__input">

                <label for=" image" id="image-label">
                    <?php echo $i18n->publish->imageLabel ?>
                </label>
                <input type="file" name="image" id="image" accept=".jpg, .jpeg, image/png" class="publish__input">

                <label for="category" id="category-label">
                    <?php echo $i18n->publish->categoryLabel ?>
                </label>
                <select name="category" id="category" class="publish__input">
                    <option value="movie">
                        <?php echo $i18n->global->category->movie ?>
                    </option>
                    <option value="tvshow">
                        <?php echo $i18n->global->category->tvshow ?>
                    </option>
                </select>

                <label for="body" id="body-label">
                    <?php echo $i18n->publish->bodyLabel ?>
                </label>
                <textarea name="body" id="body" rows="10" class="publish__input"></textarea>

                <button type="submit">
                    <?php echo $i18n->publish->submitButton ?>
                </button>
            </form>
        </div>
    </div>

    <script type="module" src="js/publishFormVerif.js"></script>
</body>

<?php include_once('includes/footer.php') ?>

</html>