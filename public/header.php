<header class="header">
    <div class="header__content">
        <a class="header__brand" href="/prog-web2-projet/public">Critics</a>
        <nav class="header__nav">
            <a href="/prog-web2-projet/public">Accueil</a>
            <a href="#">Articles</a>
            <a href="#">À propos</a>
        </nav>
        <div class="header__session__container">
            <?php
            session_start();
            if (isset($_SESSION['username'])) :
            ?>
                <a href="/prog-web2-projet/public/publish">Écrire un article</a>
                <a href="/prog-web2-projet/public/logout">Se déconnecter</a>
            <?php else : ?>
                <a href="/prog-web2-projet/public/login">Se connecter</a>
            <?php endif; ?>

        </div>
    </div>
</header>