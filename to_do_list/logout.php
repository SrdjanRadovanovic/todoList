<?php
Session_start();

Session_unset();
session_destroy();
header('Location: index.php');
?>