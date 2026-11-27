<?php

session_name('gamespark_session');
session_start([
    'use_strict_mode' => true,
    'cookie_httponly' => true,
    'cookie_secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
    'cookie_samesite' => 'Lax',
]);
