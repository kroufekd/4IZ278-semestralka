
<?php 
session_start();
unset($_SESSION["id_user"]);
unset($_SESSION["is_coach"]); 
header("Location: ../index.php");


?>