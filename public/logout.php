<?php

session_start();
session_unset();
session_destroy();

header('Location: /prog-web2-projet/public');
