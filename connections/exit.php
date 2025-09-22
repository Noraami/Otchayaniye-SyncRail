<?php
require_once('db.php');
session_start();
session_destroy();
$_SESSION["user_name"] = "";
$_SESSION["pk_user"] = null;
$_SESSION["conected"] = false;

header("Location: ../index.php");
?>