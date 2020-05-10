<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once 'phplib_oauth/vendor/autoload.php';

//Make object of Google API Client for call Google API
$client = new Google_Client();

//Set the OAuth 2.0 Client ID
$client->setClientId('757340862545-7jud0i3kiljf1f540ugtig1qko3sr4au.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$client->setClientSecret('LXWIjFlQRWYgevP4g_-Rl-P_');

//Set the OAuth 2.0 Redirect URI
$client->setRedirectUri('http://127.0.0.1/oauth/index.php');

//
$client->addScope('email');

$client->addScope('profile');

//start session on web page
session_start();

?>