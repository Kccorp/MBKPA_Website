<?php

session_start();
unset($_SESSION['email']);
unset($_SESSION['token']);
session_destroy();
header("Location: index.php");

?>