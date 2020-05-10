<?php
include('config.php');

//Reset OAuth access token
$client->revokeToken($_SESSION);
//Destroy entire session data.
session_destroy();

//redirect page to index.php
header('location:index.php');
?>