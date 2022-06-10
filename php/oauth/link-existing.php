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
    'redirect_uri'=>'http://localhost/skola/4iz278-semestralka/php/oauth/link-existing.php',
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

    $sql = "UPDATE persons SET discord_id='".$result->id."' WHERE id_person=".$_SESSION["id_user"];

    $result = $conn->query($sql);
    if($result->num_rows > 0){
            
            header("Location: http://localhost/skola/4iz278-semestralka/profile.php?success");
            
    }else{
        echo "neni v db";
        header("Location: http://localhost/skola/4iz278-semestralka/index.php");
    }

?>