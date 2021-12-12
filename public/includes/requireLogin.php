<?php

if (isset($_SESSION['username'])) return;

include_once('i18n.php');

header(
    'Location: /prog-web2-projet/public/login?error=' .
        $i18n->login->loginRequired .
        '&redirect_url=' .
        $_SERVER['SCRIPT_NAME']
);
