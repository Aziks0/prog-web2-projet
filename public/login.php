<?php
session_start();
// Prevent logged in users from accessing the login page
if (isset($_SESSION['username'])) {
    header('Location: /prog-web2-projet/public');
    exit();
}
?>

<!DOCTYPE html>

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
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" name="username" id="username">
                <p class="error" style="display: none;">Un nom d'utilisateur est requis</p>
            </div>

            <div class="login__password__container">
                <label for="password">Mot de passe:</label>
                <input type="password" name="password" id="password">
                <p class="error" style="display: none;">Un mot de passe est requis</p>
            </div>

            <button type="submit" class="login__submit_button">Connexion</button>
        </form>
    </div>

    <?php include_once('includes/footer.php') ?>

    <script src="js/loginFormVerif.js"></script>
</body>

</html>