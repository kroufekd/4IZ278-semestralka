<?php 
    /*
    if(!isset($_POST["email"])){
        header("Location: ../login.php?error=no_info");
    }else{
        $email = $_POST["email"];
    }
    if(!isset($_POST["password"])){
        header("Location: ../login.php?error=no_info");
    }else{
        $password = $_POST["password"];
    }
   */

    session_start();
    include 'db.php';

    $password_input_hashed = password_hash($_POST["password"], PASSWORD_DEFAULT);


    $sql = 'SELECT * FROM persons WHERE email="' . $_POST["email"] . '"';
    $result = $conn -> query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        if(password_verify($_POST["password"], $row["password"])){
            $_SESSION["id_user"] = $row["id_person"];
            header("Location: ../index.php");
        } else {
            header("Location: ../login.php?error=badpassword");
        }
    } else{
        header("Location: ../login.php?.php?error=bademail");
    }
?>