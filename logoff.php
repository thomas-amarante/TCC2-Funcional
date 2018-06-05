<?php

session_start();
session_destroy();
unset($_SESSION['id'], $_SESSION['nome'], $_SESSION['email'],$_SESSION['face_access_token']);

echo "<script>alert ('Logoff efetuado com sucesso!');</script>";
header("Location: index.php");

?>