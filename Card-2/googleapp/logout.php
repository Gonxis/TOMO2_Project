<?php
session_start();
// although 2nd and 3rd line is not needed session_destroy() is needed,
// but just to be extra sure that no session remains in the cache.
$_SESSION = array();
unset($_SESSION);
session_destroy();
header("location: ../../../TOMO 2 Web con Materialize/index.php");
//header("location:index.php");
?>