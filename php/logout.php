
<?php 
session_start();
unset($_SESSION["id_user"]);
unset($_SESSION["is_coach"]);  // where $_SESSION["nome"] is your own variable. if you do not have one use only this as follow **session_unset();**
header("Location: ../index.php");


?>