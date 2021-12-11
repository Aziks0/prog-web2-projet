<?php

session_start();

if (isset($_SESSION['username'])) return;

header(
  'Location: /prog-web2-projet/public/login?error=Vous devez vous ' .
    'connecter pour accéder à cette page&redirect_url=' .
    $_SERVER['SCRIPT_NAME']
);
