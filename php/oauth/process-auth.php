<?php 

    include "../db.php";
    session_start();
    
    if(!isset($_GET["code"])){
        echo "bad";
        exit();
    }

   $discord_code = $_GET["code"];

   $payload = [
       'code'=>$discord_code,
       'client_id'=>'981887734694178836',
       'client_secret'=>'AvfIxaLC6rXWHxbkSYxi7SDEqu1kmCxy',
       'grant_type'=>'authorization_code',
       'redirect_uri'=>'http://localhost/skola/4iz278-semestralka/php/oauth/process-auth.php',
       'scope'=>'identify%20guids',
   ];

   $payload_string = http_build_query($payload);
   $discord_token_url = "https://discordapp.com/api/oauth2/token";

   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, $discord_token_url);
   curl_setopt($ch, CURLOPT_POST, true);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $payload_string);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

   $result = curl_exec($ch);
    
   $result = json_decode($result, true);
   $access_token = $result["access_token"];

   $discord_users_url = "https://discordapp.com/api/users/@me";
   $header = array("Authorization: Bearer $access_token", "Content-Type: application/x-www-form-urlencoded");
   
   $ch = curl_init();

   curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
   curl_setopt($ch, CURLOPT_URL, $discord_users_url);
   curl_setopt($ch, CURLOPT_POST, false);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

   $result = curl_exec($ch);
   $result = json_decode($result);
   echo $result->id;

   $sql = "SELECT * FROM persons WHERE discord_id=".$result->id;

   $result = $conn->query($sql);

   if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION["id_user"] = $row["id_person"];
        $_SESSION["is_coach"] = $row["is_coach"];
        header("Location: http://localhost/skola/4iz278-semestralka/profile.php?success");
        
   }else{
       echo "neni v db";
       header("Location: http://localhost/skola/4iz278-semestralka/index.php");
   }
   //$result = json_decode($result, true);

   
?>