<?php
session_start();
$_SESSION["facebook_id"] = null;
$_SESSION["username"] = null;
$_SESSION["email"] = null;
$_SESSION["oauth_provider"] = null;
$_SESSION["oauth_uid"] = null;

session_destroy();

header ('location: DondeSea!.php');
?>