<?php 
   include "db.php";
   session_start();

   $sql = "SELECT password from persons WHERE id_person=".$_SESSION["id_user"];

   $password_input_hashed = password_hash($_POST["new_password"], PASSWORD_DEFAULT);

   $result = $conn->query($sql);

   if($result->num_rows > 0){
      $row = $result->fetch_assoc();

      if(password_verify($_POST["old_password"], $row["password"])){ //zmen heslo
         //$sql1 = "SELECT password FROM used_passwords where id_person=".$_SESSION["id_user"];
         $sql1 = "UPDATE persons SET password='".$password_input_hashed."' WHERE id_person=".$_SESSION["id_user"];
         $result1 = $conn->query($sql1);

         if($result1){
            header("Location: ../profile.php?msg=success");
         }
      }else{ //spatne heslo
         header("Location: ../passwordChange.php?error=badpassword");
      }

   }else{
      echo "divny";
   }
?>