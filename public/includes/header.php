<link rel="stylesheet" href="css/header.css">

<header class="header header__fixed">
    <div class="header__content">
        <a class="header__brand" href="/prog-web2-projet/public">Critics</a>
        <nav class="header__nav">
            <a href="/prog-web2-projet/public/#"><?php echo $i18n->header->homeAnchor ?></a>
            <a href="/prog-web2-projet/public/#articles"><?php echo $i18n->header->articleAnchor ?></a>
            <a href="#footer"><?php echo $i18n->header->aboutAnchor ?></a>
        </nav>
        <div class="header__session">
            <div class="header__session header__session__connexion">
                <?php if (isset($_SESSION['username'])) : ?>
                    <a href="/prog-web2-projet/public/publish"><?php echo $i18n->header->publishButton ?></a>
                    <a href="/prog-web2-projet/public/logout"><?php echo $i18n->header->logoutButton ?></a>
                <?php else : ?>
                    <a href="/prog-web2-projet/public/login"><?php echo $i18n->header->loginButton ?></a>
                <?php endif; ?>
            </div>
            <?php if ($_SESSION['language'] === 'fr-FR') : ?>
                <a href="/prog-web2-projet/public/language?lang=en-GB" class="header__lang">🇬🇧</a>
            <?php elseif ($_SESSION['language'] === 'en-GB') : ?>
                <a href="/prog-web2-projet/public/language?lang=fr-FR" class="header__lang">🇫🇷</a>
            <?php endif; ?>
        </div>
    </div>
</header>