<?php
session_start();
// Prevent logged in users from accessing the login page
if (isset($_SESSION['username'])) {
    header('Location: /prog-web2-projet/public');
    exit();
}

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
</head>

<body>
    <?php include_once('includes/header.php'); ?>

    <div class="content">
        <form action="../src/loginForm.php" method="post" class="login__form">
            <?php if (isset($_GET['error'])) : ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php endif; ?>

            <div class="login__username__container">
                <label for="username"><?php echo $i18n->login->usernameLabel ?></label>
                <input type="text" name="username" id="username">
                <p class="error" style="display: none;"><?php echo $i18n->login->usernameRequired ?></p>
            </div>

            <div class="login__password__container">
                <label for="password"><?php echo $i18n->login->passwordLabel ?></label>
                <input type="password" name="password" id="password">
                <p class="error" style="display: none;"><?php echo $i18n->login->passwordRequired ?></p>
            </div>

            <?php if (isset($_SERVER['HTTP_REFERER'])) : ?>
                <input type="hidden" name="redirect_url" value="<?php echo $_SERVER['HTTP_REFERER'] ?>">
            <?php elseif (isset($_GET['redirect_url'])) : ?>
                <input type="hidden" name="redirect_url" value="<?php echo $_GET['redirect_url'] ?>">
            <?php endif; ?>

            <button type="submit" class="login__submit_button"><?php echo $i18n->login->submitButton ?></button>
        </form>
    </div>

    <?php include_once('includes/footer.php') ?>

    <script src="js/loginFormVerif.js"></script>
</body>

</html>